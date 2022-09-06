<?php
include '../verbinding.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = 'SELECT * FROM votes WHERE comment_id = :comment_id AND user_id = :user_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['comment_id' => $_POST['comment_id'], 'user_id' => $_POST['user_id']]);

    if (strtoupper($_POST['vote']) === 'UPVOTE') {
        if ($stmt->rowCount() === 0) {
            $sql = 'INSERT INTO votes (comment_id, user_id, vote) VALUES (:comment_id, :user_id, 1)';
        } else if ($stmt->rowCount() === 1 && $stmt->fetch()['vote'] === 0) {
            $sql = 'UPDATE votes SET vote = 1 WHERE comment_id = :comment_id AND user_id = :user_id';
        } else {
            $sql = 'DELETE FROM votes WHERE comment_id = :comment_id AND user_id = :user_id';
        }
    } else {
        if ($stmt->rowCount() === 0) {
            $sql = 'INSERT INTO votes (comment_id, user_id, vote) VALUES (:comment_id, :user_id, 0)';
        } else if ($stmt->rowCount() === 1 && $stmt->fetch()['vote'] === 1) {
            $sql = 'UPDATE votes SET vote = 0 WHERE comment_id = :comment_id AND user_id = :user_id';
        } else {
            $sql = 'DELETE FROM votes WHERE comment_id = :comment_id AND user_id = :user_id';
        }
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['comment_id' => $_POST['comment_id'], 'user_id' => $_POST['user_id']]);

    header('Location: /posts/show.php/' . $_POST['post_id']);
}