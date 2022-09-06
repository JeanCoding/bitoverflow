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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.4.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <title>BitOverflow | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body class='bg-neutral-800'>
    <div class='flex items-center p-3 w-full justify-between'>
        <h2 class='font-bold uppercase text-white text-lg lg:text-xl' style='font-family: Laro'>BitOverflow</h2>
        <button class='text-sm lg:text-lg text-white px-5 py-2 rounded-full flex items-center font-bold' style='background: #000563; font-family: Poppins'>Mijn profiel</button>
    </div>
    <div class='flex'>
        <div class='hidden lg:block'>
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
        <div class='px-4 lg:pl-16 pt-8 bg-neutral-900 pb-12 md:pb-48 w-full' style='box-shadow: 0px 4px 40px 2px rgba(0, 0, 0, 0.25);'>
            <h2 class='text-white  text-2xl lg:text-4xl mb-6 lg:ml-7' style='font-family: Poppins'>Goedemorgen Jean!</h2>
            <div class='bg-neutral-700 text-white py-8 px-7 rounded-3xl lg:w-[900px]' style='font-family: Poppins'>
                <h3 class='text-base lg:text-2xl font'>Wat zijn vandaag de trending topics?</h3>
                <div class='mt-8 flex justify-between'>
                    <div>
                        <div class='flex items-center'><span class='bg-green-500 w-10 h-10 p-2 flex items-center justify-center font-bold text-2xl rounded-full'>1</span><h3 class='text-xl lg:text-2xl ml-3 font-bold'>Javascript</h3></div>
                        <div class='flex items-center my-7'><span class='bg-yellow-500 w-10 h-10 p-2 flex items-center justify-center font-bold text-2xl rounded-full'>2</span><h3 class='text-xl lg:text-2xl ml-3 font-bold'>Laravel</h3></div>
                        <div class='flex items-center'><span class='bg-orange-600 w-10 h-10 p-2 flex items-center justify-center font-bold text-2xl rounded-full'>3</span><h3 class='text-xl lg:text-2xl ml-3 font-bold'>Python</h3></div>
                    </div>
                    <div>
                    <img src='images/grafiek.png' class='rounded-3xl w-2/3 float-right hidden lg:block'>
                    </div>
                </div>
            </div>
            <div class='text-white px-1 lg:px-7 rounded-3xl lg:flex justify-between items-center w-full lg:w-[900px]'>
                <h2 class='text-white font-bold text-xl lg:text-3xl my-7' style='font-family: Poppins'>Wie is er op zoek naar hulp?</h2>
                <button class='text-sm lg:text-lg text-white px-5 py-1 rounded-full h-12 font-bold' style='background: #000563; font-family: Poppins'>Stel een vraag!</button>
            </div>
            <div class='mt-6 lg:mt-0 bg-neutral-700 text-white py-8 px-7 rounded-3xl flex lg:w-[900px]' style='box-shadow: 0px 4px 40px 2px rgba(0, 0, 0, 0.25);'>
                <div class='w-1/2 hidden lg:block'><img src='images/profile.png'></div>
                <div>
                    <div class='pb-2 mb-2 border-b-2 bg-black-500' style='border-color: #606060;'>
                        <p class='text-zinc-500 font-bold text-xs' style='font-family: Laro'>16-08-2022 16:42</p>
                        <p class='text-white font-bold text-xl lg:text-2xl' style='font-family: Poppins'>Dave Havelaar</p>
                        <p class='text-zinc-500 font-bold text-xs uppercase' style='font-family: Laro'>3e jaars</p>
                    </div>
                    <span class='rounded-2xl bg-black px-6 py-1 font-bold text-center mr-2 text-xs' id='tag'>PHP</span>
                    <span class='rounded-2xl bg-black px-6 py-1 font-bold text-center text-xs' id='tag'>SESSIONS</span>
                    <p class='text-zinc-500 font-bold text-xs mt-6 uppercase' style='font-family: Laro'>Onderwerp:</p>
                    <p class='text-white font-bold lg:text-xl break-all' style='font-family: Poppins'>Hoe laat ik een PHP Sessie stoppen na 30 minuten?</p>
                    <p class='text-zinc-500 font-bold text-xs mt-6 uppercase' style='font-family: Laro'>Beschrijving:</p>
                    <p class='text-white font-bold text-lg mb-8' style='font-family: Poppins'>
                            Mijn PHP sessie moet gestopt worden na 30 minuten. Ik heb al meerdere dingen geprobeerd maar hij blijft maar doorgaan. Dit is wat ik al geprobeerd heb:
                    </p>
<div class='bg-black text-white p-4 hidden lg:block rounded-2xl'><code>
useEffect(() =&gt; {
    const allItems = body?.map((item, index) =&gt; {
      switch (item?.__typename) {
        case &#39;ArticleBodyText&#39;:
          return (
            &lt;ArticleBodyText
              key={index}
              dynamic_words={dynamic_words}
              text={item.primary.body_text}
            /&gt;
          );
        case &#39;ArticleBodyImage&#39;:
          return &lt;ArticleBodyImage key={index} item={item} /&gt;;
        case &#39;ArticleBodyEmbed&#39;:
          return (
            &lt;YoutubeEmbed
              key={item?.primary?.embed?.thumbnail_url}
              video={item?.primary?.embed?.html}
            /&gt;
          );
        default:
          break;
      }
      return allItems;
    });

    setItems(allItems);
  }, [body, dynamic_words]);

</code></div>
<div class='w-full flex justify-between items-center mt-12 text-3xl font-bold'>
    <div class='flex'>
    <span class='w-10 h-10 lg:w-12 lg:h-12 p-2 flex items-center justify-center font-bold text-2xl rounded-full mr-6 ml-2' style='background: #5BFF61'><img src='icons/up_arrow.svg'></span>
    <span class='w-10 h-10 lg:w-12 lg:h-12 p-2 flex items-center justify-center font-bold text-2xl rounded-full' style='background: #FF5959'><img src='icons/down_arrow.svg'></span>
    <span class='px-4 py-1 flex items-center justify-center font-bold text-xl lg:text-2xl rounded-3xl ml-6' style='background: #5BFF61; font-family: Poppins'>+12</span>
    </div>
    <span class='hidden lg:block'><button class='bg-gray-200 py-1 px-8 rounded-2xl text-black uppercase text-2xl' style='font-family: Laro'>Antwoord</button></span>
    <span class='w-10 h-10 flex items-center justify-center font-bold rounded-full ml-2 bg-white block lg:hidden'><img class='w-5' src='icons/chat.svg'></span>
</div>
                </div>
            </div>
        </div>
    </div>
    <div class='flex items-center py-8 lg:pl-8 px-6 lg:px-0 lg:pr-24 w-full justify-between w-full' style='font-family: Laro'>
            <h2 class='font-bold uppercase text-white text-lg lg:ml-48'>BitOverflow</h2>
            <div>
                <ul class='text-x lg:text-lg'>
                    <li class='font-bold uppercase text-white'>Guidelines</li>
                    <li class='font-bold uppercase text-white'>Privacy</li>
                    <li class='font-bold uppercase text-white'>Disclaimer</li>
                    <li class='font-bold uppercase text-white'>Bit-Academy</li>
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
    for(let i = 0, l = elements.length; i < l; i++) {
        const tagcolor = colors[Math.floor(Math.random()*colors.length)];
    elements[i].style.color = tagcolor;
    }
</script>