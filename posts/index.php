<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

include('../verbinding.php');

$sql = 'SELECT posts.*, CONCAT_WS(" ", users.first_name, users.last_name) as username, categories.name as category FROM posts 
        INNER JOIN users ON posts.user_id = users.id 
        INNER JOIN categories ON posts.category_id = categories.id 
        ORDER BY posts.date DESC';

$stmt = $pdo->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <?php foreach($posts as $post): ?>
        <a href="/posts/show.php/<?php echo $post['id']; ?>" style="text-decoration: inherit; color: inherit;">
            <h1><?php echo $post['subject']; ?></h1>
            <p><?php echo $post['content']; ?></p>
            <p><?php echo $post['category']; ?></p>
            <p><?php echo $post['username']; ?></p>
            <p><?php echo $post['date']; ?></p>
        </a>
    <?php endforeach; ?>
</body>
</html>