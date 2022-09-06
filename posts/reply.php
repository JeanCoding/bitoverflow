<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

include('../verbinding.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['post_id'];
    $content = $_POST['content'];
    $userId = $_SESSION['user']['id'];

    $sql = "INSERT INTO comments (post_id, user_id, content) VALUES (:post_id, :user_id, :content)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':post_id' => $postId,
        ':user_id' => $userId,
        ':content' => $content,
    ]);

    header('Location: /posts/show.php/' . $postId);
}