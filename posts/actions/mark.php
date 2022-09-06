<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

include('../../verbinding.php');

$sql = 'SELECT * FROM comments WHERE solution = 1 AND post_id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $postId]);

$solutionKnown = $stmt->rowCount() > 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$solutionKnown) {
    $postId = $_POST['post_id'];
    $commentId = $_POST['comment_id'];
    $userId = $_SESSION['user']['id'];

    $sql = 'UPDATE comments SET solution = 1 WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $commentId]);

    header('Location: /posts/show.php/' . $postId);
}