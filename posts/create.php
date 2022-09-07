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

    if (empty($errors)) {
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO posts (subject, content, category_id, user_id) VALUES (:subject, :content, :category, :user)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':content', $content);
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
        <h2 class='font-bold uppercase text-white text-lg lg:text-xl' style='font-family: Laro'>BitOverflow</h2>
        <button class='text-sm lg:text-lg text-white px-4 py-1 rounded-full flex items-center font-bold' style='background: #000563; font-family: Poppins'>Mijn profiel</button>
    </div>
<div class='hidden lg:block'>
            <aside class='text-white font-bold' style='width: 175px;'>
                <div class='bg-neutral-700 pl-3 uppercase'>CATEGORIEËN</div>
                <button class='pl-3 flex items-center my-2'><img src='../icons/house.svg' class='pr-2'>Home</button>
                <div class='bg-neutral-700 pl-3 uppercase'>Leerjaren</div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1'><img src='../icons/leerjaar1.svg' class='pr-2'>1e jaar</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center pt-2'><img src='../icons/leerjaar2.svg' class='pr-2'>2e jaar</button></div>
                <button class='pl-3 py-2 flex items-center'><img src='../icons/leerjaar3.svg' class='pr-2'>3e jaar</button>
                <div class='bg-neutral-700 pl-3 uppercase'>Talen</div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1'><img src='../icons/leerjaar1.svg' class='pr-2'>PHP</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center pt-2'><img src='../icons/leerjaar2.svg' class='pr-2'>JAVASCRIPT</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1'><img src='../icons/leerjaar1.svg' class='pr-2'>PYTHON</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center pt-2'><img src='../icons/leerjaar2.svg' class='pr-2'>LARAVEL</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1'><img src='../icons/leerjaar1.svg' class='pr-2'>HTML</button></div>
                <button class='py-2 pl-3 flex items-center pt-2'><img src='../icons/leerjaar2.svg' class='pr-2'>CSS</button>
            </aside>
        </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="text" name="subject" placeholder="Onderwerp" >
        <textarea name="content" id="content" placeholder="Omschrijving"></textarea>
        <select name="category" id="category" required>
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
        <input type="submit" value="Aanmaken">

        <ul style="color: red;">
            <?php 
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<li>" . $error . "</li>";
                    }
                }
            ?>
        </ul>
    </form>
</body>
</html>