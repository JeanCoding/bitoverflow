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
        <h2 class='font-bold uppercase text-white text-xl'>BitOverflow</h2>
        <button class='text-lg text-white px-5 py-2 rounded-full flex items-center' style='background: #000563'>Mijn profiel</button>
    </div>
    <div class='flex'>
        <div>
            <aside class='text-white font-bold' style='width: 175px;'>
                <div class='bg-neutral-700 pl-3 uppercase'>CATEGORIEËN</div>
                <button class='pl-3 flex items-center my-2'><img src='icons/house.svg' class='pr-2'>Home</button>
                <div class='bg-neutral-700 pl-3 uppercase'>Leerjaren</div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1'><img src='icons/leerjaar1.svg' class='pr-2'>1e jaar</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center pt-2'><img src='icons/leerjaar2.svg' class='pr-2'>2e jaar</button></div>
                <button class='pl-3 py-2 flex items-center'><img src='icons/leerjaar3.svg' class='pr-2'>3e jaar</button>
                <div class='bg-neutral-700 pl-3 uppercase'>Talen</div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1'><img src='icons/leerjaar1.svg' class='pr-2'>PHP</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center pt-2'><img src='icons/leerjaar2.svg' class='pr-2'>JAVASCRIPT</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1'><img src='icons/leerjaar1.svg' class='pr-2'>PYTHON</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center pt-2'><img src='icons/leerjaar2.svg' class='pr-2'>LARAVEL</button></div>
                <div class='border-b-2 border-neutral-700'><button class='py-2 pl-3 flex items-center mt-1'><img src='icons/leerjaar1.svg' class='pr-2'>HTML</button></div>
                <button class='py-2 pl-3 flex items-center pt-2'><img src='icons/leerjaar2.svg' class='pr-2'>CSS</button>
            </aside>
        </div>
        <div class='pl-8 pt-8 bg-neutral-900 w-full'>
            <h2 class='text-white font-bold text-4xl mb-6 ml-7'>Goedemorgen Jean!</h2>
            <div class='bg-neutral-700 text-white py-8 px-7 rounded-3xl' style='width: 900px;'>
                <h3 class='text-3xl font-bold'>Wat zijn vandaag de trending topics?</h3>
                <div class='mt-8 flex justify-between'>
                    <div>
                        <div class='flex items-center'><span class='bg-green-500 w-10 h-10 p-2 flex items-center justify-center font-bold text-2xl rounded-full'>1</span><h3 class='text-3xl ml-3 font-bold'>Javascript</h3></div>
                        <div class='flex items-center my-7'><span class='bg-yellow-500 w-10 h-10 p-2 flex items-center justify-center font-bold text-2xl rounded-full'>2</span><h3 class='text-3xl ml-3 font-bold'>Laravel</h3></div>
                        <div class='flex items-center'><span class='bg-orange-600 w-10 h-10 p-2 flex items-center justify-center font-bold text-2xl rounded-full'>3</span><h3 class='text-3xl ml-3 font-bold'>Python</h3></div>
                    </div>
                    <div>
                    <img src='images/grafiek.png' class='rounded-3xl w-2/3 float-right'>
                    </div>
                </div>
            </div>
            <div class='text-white px-7 rounded-3xl flex justify-between items-center' style='width: 1000px;'>
                <h2 class='text-white font-bold text-4xl my-7'>Wie is er op zoek naar hulp?</h2>
                <button class='text-lg text-white px-5 py-1 rounded-full h-12' style='background: #000563'>Stel een vraag</button>
            </div>
        </div>
    <div>
</body>
</html>