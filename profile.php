<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

include './verbinding.php';

$sql = 'SELECT * FROM users WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $_SESSION['user']['id']);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM votes WHERE comment_user_id = :id AND vote = 1';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $_SESSION['user']['id']);
$stmt->execute();

$totalUpvotes = $stmt->rowCount();

$sql = 'SELECT * FROM comments WHERE user_id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $_SESSION['user']['id']);
$stmt->execute();

$totalComments = $stmt->rowCount();

$sql = 'SELECT * FROM posts WHERE user_id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $_SESSION['user']['id']);
$stmt->execute();

$totalPosts = $stmt->rowCount();

$sql = 'SELECT posts.*, users.username as username, categories.name as category FROM posts
        INNER JOIN users ON posts.user_id = users.id 
        INNER JOIN categories ON posts.category_id = categories.id
        WHERE user_id = :id 
        ORDER BY `date` DESC LIMIT 1';

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $_SESSION['user']['id']);
$stmt->execute();

$lastPost = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BitOverflow | Profiel</title>
</head>
<body>
    <a href="/index.php">Home</a>
    <div>
        <h1>Jou eigen profiel</h1>
        <form action="/profile.php" method="POST">
            <label for="username">GEBRUIKERSNAAM</label>
            <input type="text" name="username" id="username" placeholder="Gebruikersnaam" value="<?php echo $user['username']; ?>">
            <label for="email">E-MAIL</label>
            <input type="email" name="email" id="email" placeholder="E-mail" value="<?php echo $user['email']; ?>">
            <label for="password">WACHTWOORD</label>
            <input type="password" name="password" id="password" placeholder="Wachtwoord" value="<?php echo $user['password']; ?>">
            <label for="profile_picture_url">PROFIELFOTO URL</label>
            <input type="text" name="profile_picture_url" id="profile_picture_url" placeholder="Profielfoto URL">
            <label for="biography">BIOGRAFIE</label>
            <textarea name="biography" id="biography" cols="30" rows="10" placeholder="Biografie"></textarea>
            <input type="submit" name="submit" value="Verander">
        </form>
    </div>
    <div>
        <h2>Beste studenten</h2>
        <ol>
            <?php
                $sql = 'SELECT * FROM users ORDER BY reputation DESC LIMIT 3';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($users as $user) {
                    echo '<li>' . $user['username'] . ' heeft ' . $user['reputation'] . ' studenten geholpen.</li>';
                }
            ?>
        </ol>
    </div>
    <div>
        <h2>Een kijkje in je statistieken</h2>
        <p><?php echo $totalUpvotes; ?> upvotes gekregen</p>
        <p><?php echo $totalComments; ?> reacties geplaatst</p>
        <p><?php echo $totalPosts; ?> vragen gesteld</p>
    </div>
    <div>
        <h2>Jou meest recente post</h2>
        <p><b>Geplaatst op:</b> <?php echo $lastPost['date']; ?></p>
        <p><b>Geplaatst door:</b> <?php echo $lastPost['username']; ?></p>
        <p><b>Categorie:</b> <?php echo $lastPost['category']; ?></p>
        <p><b>Onderwerp:</b> <?php echo $lastPost['subject']; ?></p>
        <p><b>Omschrijving:</b> <?php echo $lastPost['content']; ?></p>
    </div>
</body>
</html>