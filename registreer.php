<?php
session_start();
?>

<html>
    <head><script src="https://cdn.tailwindcss.com"></script>
    <title>BitOverflow | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /></head>
    <body>
        <div style="background-color: #000000;" class="w-2/3 h-full fixed left-0 top-0">
            <img src="images/Frame_8.png" alt="img-1" style="width: 500px; height: auto;">
            <br>
            <img src="images/Frame_3.png" alt="img-2" style="width: 900px; height: auto;" class='absolute bottom-2 ml-24'>
        </div>
        <div>
        <div style="background-color: #242424;" class="w-1/3 h-full fixed right-0 top-0">
            <div>
                <div class="flex flex-col items-center mt-40">
                    <h1 style="color:white;">BitOverflow</h1>
                    <p style="color:gray;">LOGIN</p>
                </div>
            </div>

            <form action="post" class="flex flex-col items-center mt-24">
                <p style="color:white;">E-MAIL:</p>
                <input type="E-MAIL" class="rounded-full px-3 py-2 text-white" style="background-color: #3D3D3D;" placeholder="E-MAIL" ></input>
                <br>
                <p style="color:white;">wachtwoord:</p>
                <input type="wachtwoord" class="rounded-full px-3 py-2 text-white" style="background-color: #3D3D3D;" placeholder="wachtwoord"></input>
                <br>
                <br>
                <button style="color:white;" class="rounded-full bg-neutral-700 hover:bg-neutral-500 px-20 py-2">submit</button>
            </form>

        <div class="flex justify-center">
            <p style="color:white;" class="absolute bottom-4">Geen Account? <a href="" class="text-sky-500 hover:text-sky-700 ">Registreer</a></p>
        </div>

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