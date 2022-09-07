<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

include './verbinding.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['username'])) {
        $errors['username'] = 'Naam is verplicht';
    } elseif (str_word_count($_POST['username']) < 2) {
        $errors['username'] = 'Naam moet minimaal 2 woorden bevatten';
    } elseif (str_word_count($_POST['username']) > 2) {
        $errors['username'] = 'Naam mag maximaal 2 woorden bevatten';
    } elseif (!preg_match('/^[a-zA-Z ]*$/', $_POST['username'])) {
        $errors['username'] = 'Naam mag alleen letters bevatten';
    } else {
        $username = $_POST['username'];
    }

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is verplicht';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email is ongeldig';
    } else {
        $email = $_POST['email'];
    }

    if (empty($_POST['school_year'])) {
        $errors['school_year'] = 'Schooljaar is verplicht';
    } elseif (!preg_match('/^[1-3]/', $_POST['school_year'])) {
        $errors['school_year'] = 'Schooljaar is ongeldig';
    } else {
        $school_year = substr($_POST['school_year'], 0, 1);
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Wachtwoord is verplicht';
    } elseif (strlen($_POST['password']) < 8) {
        $errors['password'] = 'Wachtwoord moet minimaal 8 tekens bevatten';
    } else {
        $password = $_POST['password'];
    }

    if (empty($errors)) {
        $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email, school_year = :school_year, `password` = :password WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $fullName = explode(' ', $username);
        $fullName[0] = ucfirst($fullName[0]);
        $fullName[1] = ucfirst($fullName[1]);
        $stmt->execute([
            ':first_name' => $fullName[0],
            ':last_name' => $fullName[1],
            ':email' => $email,
            ':school_year' => $school_year,
            ':password' => $password,
            ':id' => $_SESSION['user']['id']
        ]);
        $_SESSION['user']['name'] = implode(' ', $fullName);
    }
}

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

if ($totalPosts > 0) {
    $sql = 'SELECT posts.*, CONCAT_WS(" ", users.first_name, users.last_name) AS username, categories.name as category FROM posts
            INNER JOIN users ON posts.user_id = users.id 
            INNER JOIN categories ON posts.category_id = categories.id
            WHERE user_id = :id 
            ORDER BY `date` DESC LIMIT 1';

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_SESSION['user']['id']);
    $stmt->execute();

    $lastPost = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BitOverflow | Profiel</title>
</head>

