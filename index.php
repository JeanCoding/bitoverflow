<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BitOverflow | Home</title>
</head>
<body>
    <?php var_dump($_SESSION); ?>
    <a href="/posts/create.php">Nieuwe post</a>
    <a href="/posts/index.php">Posts</a>
    <a href="/logout.php">Log uit</a>
</body>
</html>