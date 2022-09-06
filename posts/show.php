<?php
include('../verbinding.php');

$explodedUri = explode('/', $_SERVER['REQUEST_URI']);

if (isset($explodedUri[3]) && $explodedUri[3] != '') {
    $postId = $explodedUri[3];
    $sql = "SELECT posts.*, users.username as username, categories.name as category FROM posts
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
    <a href="/posts/index.php">Terug</a>
    <div>
        <h1><?php echo $post['subject'] ?></h1>
        <p><?php echo $post['content'] ?></p>
        <p><b>Geplaatst door:</b> <?php echo $post['username'] ?></p>
        <p><b>Categorie:</b> <?php echo $post['category'] ?></p>
        <p><b>Geplaatst op:</b> <?php echo $post['date'] ?></p>
    </div>
    <div>
        <h2>Reacties</h2>
        <div>
            <form action="/posts/reply.php" method="post">
                <input type="hidden" name="post_id" value="<?php echo $postId ?>">
                <textarea name="content" placeholder="Reactie plaatsen"></textarea>
                <input type="submit" value="Reageer">
            </form>
        </div>
        <?php
            $sql = "SELECT comments.*, users.username as username FROM comments
                    INNER JOIN users ON comments.user_id = users.id
                    WHERE comments.post_id = $postId
                    ORDER BY comments.date DESC";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $comments = $stmt->fetchAll();

            foreach ($comments as $comment) {
                echo '<div>';
                echo '<p>' . $comment['content'] . '</p>';
                echo '<p><b>Geplaatst door:</b> ' . $comment['username'] . '</p>';
                echo '<p><b>Geplaatst op:</b> ' . $comment['date'] . '</p>';
                echo '</div>';
            }
        ?>
    </div>
</body>
</html>