<body class='bg-neutral-800'>
    <div class='flex items-center p-3 w-full justify-between'>
        <a href="home.php">
            <h2 class='font-bold uppercase text-white text-lg lg:text-xl' style='font-family: Laro'>BitOverflow</h2>
        </a>
        <a href="profile.php"><button class='text-sm lg:text-lg text-white px-4 py-1 rounded-full flex items-center font-bold hover:bg-blue-700 ease-in-out duration-300 bg-blue-900' style='font-family: Poppins'>Mijn profiel</button></a>
    </div>
    <div class='flex'>
        <div class='hidden lg:block'>
            <aside class='text-white font-bold' style='width: 175px; font-family: Laro'>
                <div class='bg-neutral-700 pl-3 uppercase'>CATEGORIEËN</div>
                <a href="home.php"><button class='pl-3 flex items-center my-2 cursor-pointer hover:text-gray-300 ease-in-out duration-300'><img src='icons/house.svg' class='pr-2'>Home</button></a>
                <div class='bg-neutral-700 pl-3 uppercase'>Leerjaren</div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1 hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar1.svg' class='pr-2'>1e jaar</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center pt-2 hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar2.svg' class='pr-2'>2e jaar</button></div>
                <button class='pl-3 py-2 flex items-center hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar3.svg' class='pr-2'>3e jaar</button>
                <div class='bg-neutral-700 pl-3 uppercase'>Talen</div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1 hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar1.svg' class='pr-2'>PHP</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center pt-2 hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar2.svg' class='pr-2'>JAVASCRIPT</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1 hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar1.svg' class='pr-2'>PYTHON</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center pt-2 hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar2.svg' class='pr-2'>LARAVEL</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1 hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar1.svg' class='pr-2'>HTML</button></div>
                <button class='py-2 pl-3 flex items-center pt-2 hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar2.svg' class='pr-2'>CSS</button>
            </aside>
        </div>
        <div class='w-full'>
            <div class='px-4 lg:px-16 bg-neutral-900 py-14'>
                <h1 class='text-white text-3xl mb-10' style='font-family: Poppins'>Jouw eigen profiel</h1>
                <div style='background-color:#383838' class='rounded-3xl text-white lg:w-[700px] p-6 relative'>
                    <form action="profile.php" class='flex flex-col inline lg:w-[250px]' method="POST">
                        <label for="username" style='font-family: Laro' class='text-xs ml-2 mb-2'>NAAM</label>
                        <input style='background-color: #202020; font-family: Poppins' disabled type="text" name="username" id="username" placeholder="Naam" value="<?php echo $user['first_name'] . ' ' . $user['last_name']; ?>" class='rounded-3xl px-2.5 py-1.5 mb-4'>
                        <label for="email" class='ml-2 mb-2 text-xs'>E-MAIL</label>
                        <input style='background-color: #202020; font-family: Poppins' type="email" name="email" id="email" placeholder="E-mail" value="<?php echo $user['email']; ?>" class='rounded-3xl px-2.5 py-1.5 mb-4'>
                        <label for="email" class='ml-2 mb-2 text-xs'>LEERJAAR</label>
                        <select style='background-color: #202020; font-family: Poppins' name='school_year' class='px-2 mb-4 py-1.5 rounded-3xl'>
                            <option value='1'>Leerjaar 1</option>
                            <option value='2'>Leerjaar 2</option>
                            <option value='3'>Leerjaar 3</option>
                        </select>
                        <label for="password" class='ml-2 mb-2 text-xs'>WACHTWOORD</label>
                        <input style='background-color: #202020; font-family: Poppins' type="password" name="password" id="password" placeholder="Wachtwoord" value="<?php echo $user['password']; ?>" class='rounded-3xl px-2.5 py-1.5 mb-4'>
                        <label for="profile_picture_url" class='ml-2 mb-2 text-xs'>PROFIELFOTO URL</label>
                        <input style='background-color: #202020; font-family: Poppins' type="text" name="profile_picture_url" id="profile_picture_url" placeholder="Profielfoto URL" class='rounded-3xl px-2.5 py-1.5 mb-4'>
                        <label for="biography" class='ml-2 mb-2 text-xs'>BIOGRAFIE</label>
                        <textarea style='background-color: #202020; font-family: Poppins' name="biography" id="biography" cols="30" rows="10" placeholder="Biografie" class='lg:w-[600px] lg:h-[130px] rounded-2xl px-2.5 py-1.5 mb-4'></textarea>
                        <div class='lg:w-[600px] flex justify-center py-4 mt-2'><input type="submit" name="submit" value="CHANGE" style='font-family: Laro' class='bg-white rounded-3xl text-black text-xl py-2 px-12 cursor-pointer'></div>
                        <div class='absolute right-24 top-24 hidden lg:block'>
                            <img src='images/big_profile.png'>
                            <p style='font-family: Poppins' class='text-center mt-4'><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></p>
                        </div>

                        <?php if (!empty($errors)) : ?>
                            <ul>
                                <?php foreach ($errors as $error) : ?>
                                    <li style="color: red;"><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </form>
                </div>
                <h2 class='text-white text-3xl pt-16 pb-8' style='font-family: Poppins'>Een kijkje in je statistieken</h2>
                <div style='background: #383838; font-family: Poppins' class='mb-16 flex flex-col lg:flex-row justify-between lg:px-32 text-white py-16 rounded-3xl text-xl uppercase'>
                    <p class='text-center'><?php echo $totalUpvotes; ?><br /> upvotes<br />gekregen</p>
                    <p class='text-center my-12 lg:my-0'><?php echo $totalComments; ?><br />reacties<br />geplaatst</span></p>
                    <p class='text-center'><?php echo $totalPosts; ?><br /> vragen<br />gesteld</p>
                </div>

                <h2 class='text-white text-3xl pb-8' style='font-family: Poppins'>Mijn nieuwste post</h2>

                <div class='mt-6 lg:mt-0 bg-neutral-700 text-white py-8 px-7 mb-20 rounded-3xl flex w-full' style='box-shadow: 0px 4px 40px 2px rgba(0, 0, 0, 0.25);'>
                    <div class='mr-8 hidden lg:block'><img src='images/profile.png' class='w-24'></div>
                    <div>
                        <div class='pb-2 mb-2 border-b-2 bg-black-500' style='border-color: #606060;'>
                            <?php
                            $query = "SELECT * FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC LIMIT 0, 1";
                            $sql = $pdo->prepare($query);
                            $sql->execute();
                            $rows = $sql->fetchAll();
                            foreach ($rows as $row) {
                            ?>
                                <p class='text-zinc-500 font-bold text-xs' style='font-family: Laro'><?php echo $row['date'] ?></p>
                                <p class='text-white font-bold text-xl lg:text-2xl' style='font-family: Poppins'><?php echo $row['first_name'] ?> <?php echo $row['last_name']; ?></p>
                                <p class='text-zinc-500 font-bold text-xs uppercase' style='font-family: Laro'><?php echo $row['school_year'] ?>e jaars</p>
                        </div>
                        <span class='rounded-2xl bg-black px-6 py-1 font-bold text-center mr-2 text-xs' id='tag'>PHP</span>
                        <span class='rounded-2xl bg-black px-6 py-1 font-bold text-center text-xs' id='tag'>SESSIONS</span>
                        <p class='text-zinc-500 font-bold text-xs mt-6 uppercase' style='font-family: Laro'>Onderwerp:</p>
                        <p class='text-white font-bold lg:text-xl break-all' style='font-family: Poppins'><?php echo $row['subject']; ?></p>
                        <p class='text-zinc-500 font-bold text-xs mt-6 uppercase' style='font-family: Laro'>Beschrijving:</p>
                        <p class='text-white font-bold text-lg mb-8' style='font-family: Poppins'>
                            <?php echo $row['content']; ?>
                        </p>
                        <div class='bg-black text-white p-4 hidden lg:block rounded-2xl'>
                            <code>
                                <?php echo htmlspecialchars($row['code']); ?>
                            </code>
                        </div>
                        <form method='POST'>
                            <div class='w-full flex justify-between items-center mt-12 text-3xl font-bold'>
                                <div class='flex'>
                                    <button type='submit' name='upvote'><span class='w-10 h-10 lg:w-12 lg:h-12 p-2 flex items-center justify-center font-bold text-2xl rounded-full mr-6 ml-2' style='background: #5BFF61'><img src='icons/up_arrow.svg'></span></button>
                                    <span class='w-10 h-10 lg:w-12 lg:h-12 p-2 flex items-center justify-center font-bold text-2xl rounded-full' style='background: #FF5959'><img src='icons/down_arrow.svg'></span>
                                    <span class='px-4 py-1 flex items-center justify-center font-bold text-xl lg:text-2xl rounded-3xl ml-6' id='score' style=' font-family: Poppins'><span id='operator'></span>
                                    <?php
                                    $score = 6;
                                    if ($score >= 0) {
                                        echo "<script>document.getElementById('score').style.background = '#5BFF61'</script>";
                                        echo "<script>document.getElementById('operator').innerText = '+'</script>";
                                    } else {
                                        echo "<script>document.getElementById('score').style.background = '#FF5959'</script>";
                                    }
                                    echo $score;
                                }
                                    ?>
                                    </span>
                                </div>
                                <div class='flex'>
                                    <span class='hidden lg:block'><button class='bg-gray-200 py-1 px-8 rounded-2xl text-black uppercase text-2xl' style='font-family: Laro'>Antwoord</button></span>
                                    <span class='w-10 h-10 flex items-center justify-center font-bold rounded-full ml-2 bg-white block lg:hidden'><img class='w-5' src='icons/chat.svg'></span>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- <div>
            <h2>Jou meest recente post</h2>
            <?php
            if (isset($lastPost)) { ?>
                    <p><b>Geplaatst op:</b> <?php echo $lastPost['date']; ?></p>
                    <p><b>Geplaatst door:</b> <?php echo $lastPost['username']; ?></p>
                    <p><b>Categorie:</b> <?php echo $lastPost['category']; ?></p>
                    <p><b>Onderwerp:</b> <?php echo $lastPost['subject']; ?></p>
                    <p><b>Omschrijving:</b> <?php echo $lastPost['content']; ?></p>   
                <?php } else { ?>
                    <p>Je hebt nog geen posts geplaatst.</p>
                <?php } ?>
        </div> -->

            </div>
            <div class='bg-neutral-700 text-white py-8 px-7 hidden lg:block rounded-3xl lg:w-[345px] lg:h-[685px] top-48 absolute right-16' style='font-family: Poppins; box-shadow: 0px 4px 40px 2px rgba(0, 0, 0, 0.25);'>
                <h3 class='text-xl flex justify-center lg:text-3xl ml-3 mt-3 font-bold pl-1' style='font-family: Poppins;'>Top 3 Studenten:</h3>
                <h3 class='text-xl flex justify-center lg:text-xs ml-3 mt-2 font-bold pl-2 text-neutral-500' style='font-family: Laro;'>IN DE AFGELOPEN 24 UUR</h3>
                <div class='flex justify-center items-center'><span class='bg-green-500 w-16 h-16 p-2 mt-12 flex items-center justify-center font-bold text-4xl rounded-full'>1</span></div>
                <h3 class='text-xl flex justify-center lg:text-3xl ml-3 mt-3 font-bold pl-2' style='font-family: Poppins;'>Mauro Scheltens</h3>
                <h3 class='text-xl flex justify-center lg:text-xs ml-3 mt-2 font-bold pl-2 text-neutral-500' style='font-family: Laro;'>HIELP 8 LEERLINGEN</h3>
                <div class='flex justify-center items-center'><span class='bg-yellow-500 w-16 h-16 p-2 mt-12 flex items-center justify-center font-bold text-4xl rounded-full'>2</span></div>
                <h3 class='text-xl flex justify-center lg:text-3xl ml-3 mt-3 font-bold pl-2' style='font-family: Poppins;'>Kasper Ligthart</h3>
                <h3 class='text-xl flex justify-center lg:text-xs ml-3 mt-2 font-bold pl-2 text-neutral-500' style='font-family: Laro;'>HIELP 5 LEERLINGEN</h2>
                    <div class='flex justify-center items-center'><span class='bg-orange-600 w-16 h-16 p-2 mt-12 flex items-center justify-center font-bold text-4xl rounded-full'>3</span></div>
                    <h3 class='text-xl flex justify-center lg:text-3xl ml-3 mt-3 font-bold pl-2' style='font-family: Poppins;'>Jean Kalo</h3>
                    <h3 class='text-xl flex justify-center lg:text-xs ml-3 mt-2 font-bold pl-2 text-neutral-500' style='font-family: Laro;'>HIELP 3 LEERLINGEN</h2>
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
        src: url("fonts/Laro-ExtraBold.woff2");
        font-family: Laro;
    }

    @font-face {
        src: url("fonts/Poppins-Bold.woff2");
        font-family: Poppins;
    }
</style>

<script>
    const labels = document.querySelectorAll('label');
    labels.forEach(label => (
        label.style.fontFamily = 'Laro'
    ));
</script>