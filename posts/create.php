<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

include('../verbinding.php');

$_SESSION['user_id'] = 1;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['subject'])) {
        $errors['subject'] = "Onderwerp is verplicht.";
    } else {
        $subject = $_POST['subject'];
    }

    if (empty($_POST['content'])) {
        $errors['content'] = "Omschrijving is verplicht.";
    } else {
        $content = $_POST['content'];
    }

    if (empty($_POST['category'])) {
        $errors['category'] = "Categorie is verplicht.";
    } else {
        $category = $_POST['category'];
    }

    $code = $_POST['code'];

    if (empty($errors)) {
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO posts (subject, content, code, category_id, user_id) VALUES (:subject, :content, :code, :category, :user)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':user', $_SESSION['user']['id']);

        $stmt->execute();

        header('Location: ./index.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BitOverflow | Nieuwe post</title>
</head>

<body class='bg-neutral-800'>
<div class='flex items-center p-3 w-full justify-between'>
        <a href="../home.php"><h2 class='font-bold uppercase text-white text-lg lg:text-xl' style='font-family: Laro'>BitOverflow</h2></a>
        <a href="profile.php"><button class='text-sm lg:text-lg text-white px-4 py-1 rounded-full flex items-center font-bold hover:bg-blue-700 ease-in-out duration-300 bg-blue-900' style='font-family: Poppins'>Mijn profiel</button></a>
    </div>
    <div class="flex">
        <div class='hidden lg:block'>
        <aside class='text-white font-bold' style='width: 175px; font-family: Laro'>
                <div class='bg-neutral-700 pl-3 uppercase'>CATEGORIEËN</div>
                <a href="home.php"><button class='pl-3 flex items-center my-2 cursor-pointer hover:text-gray-300 ease-in-out duration-300'><img src='../icons/house.svg' class='pr-2'>Home</button></a>
                <div class='bg-neutral-700 pl-3 uppercase'>Leerjaren</div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1 hover:text-gray-300 ease-in-out duration-300'><img src='../icons/leerjaar1.svg' class='pr-2'>1e jaar</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center pt-2 hover:text-gray-300 ease-in-out duration-300'><img src='../icons/leerjaar2.svg' class='pr-2'>2e jaar</button></div>
                <button class='pl-3 py-2 flex items-center hover:text-gray-300 ease-in-out duration-300'><img src='../icons/leerjaar3.svg' class='pr-2'>3e jaar</button>
                <div class='bg-neutral-700 pl-3 uppercase'>Talen</div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1 hover:text-gray-300 ease-in-out duration-300'><img src='../icons/leerjaar1.svg' class='pr-2'>PHP</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center pt-2 hover:text-gray-300 ease-in-out duration-300'><img src='../icons/leerjaar2.svg' class='pr-2'>JAVASCRIPT</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1 hover:text-gray-300 ease-in-out duration-300'><img src='../icons/leerjaar1.svg' class='pr-2'>PYTHON</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center pt-2 hover:text-gray-300 ease-in-out duration-300'><img src='../icons/leerjaar2.svg' class='pr-2'>LARAVEL</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1 hover:text-gray-300 ease-in-out duration-300'><img src='../icons/leerjaar1.svg' class='pr-2'>HTML</button></div>
                <button class='py-2 pl-3 flex items-center pt-2 hover:text-gray-300 ease-in-out duration-300'><img src='../icons/leerjaar2.svg' class='pr-2'>CSS</button>
            </aside>
        </div>
        <div class='px-4 lg:pl-10 pt-8 bg-neutral-900 pb-12 md:pb-48 w-full' style='box-shadow: 0px 4px 40px 2px rgba(0, 0, 0, 0.25);'>
            <h2 class='text-white  text-2xl lg:text-4xl mb-6' style='font-family: Poppins'>Stel hier een vraag Jean!</h2>
            <div class='bg-neutral-700 text-white py-6 lg:py-8 px-7 rounded-3xl lg:w-[900px]' style='font-family: Poppins'>
                <div class='mt-2 flex'>
                    <div>
                        <div class='flex items-center'><span class='flex items-center justify-center mt-4 font-bold text-2xl rounded-full'><img src='../images/profile.png' class='pr-2'></span></div>
                    </div>
                    <div>
                        <form class='lg:w-[250px]' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <h3 class='text-xl lg:text-sm lg:ml-3 font-bold pl-2'>NAAM</h3>
                            <input class='text-xl lg:text-lg lg:ml-3 font-bold bg-neutral-800 pr-2 mt-2 py-1 pl-2 rounded-lg text-neutral-400' disabled placeholder="Jean Kalo"></input>
                            <h3 class='text-xl lg:text-sm lg:ml-3 mt-3 font-bold pl-2'>TAG</h3>
                            <select class="text-xl lg:text-lg lg:ml-3 font-bold bg-neutral-800 mt-2 py-1 pl-2 rounded-lg text-neutral-400 pr-32" name="category" id="category" required>
                                <?php
                                $sql = "SELECT * FROM categories";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute();
                                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($categories as $category) {
                                    echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
                                }
                                ?>
                            </select>
                            <h3 class='text-xl lg:text-sm lg:ml-3 mt-3 font-bold pl-2'>ONDERWERP</h3>
                            <input class="text-xl lg:text-lg lg:ml-3 font-bold bg-neutral-800 mt-2 py-1 pr-2 pl-2 rounded-lg text-white outline-none" type="text" name="subject" placeholder="Onderwerp:">
                            <h3 class='text-xl lg:text-sm lg:ml-3 mt-3 font-bold pl-2'>OMSCHRIJVING</h3>
                            <textarea class="text-xl lg:text-lg lg:ml-3 font-bold bg-neutral-800 mt-2 pr-10 py-1 pl-2 rounded-lg placeholder:text-neutral-400 text-white outline-none lg:w-[500px]" rows="8" name="content" id="content" placeholder="Vul hier de omschrijving van je vraag in"></textarea>
                            <h3 class='text-xl lg:text-sm lg:ml-3 mt-3 font-bold pl-2'>CODE</h3>
                            <textarea class="text-xl lg:text-lg lg:ml-3 font-bold bg-neutral-800 mt-2 pr-10 py-1 pl-2 rounded-lg placeholder:text-neutral-400 text-white outline-none lg:w-[500px]" rows="4" name="code" id="code" placeholder="Hier kan je jou code toevoegen"></textarea>
                            <div class="lg:w-[710px] flex justify-center">
                                <input class="bg-white text-black p-2 rounded-full text-xl px-8 mt-8 flex justify-center cursor-pointer bg-white hover:bg-gray-200 ease-in-out duration-300" style='font-family: Laro' type="submit" value="POST">
                            </div>
                        </form>
                    </div>
                    <div class='bg-neutral-700 text-white py-8 px-7 rounded-3xl lg:w-[345px] lg:h-[805px] top-40 absolute right-0 mr-6 hidden lg:block' style='font-family: Poppins; box-shadow: 0px 4px 40px 2px rgba(0, 0, 0, 0.25);'>
                        <h3 class='text-xl flex justify-center lg:text-3xl ml-3 mt-3 font-bold pl-2' style='font-family: Poppins;'>Top 3 Topics:</h3>
                        <h3 class='text-xl flex justify-center lg:text-xs ml-3 mt-2 font-bold pl-2 text-neutral-500' style='font-family: Laro;'>IN DE AFGELOPEN 24 UUR</h3>
                        <div class='flex justify-center items-center'><span class='bg-green-500 w-16 h-16 p-2 mt-12 flex items-center justify-center font-bold text-4xl rounded-full'>1</span></div>
                        <h3 class='text-xl flex justify-center lg:text-3xl ml-3 mt-3 font-bold pl-2' style='font-family: Poppins;'>Laravel</h3>
                        <h3 class='text-xl flex justify-center lg:text-xs ml-3 mt-2 font-bold pl-2 text-neutral-500' style='font-family: Laro;'>9 POSTS MET LARAVEL</h3>
                        <div class='flex justify-center items-center'><span class='bg-yellow-500 w-16 h-16 p-2 mt-12 flex items-center justify-center font-bold text-4xl rounded-full'>2</span></div>
                        <h3 class='text-xl flex justify-center lg:text-3xl ml-3 mt-3 font-bold pl-2' style='font-family: Poppins;'>Javascript</h3>
                        <h3 class='text-xl flex justify-center lg:text-xs ml-3 mt-2 font-bold pl-2 text-neutral-500' style='font-family: Laro;'>7 POSTS MET JAVASCRIPT</h2>
                            <div class='flex justify-center items-center'><span class='bg-orange-600 w-16 h-16 p-2 mt-12 flex items-center justify-center font-bold text-4xl rounded-full'>3</span></div>
                            <h3 class='text-xl flex justify-center lg:text-3xl ml-3 mt-3 font-bold pl-2' style='font-family: Poppins;'>Python</h3>
                            <h3 class='text-xl flex justify-center lg:text-xs ml-3 mt-2 font-bold pl-2 text-neutral-500' style='font-family: Laro;'>4 POSTS MET PYTHON</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='flex items-center py-8 lg:pl-8 px-6 lg:px-0 lg:pr-24 w-full justify-between w-full' style='font-family: Laro'>
            <h2 class='font-bold uppercase text-white text-lg lg:ml-48 cursor-pointer hover:text-gray-300 ease-in-out duration-300'>BitOverflow</h2>
            <div>
                <ul class='text-x lg:text-lg'>
                    <li class='font-bold uppercase text-white cursor-pointer hover:text-gray-300 ease-in-out duration-300'>Guidelines</li>
                    <li class='font-bold uppercase text-white cursor-pointer hover:text-gray-300 ease-in-out duration-300'>Privacy</li>
                    <li class='font-bold uppercase text-white cursor-pointer hover:text-gray-300 ease-in-out duration-300'>Disclaimer</li>
                    <li class='font-bold uppercase text-white cursor-pointer hover:text-gray-300 ease-in-out duration-300'>Bit-Academy</li>
                </ul>
            </div>
</body>

</html>

<style>
    @font-face {
        src: url("../fonts/Laro-ExtraBold.woff2");
        font-family: Laro;
    }

    @font-face {
        src: url("../fonts/Poppins-Bold.woff2");
        font-family: Poppins;
    }
</style>