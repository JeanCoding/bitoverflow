<?php
include "verbinding.php";
session_start();
?>

<html>
<head>
    <link rel="stylesheet" href="style.css">
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat"
      rel="stylesheet"
    />
    <title>BitOverflow | Registreer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <script src="https://kit.fontawesome.com/44d0f25a2a.js" crossorigin="anonymous"></script>
</head>
<body>
<form method='POST'>
    <label>Gebruikersnaam</label>
    <input type='text' name='username'>
    <label>Email</label>
    <input type='email' name='email'>
    <label>Wachtwoord</label>
    <input type='password' name='password'>
    <input type='submit' name='submit'>
</form>
</body>
</html>

<?php
  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':username' => $username
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':email' => $email
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['num'] > 0) {
      echo '<script>alert("Gebruikersnaam bestaat al!")</script>';
    } elseif ($row['num'] > 0) {
      echo '<script>alert("Email bestaat al!")</script>';
    } else {
      $sql = "INSERT INTO `users` (`username`, `email`, `password`) 
    VALUES (:username, :email, :password)";
      $sql_run = $pdo->prepare($sql);
      $result = $sql_run->execute(array(
        ":username" => $username, ":email" => $email, ":password" => $password,
      ));
    // header("Location: login.php");
    }
  }
?>