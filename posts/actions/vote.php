<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

include '../../verbinding.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['post_user_id'] == $_SESSION['user']['id']) {
        header('Location: /allpost.php');
    } else {
        $sql = 'SELECT * FROM votes WHERE post_id = :post_id AND user_id = :user_id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['post_id' => $_POST['post_id'], 'user_id' => $_POST['user_id']]);
    
        if (isset($_POST['upvote'])) {
            if ($stmt->rowCount() === 0) {
                $sql = 'INSERT INTO votes (post_id, user_id, post_user_id, score) VALUES (:post_id, :user_id, :post_user_id, 1)';
            } else if ($stmt->rowCount() === 1 && $stmt->fetch()['score'] === 0) {
                $sql = 'UPDATE votes SET score = 1 WHERE post_id = :post_id AND user_id = :user_id AND post_user_id = :post_user_id';
            } else {
                $sql = 'DELETE FROM votes WHERE post_id = :post_id AND user_id = :user_id AND post_user_id = :post_user_id';
            }
        } elseif (isset($_POST['downvote'])) {
            if ($stmt->rowCount() === 0) {
                $sql = 'INSERT INTO votes (post_id, user_id, post_user_id, score) VALUES (:post_id, :user_id, :post_user_id, 0)';
            } else if ($stmt->rowCount() === 1 && $stmt->fetch()['score'] === 1) {
                $sql = 'UPDATE votes SET score = 0 WHERE post_id = :post_id AND user_id = :user_id AND post_user_id = :post_user_id';
            } else {
                $sql = 'DELETE FROM votes WHERE post_id = :post_id AND user_id = :user_id AND post_user_id = :post_user_id';
            }
        }
    
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['post_id' => $_POST['post_id'], 'user_id' => $_POST['user_id'], 'post_user_id' => $_POST['post_user_id']]);
    
        header('Location: /allpost.php');
    }
}