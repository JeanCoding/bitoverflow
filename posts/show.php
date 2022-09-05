<?php
include('../verbinding.php');

$explodedUri = explode('/', $_SERVER['REQUEST_URI']);

if (isset($explodedUri[3]) && $explodedUri[3] != '') {
    $postId = $explodedUri[3];
    $sql = "SELECT posts.*, users.name as username, categories.name as category FROM posts
            INNER JOIN users ON posts.user_id = users.id
            INNER JOIN categories ON posts.category_id = categories.id
            WHERE posts.id = $postId LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $post = $stmt->fetch();
} else {
    header('Location: /posts/index.php');
}

if (empty($post)) {
    echo 'Post niet gevonden';
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BitOverflow | Post <?php $postId ?></title>
</head>
<body>
    <h1><?php echo $post['subject'] ?></h1>
    <p><?php echo $post['content'] ?></p>
    <p><b>Geplaatst door:</b> <?php echo $post['username'] ?></p>
    <p><b>Categorie:</b> <?php echo $post['category'] ?></p>
    <p><b>Geplaatst op:</b> <?php echo $post['date'] ?></p>
</body>
</html>