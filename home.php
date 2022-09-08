<?php
session_start();

// if (!isset($_SESSION['user'])) {
//     header('Location: login.php');
// }

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
                <a href="/allpost.php?year=1"><div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1 hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar1.svg' class='pr-2'>1e jaar</button></div></a>
                <a href="/allpost.php?year=2"><div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center pt-2 hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar2.svg' class='pr-2'>2e jaar</button></div></a>
                <a href="/allpost.php?year=3"><button class='pl-3 py-2 flex items-center hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar3.svg' class='pr-2'>3e jaar</button></a>
                <div class='bg-neutral-700 pl-3 uppercase'>Talen</div>
                <a href="/allpost.php?category=PHP"><div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1 hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar1.svg' class='pr-2'>PHP</button></div></a>
                <a href="/allpost.php?category=JavaScript"><div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center pt-2 hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar2.svg' class='pr-2'>JAVASCRIPT</button></div></a>
                <a href="/allpost.php?category=Python"><div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1 hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar1.svg' class='pr-2'>PYTHON</button></div></a>
                <a href="/allpost.php?category=Laravel"><div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center pt-2 hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar2.svg' class='pr-2'>LARAVEL</button></div></a>
                <a href="/allpost.php?category=HTML"><div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1 hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar1.svg' class='pr-2'>HTML</button></div></a>
                <a href="/allpost.php?category=CSS"><button class='py-2 pl-3 flex items-center pt-2 hover:text-gray-300 ease-in-out duration-300'><img src='icons/leerjaar2.svg' class='pr-2'>CSS</button></a>
            </aside>
        </div>
        <div class='px-4 lg:pl-16 pt-8 bg-neutral-900 pb-12 md:pb-48 w-full' style='box-shadow: 0px 4px 40px 2px rgba(0, 0, 0, 0.25);'>
        <?php
                                $query = "SELECT * FROM users WHERE id = :id";
                                $sql = $pdo->prepare($query);
                                $sql->bindParam('id', $_SESSION['user']['id']);
                                $sql->execute();
                                $rows = $sql->fetchAll();
                                foreach ($rows as $row) {
                                ?>
            <h2 class='text-white  text-2xl lg:text-4xl mb-6 lg:ml-7' style='font-family: Poppins'>Goedemorgen <?php echo $row['first_name']; }?>!</h2>
            <div class='bg-neutral-700 text-white py-8 px-7 rounded-3xl lg:w-[900px]' style='font-family: Poppins'>
                <h3 class='text-base lg:text-2xl font'>Wat zijn vandaag de trending topics?</h3>
                <div class='mt-8 flex justify-between'>
                    <div>
                        <div class='flex items-center'><span class='bg-green-500 w-10 h-10 p-2 flex items-center justify-center font-bold text-2xl rounded-full'>1</span>
                            <h3 class='text-xl lg:text-2xl ml-3 font-bold'>Javascript</h3>
                        </div>
                        <div class='flex items-center my-7'><span class='bg-yellow-500 w-10 h-10 p-2 flex items-center justify-center font-bold text-2xl rounded-full'>2</span>
                            <h3 class='text-xl lg:text-2xl ml-3 font-bold'>Laravel</h3>
                        </div>
                        <div class='flex items-center'><span class='bg-orange-600 w-10 h-10 p-2 flex items-center justify-center font-bold text-2xl rounded-full'>3</span>
                            <h3 class='text-xl lg:text-2xl ml-3 font-bold'>Python</h3>
                        </div>
                    </div>
                    <div>
                        <img src='images/grafiek.png' class='rounded-3xl h-[175px] w-[325px] float-right hidden lg:block'>
                    </div>
                </div>
            </div>
            <div class='bg-neutral-700 text-white py-2 px-7 hidden 2xl:block rounded-3xl lg:w-[345px] lg:h-[298px] top-40 xl:absolute right-0 mt-8 xl:mt-0 xl:mr-4' style='font-family: Poppins; box-shadow: 0px 4px 40px 2px rgba(0, 0, 0, 0.25);'>
                <h3 class='text-xl flex justify-center lg:text-3xl ml-3 mt-3 font-bold pl-2' style='font-family: Poppins;'>Bekijk alle posts</h3>
                <h3 class='text-xl flex justify-center text-xs ml-3 mt-2 font-bold pl-2 text-neutral-500 text-center' style='font-family: Laro;'>VAN IEDEREEN & ELK LEERJAAR</h3>
                <div class='flex justify-center items-center'><span class='bg-green-500 w-16 h-16 p-2 mt-10 lg:ml-4 ml-2 flex items-center justify-center font-bold text-4xl rounded-full'><?php 

                $stmt = $pdo->prepare('SELECT * FROM posts');
                $stmt->execute();
                $count = $stmt->rowCount();
                echo $count;
                ?></span></div>
                <h3 class='text-xl flex justify-center text-xs ml-3 mt-3 font-bold pl-2 text-neutral-500 text-center' style='font-family: Laro;'>POSTS TOTAAL</h3>
                <div class='flex justify-center w-[300px]'><a href="allpost.php" class='text-xl lg:text-2xl ml-3 font-bold pl-2 py-1 mt-8 bg-blue-900 rounded-full w-[200px] text-center cursor-pointer hover:bg-blue-700 transition duration-150 ease-out' style='font-family: Poppins;'>Bekijk</a></div>
            </div>
            <div class='text-white px-1 lg:px-7 rounded-3xl lg:flex justify-between items-center w-full lg:w-[900px]'>
                <h2 class='text-white font-bold text-xl lg:text-3xl my-10' style='font-family: Poppins'>Wie is er op zoek naar hulp?</h2>
                <a href="allpost.php"><button class='text-sm lg:text-lg text-white px-5 py-1 block 2xl:hidden rounded-full h-12 font-bold hover:bg-blue-700 ease-in-out duration-300 bg-blue-900' style='font-family: Poppins'>Alle Posts!</button></a>
                <a href="posts/create.php"><button class='text-sm lg:text-lg text-white px-5 py-1 rounded-full h-12 font-bold hover:bg-blue-700 ease-in-out duration-300 bg-blue-900' style='font-family: Poppins'>Stel een vraag!</button></a>
            </div>
            <div class='mt-6 lg:mt-0 bg-neutral-700 text-white py-8 px-7 rounded-3xl flex lg:w-[900px]' style='box-shadow: 0px 4px 40px 2px rgba(0, 0, 0, 0.25);'>
                <?php
                $query = "SELECT * FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC LIMIT 0, 1;";
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
                    <div class='mr-8 hidden lg:block'><img src='<?php echo $row['img_url'] ?>' class='w-24 rounded-3xl'></div>
                    <div>
                        <div class='pb-2 mb-2 border-b-2 bg-black-500' style='border-color: #606060;'>
                            <p class='text-zinc-500 font-bold text-xs' style='font-family: Laro'><?php echo $row['date'] ?></p>
                            <p class='text-white font-bold text-xl lg:text-2xl' style='font-family: Poppins'><?php echo $row['first_name'] ?> <?php echo $row['last_name']; ?></p>
                            <p class='text-zinc-500 font-bold text-xs uppercase' style='font-family: Laro'><?php echo $row['school_year'] ?>e jaars</p>
                        </div>
                        <?php 
                                $sql = 'SELECT * FROM categories WHERE id = ' . $row['category_id'];
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute();
                                $category = $stmt->fetch();
                                echo '<span class="rounded-2xl bg-black px-6 py-1 font-bold text-center text-xs" id="tag"> ' . $category['name'] . '</span>';
                        ?>
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
                            }
                                    ?>
                                    </span>
                                </div>
                                <div class='flex'>
                                    <span class='hidden lg:block'><button class='bg-gray-200 hover:bg-gray-300 ease-in-out duration-300 py-1 px-8 rounded-2xl text-black uppercase text-2xl' style='font-family: Laro'>Antwoord</button></span>
                                    <span class='w-10 h-10 flex items-center justify-center font-bold rounded-full ml-2 bg-white block lg:hidden'><img class='w-5' src='icons/chat.svg'></span>
                                </div>
                            </div>
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