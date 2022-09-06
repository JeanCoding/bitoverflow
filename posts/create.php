<?php 
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

include('../verbinding.php');

$_SESSION['user_id'] = 1;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['subject'])) {
        $errors['subject'] = "Onderwerp is verplicht.";
    } else {
        $subject = $_POST['subject'];
    }

    if (empty($_POST['content'])) {
        $errors['content'] = "Omschrijving is verplicht.";
    } else {
        $content = $_POST['content'];
    }

    if (empty($_POST['category'])) {
        $errors['category'] = "Categorie is verplicht.";
    } else {
        $category = $_POST['category'];
    }

    if (empty($errors)) {
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO posts (subject, content, category_id, user_id) VALUES (:subject, :content, :category, :user)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':user', $_SESSION['user']['id']);

        $stmt->execute();

        header('Location: ./index.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BitOverflow | Nieuwe post</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="text" name="subject" placeholder="Onderwerp" >
        <textarea name="content" id="content" placeholder="Omschrijving"></textarea>
        <select name="category" id="category" required>
            <?php 
                $sql = "SELECT * FROM categories";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($categories as $category) {
                    echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
                }
            ?>
        </select>
        <input type="submit" value="Aanmaken">

        <ul style="color: red;">
            <?php 
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<li>" . $error . "</li>";
                    }
                }
            ?>
        </ul>
    </form>
</body>
</html>