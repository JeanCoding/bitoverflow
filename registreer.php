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
    <label>Voornaam</label>
    <input type='text' name='first_name'>
    <label>Achternaam</label>
    <input type='text' name='last_name'>
    <label>Leerjaar</label>
    <select name='leerjaar'>
        <option value='1'>Leerjaar 1</option>
        <option value='2'>Leerjaar 2</option>
        <option value='3'>Leerjaar 3</option>
    </select>
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
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $leerjaar = $_POST['leerjaar'];
    $password = $_POST['password'];
    $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':email' => $email
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':email' => $email
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['num'] > 0) {
      echo '<script>alert("Email bestaat al!")</script>';
    } else {
      $sql = "INSERT INTO `users` (`first_name`, `last_name`, `leerjaar`, `email`, `password`) 
    VALUES (:first_name, :last_name, :leerjaar, :email, :password)";
      $sql_run = $pdo->prepare($sql);
      $result = $sql_run->execute(array(
        ":first_name" => $first_name, ":last_name" => $last_name, ":leerjaar" => $leerjaar, ":email" => $email, ":password" => $password,
      ));
    header("Location: login.php");
    }
  }
?>