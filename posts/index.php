<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

include('../verbinding.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inCategories = '';
    $inSchoolYears = '';

    if (isset($_POST['categories'])) {
        $inCategories = join(',', $_POST['categories']);
    }
    if (isset($_POST['schoolYears'])) {
        $inSchoolYears = join(',', $_POST['schoolYears']);
    }

    if (isset($_POST['categories']) && isset($_POST['schoolYears'])) {
        $sql = 'SELECT posts.*, CONCAT_WS(" ", users.first_name, users.last_name) as username, users.school_year as school_year, categories.name as category FROM posts 
                INNER JOIN users ON posts.user_id = users.id 
                INNER JOIN categories ON posts.category_id = categories.id 
                WHERE categories.id IN (' . $inCategories . ') AND users.school_year IN (' . $inSchoolYears . ') ORDER BY posts.date DESC';

        $selectedCategories = $pdo->query('SELECT * FROM categories WHERE id IN (' . $inCategories . ')');
        $selectedCategories = $selectedCategories->fetchAll(PDO::FETCH_ASSOC);

    } elseif (isset($_POST['categories'])) {
        $sql = 'SELECT posts.*, CONCAT_WS(" ", users.first_name, users.last_name) as username, users.school_year as school_year, categories.name as category FROM posts 
                INNER JOIN users ON posts.user_id = users.id 
                INNER JOIN categories ON posts.category_id = categories.id 
                WHERE categories.id IN (' . $inCategories . ') ORDER BY posts.date DESC';

        $selectedCategories = $pdo->query('SELECT * FROM categories WHERE id IN (' . $inCategories . ')');
        $selectedCategories = $selectedCategories->fetchAll(PDO::FETCH_ASSOC);
    } elseif (isset($_POST['schoolYears'])) {
        $sql = 'SELECT posts.*, CONCAT_WS(" ", users.first_name, users.last_name) as username, users.school_year as school_year, categories.name as category FROM posts 
                INNER JOIN users ON posts.user_id = users.id 
                INNER JOIN categories ON posts.category_id = categories.id 
                WHERE users.school_year IN (' . $inSchoolYears . ') ORDER BY posts.date DESC';
    }
} else {
    $sql = 'SELECT posts.*, CONCAT_WS(" ", users.first_name, users.last_name) as username, users.school_year as school_year, categories.name as category FROM posts 
            INNER JOIN users ON posts.user_id = users.id 
            INNER JOIN categories ON posts.category_id = categories.id 
            ORDER BY posts.date DESC';
}

$stmt = $pdo->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM categories';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BitOverflow | Posts</title>
</head>
<body>
    <a href="/posts/create.php">Post aanmaken</a>
    <a href="/index.php">Home</a>
    <form method="POST">
        <select name="categories[]" id="categories" multiple>
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <select name="schoolYears[]" id="school_years" multiple>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
        <input type="submit" value="filter">
    </form>
    <div>
        <h3>Geselecteerde filters:</h3>
        <ul>
            <?php 
                if (isset($selectedCategories)) {
                    foreach ($selectedCategories as $category) {
                        echo '<li>' . $category['name'] . '</li>';
                    }
                }

                if (isset($_POST['schoolYears'])) {
                    foreach ($_POST['schoolYears'] as $schoolYear) {
                        echo '<li>' . $schoolYear . 'e jaars</li>';
                    }
                }
            ?>
        </ul>
    </div>
    <?php foreach($posts as $post): ?>
        <a href="/posts/show.php/<?php echo $post['id']; ?>" style="text-decoration: inherit; color: inherit;">
            <h1><?php echo $post['subject']; ?></h1>
            <p><?php echo $post['content']; ?></p>
            <p><?php echo $post['category']; ?></p>
            <p><?php echo $post['username']; ?> (<?php echo $post['school_year'] ?>e jaars)</p>
            <p><?php echo $post['date']; ?></p>
        </a>
    <?php endforeach; ?>
</body>
</html>