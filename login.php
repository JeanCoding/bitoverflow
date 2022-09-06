<?php
session_start();
include "verbinding.php";
?>  

<html>
    <head><script src="https://cdn.tailwindcss.com"></script>
    <title>BitOverflow | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /></head>
    <body>
        <div style="background-color: #000000;" class="w-2/3 h-full fixed left-0 top-0 lg:block hidden">
            <img src="images/Frame_8.png" alt="img-1" style="width: 500px; height: auto;">
            <br>
            <img src="images/Frame_3.png" alt="img-2" style="width: 900px; height: auto;" class='absolute bottom-2 ml-24'>
        </div>
        <div>
        <div style="background-color: #242424;" class="lg:w-1/3 h-full lg:fixed right-0 top-0">
            <div>
                <div class="flex flex-col items-center lg:mt-40 pt-8">
                    <h1 style="font-family: Laro;" class="text-white text-2xl">BITOVERFLOW</h1>
                    <p style="font-family: Poppins;" class="text-lg text-zinc-500">LOGIN</p>
                </div>
            </div>

            <form action="post" class="flex flex-col items-center mt-20">
                <p style="font-family: Laro;" class="mb-2 text-white">E-MAIL:</p>
                <input type="E-MAIL" class="rounded-full px-3 py-2 text-white outline-none" style="background-color: #3D3D3D; font-family: Laro;" placeholder="E-MAIL" ></input>
                <p style="font-family: Laro;" class="mb-2 mt-4 text-white">WACHTWOORD:</p>
                <div class="flex">
                    <input type="password" class="rounded-full px-3 py-2 ml-8 text-white outline-none" id="myInput" style="background-color: #3D3D3D; font-family: Laro;" placeholder="WACHTWOORD"></input>
                    <span class='mt-3 ml-4 cursor-pointer hover:scale-110 cursor-pointer ease-in-out duration-300' id="myInput" onclick="myFunction()"><img class='w-5' id='eye' src='icons/ww.png'></span>
                </div>
                <button type='submit' style="color:white; font-family: Laro;" class="mt-12 rounded-full bg-neutral-700 ease-in-out duration-300 hover:bg-neutral-500  px-24 py-2">SUBMIT</button>
            </form>

        <div class="flex justify-center">
            <p style="color:white; font-family: Laro;" class="absolute bottom-4 font-light">GEEN ACCOUNT? <a href="" style="font-family: Laro;" class="text-sky-500 hover:text-sky-700 ease-in-out duration-300">REGISTREER</a></p>
        </div>

    </body>
</html>

<script>
  function myFunction() {
   const x = document.getElementById("myInput");
   if (x.type === "password") {
     x.type = "text";
    document.getElementById("eye").src = "icons/ww.png";
   } else {
     x.type = "password";
     document.getElementById("eye").src = "icons/invisible.png";
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
                $userId = $row['id'];
                $_SESSION['user']['name'] = $username;
                $_SESSION['user']['id'] = $userId;
                header('Location: index.php');
            } else {
                echo "<script>alert('Verkeerd gebruikersnaam en/of wachtwoord!');</script>";
            }
        }
    }
}
?>