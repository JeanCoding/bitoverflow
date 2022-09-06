<?php
include "verbinding.php";
?>

<html>
    <head></head>
    <body>
        <form method='POST'>
            <label for="username">Gebruikersnaam</label>
            <input
            type="text"
            placeholder="Voer je gebruikersnaam in"
            name="username"
            />
            <label for="password">Wachtwoord</label>
            <input
            type="password"
            placeholder="Voer je wachtwoord in"
            name="password"
            />
            <input type="submit" name='submit' value="Login" />
            <span><a href="registreer.php">Nog geen account?</a></span>
        </form>
    </body>
</html>

<?php
if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if ($username != "" && $password != "") {
        $query = "SELECT * FROM `users` WHERE `username`=:username AND `password`=:password";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('username', $username, PDO::PARAM_STR);
        $stmt->bindParam('password', $password, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        $rows = $stmt->fetchAll();
        foreach ($rows as $row) {
            if ($count == 1 && !empty($row)) {
                $username = $row['username'];
                $_SESSION['username'] = $username;
                echo "<script>alert('Je bent ingelogd als $username!')</script>";
            } else {
                echo "<script>alert('Verkeerd gebruikersnaam en/of wachtwoord!');</script>";
            }
        }
    }
}
?>