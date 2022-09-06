<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

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

$sql = 'SELECT * FROM comments WHERE solution = 1 AND post_id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $postId]);

$solutionKnown = $stmt->rowCount() > 0;

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
            <form action="/posts/actions/reply.php" method="post">
                <input type="hidden" name="post_id" value="<?php echo $postId ?>">
                <textarea name="content" placeholder="Reactie plaatsen"></textarea>
                <input type="submit" value="Reageer">
            </form>
        </div>
        <?php
            $sql = "SELECT comments.*, users.username as username, users.id as commentUserId FROM comments
                    INNER JOIN users ON comments.user_id = users.id
                    WHERE comments.post_id = $postId
                    ORDER BY comments.date DESC";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $comments = $stmt->fetchAll();

            foreach ($comments as $comment) {
                $sql = "SELECT * FROM votes WHERE comment_id = {$comment['id']} AND vote = 1";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $upvotes = $stmt->rowCount();

                $sql = "SELECT * FROM votes WHERE comment_id = {$comment['id']} AND vote = 0";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $downvotes = $stmt->rowCount();

                echo '<div>';
                echo '<p>' . $comment['content'] . '</p>';
                echo '<p><b>Geplaatst door:</b> ' . $comment['username'] . '</p>';
                echo '<p><b>Geplaatst op:</b> ' . $comment['date'] . '</p>';
                ?>
                    <form action="/posts/actions/vote.php" method="POST">
                        <input type="hidden" name="comment_id" value="<?php echo $comment['id'] ?>">
                        <input type="hidden" name="post_id" value="<?php echo $postId ?>">
                        <input type="hidden" name="comment_user_id" value="<?php echo $comment['commentUserId'] ?>">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id'] ?>">
                        <input type="submit" name="vote" value="Upvote"
                            <?php if ($comment['user_id'] == $_SESSION['user']['id']) echo 'disabled'; ?>
                        >
                        <input type="submit" name="vote" value="Downvote" 
                            <?php if ($comment['user_id'] == $_SESSION['user']['id']) echo 'disabled'; ?>
                        >
                        <span><?php echo($upvotes - $downvotes) ?></span>
                    </form>
                <?php
                echo '</div>';
                if ($post['user_id'] == $_SESSION['user']['id']) { ?>
                    <form action="/posts/actions/mark.php" method="POST">
                        <input type="hidden" name="comment_id" value="<?php echo $comment['id'] ?>">
                        <input type="hidden" name="post_id" value="<?php echo $postId ?>">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id'] ?>">
                        <input type="submit" name="mark" value="Markeren als oplossing"
                            <?php if ($comment['user_id'] == $_SESSION['user']['id'] || $solutionKnown) echo 'disabled'; ?>
                        >
                    </form>
                <?php }
                if ($comment['solution'] == 1) {
                    echo '<p style="color: green;">Gemarkeerd als oplossing.</p>';
                }
                echo '<hr>';
            }
        ?>
    </div>
</body>
</html>