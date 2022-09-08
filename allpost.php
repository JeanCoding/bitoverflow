<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

include "verbinding.php";
?>

<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>BitOverflow | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
        <div class='px-4 lg:pl-16 pt-8 bg-neutral-900 pb-12 md:pb-48 w-full' style='box-shadow: 0px 4px 40px 2px rgba(0, 0, 0, 0.25);'>
            <h2 class='text-white  text-2xl lg:text-4xl mb-6 mt-6' style='font-family: Poppins'>Bekijk alle recente posts</h2>
            <div class="lg:grid grid-cols-2">
                                <?php
                                $query = "SELECT * FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC";
                                $sql = $pdo->prepare($query);
                                $sql->execute();
                                $rows = $sql->fetchAll();
                                foreach ($rows as $row) {
                                    $sql = "SELECT * FROM votes WHERE post_id = {$row['id']} AND score = 1";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    $upvotes = $stmt->rowCount();
                    
                                    $sql = "SELECT * FROM votes WHERE post_id = {$row['id']} AND score = 0";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    $downvotes = $stmt->rowCount();
                                ?>
                    <div class='my-6 lg:mt-0 bg-neutral-700 text-white py-8 px-7 rounded-3xl flex lg:w-[600px]' style='box-shadow: 0px 4px 40px 2px rgba(0, 0, 0, 0.25);'>
                        <div class='mr-4 mt-3 hidden lg:block'><img src='<?php echo $row['img_url'] ?>' class='rounded-full w-56'></div>
                        <div>
                            <div class='pb-2 mb-2 border-b-2 bg-black-500' style='border-color: #606060;'>
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
                            <form method='POST' action="/posts/actions/vote.php">
                                <input type="hidden" name="post_id" value="<?php echo $row['id'] ?>">
                                <input type="hidden" name="post_user_id" value="<?php echo $row['user_id'] ?>">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id'] ?>">
                                <div class='w-full flex justify-between items-center mt-12 text-3xl font-bold'>
                                    <div class='flex'>
                                        <button type='submit' name='upvote'
                                            <?php if ($row['user_id'] == $_SESSION['user']['id']) echo 'disabled'; ?>
                                        ><span class='w-10 h-10 lg:w-12 lg:h-12 p-2 flex items-center justify-center font-bold text-2xl rounded-full mr-6 ml-2' style='background: #5BFF61'><img src='icons/up_arrow.svg'></span></button>
                                        <button type="submit" name="downvote"
                                            <?php if ($row['user_id'] == $_SESSION['user']['id']) echo 'disabled'; ?>
                                        ><span class='w-10 h-10 cursor-pointer lg:w-12 lg:h-12 p-2 flex items-center justify-center font-bold text-2xl rounded-full' style='background: #FF5959'><img src='icons/down_arrow.svg'></span></button>
                                        <span class='px-4 py-1 flex items-center justify-center font-bold text-xl lg:text-2xl rounded-3xl ml-6' id='score' style=' font-family: Poppins'><span id='operator'></span>
                                        <?php
                                        $score = $upvotes - $downvotes;
                                        if ($score >= 0) {
                                            echo "<script>document.getElementById('score').style.background = '#5BFF61'</script>";
                                            echo "<script>document.getElementById('operator').innerText = '+'</script>";
                                        } else {
                                            echo "<script>document.getElementById('score').style.background = '#FF5959'</script>";
                                        }
                                        echo $score;
                                        ?>
                                        </span>
                                    </div>
                                    <div class='flex'>
                                        <span class='hidden lg:block'><button class='bg-gray-200 hover:bg-gray-300 ease-in-out duration-300 py-1 px-8 rounded-2xl text-black uppercase text-2xl transition ease-in-out duration-300' style='font-family: Laro'>BEKIJK</button></span>
                                        <span class='w-10 h-10 flex items-center justify-center font-bold rounded-full ml-2 bg-white block lg:hidden'><img class='w-5' src='icons/chat.svg'></span>
                                    </div>
                                </div>
                        </div>
                    </div>
        <?php
                }
        ?>
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

<script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>

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
    const elements = document.querySelectorAll('#tag');
    const colors = ['#00DE4C', '#FF5959', '#E96200', '#38BDF8', '#EAB308'];
    for (let i = 0, l = elements.length; i < l; i++) {
        const tagcolor = colors[Math.floor(Math.random() * colors.length)];
        elements[i].style.color = tagcolor;
    }
</script>