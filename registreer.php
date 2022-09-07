<?php
include "verbinding.php";
session_start();
?>


<html>

<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <title>BitOverflow | Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="background-color: #242424;">
  <div style="background-color: #000000;" class="w-2/3 h-full fixed left-0 top-0 hidden lg:block">
    <img src="images/Frame_8.png" alt="img-1" style="width: 500px; height: auto;">
    <br>
    <img src="images/Frame_3.png" alt="img-2" style="width: 900px; height: auto;" class='absolute bottom-2'>
  </div>
  <div>
    <div style="background-color: #242424;" class="lg:w-5/12 h-full lg:fixed right-0 top-0 pl-1 z-0">
      <div>
        <div class="flex flex-col items-center lg:mt-40 mt-6">
          <h1 style="color:white; font-family: Laro;" class="text-2xl">BITOVERFLOW</h1>
          <p style="color:gray; font-family: Poppins;" class="text-lg mb-4">REGISTRATIE</p>
        </div>
      </div>

      <form action="post" class="flex flex-col items-center mt-10">
        <div class="grid gap-4 lg:grid-cols-2 ">
          <div style="justify-content: space-between;">
            <p style="font-family: Laro;" class="ml-2 mb-2 text-white">VOORNAAM:</p>
            <input type="text" class="rounded-full lg:px-3 py-2 pl-4 text-white outline-none ml-1" style="background-color: #3D3D3D; font-family: Poppins;" placeholder="VOORNAAM">
          </div>
          <div>
            <p style="font-family: Laro;" class="ml-2 mb-2 text-white">ACHTERNAAM:</p>
            <input type="text" class="rounded-full lg:px-3 px-1 py-2 pl-4 text-white outline-none" style="background-color: #3D3D3D; font-family: Poppins;" placeholder="ACHTERNAAM">
          </div>
          <div>
            <p style="font-family: Laro;" class="ml-2 mb-2 text-white">E-MAIL:</p>
            <input type="email" class="rounded-full lg:px-3 px-1 py-2 pl-4 text-white outline-none" style="background-color: #3D3D3D; font-family: Poppins;" placeholder="E-MAIL">
          </div>
          <div>
              <p style="font-family: Laro;" class="ml-2 mb-2 text-white">WACHTWOORD:</p>
              <div class="flex">
              <input type="password" id="myInput" class="rounded-full lg:px-3 px-1 py-2 pl-4 text-white outline-none" style="background-color: #3D3D3D; font-family: Poppins;" placeholder="WACHTWOORD">
              <span class='mt-3 ml-4 cursor-pointer hover:scale-110 cursor-pointer ease-in-out duration-300' id="myInput" onclick="myFunction()"><img class='w-5' id='eye' src='icons/ww.png'></span>
            </div>
          </div>
          <div class="mt-2">
            <p style="font-family: Laro;" class="ml-2 text-white">LEERJAAR:</p>
            <select class="rounded-full lg:px-3 px-1 py-2 text-white mt-3 pl-4 outline-none" style="background-color: #3D3D3D; font-family: Poppins;">
              <option value="1">LEERJAAR 1</option>
              <option value="2">LEERJAAR 2</option>
              <option value="3">LEERJAAR 3</option>
            </select>
          </div>
        </div>
        <button class="rounded-full bg-neutral-700 hover:bg-neutral-500 px-20 py-2 mt-16 mb-24 text-white ease-in-out duration-300" style="font-family: Laro;">SUBMIT</button>
      </form>
      <div class="flex justify-center">
        <p class="mb-6 absolute lg:bottom-0 text-white cursor-default pb-6 lg:text-base text-sm" style="font-family: Laro;">HEB JE AL EEN ACCOUNT? <a href="" class="text-sky-500 hover:text-sky-700 ease-in-out duration-300" style="font-family: Laro;">LOGIN</a></p>
      </div>
</body>
</html>

<script>
  function myFunction() {
   const x = document.getElementById("myInput");
   if (x.type === "password") {
     x.type = "text";
    document.getElementById("eye").src = "icons/invisible.png";
   } else {
     x.type = "password";
     document.getElementById("eye").src = "icons/ww.png";
   }
}
</script>

<style>
  @font-face {
    src: url("fonts/Laro-ExtraBold.woff2");
    font-family: Laro;
  }

  @font-face {
    src: url("fonts/Poppins-Bold.woff2");
    font-family: Poppins;
  }
</style>

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