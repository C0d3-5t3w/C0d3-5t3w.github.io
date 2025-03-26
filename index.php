<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

$quotes = [
    "Code is like humor. When you have to explain it, it's bad.",
    "Fix the cause, not the symptom.",
    "Optimism is an occupational hazard of programming: feedback is the treatment.",
    "When to use iterative development? You should use iterative development only on projects that you want to succeed.",
    "Simplicity is the soul of efficiency.",
    "Before software can be reusable it first has to be usable.",
    "Make it work, make it right, make it fast.",
    "Cooking is like programming: you follow a recipe until you know what you're doing.",
    "Both cooking and coding require patience, precision, and creativity.",
    "Debugging and tasting are both iterative processes of refinement.",
    "The best chefs and the best programmers know when to follow the rules and when to break them.",
    "Refactoring code is like reducing a sauce - you're concentrating flavor and removing excess.",
    "Cooking without tasting is like programming without testing.",
    "Clean code is like a clean kitchen - it makes everything else easier.",
    "Both cooking and coding start with raw ingredients and end with something valuable.",
    "Good documentation is like a good recipe - it helps others reproduce your success.",
    "Cooking and coding both benefit from peer review.",
    "Scalable recipes and scalable code share many design principles.",
    "Both chefs and developers know the importance of proper tools.",
    "Comments in code are like notes in a recipe margin.",
    "Cooking and coding both require understanding the underlying principles, not just following instructions.",
    "Good error handling is like knowing how to fix a broken sauce.",
    "The best dishes and the best programs are elegant in their simplicity.",
    "Memory management in programming is like inventory management in a kitchen.",
    "Technical debt is like a messy kitchen - eventually you have to clean it up.",
    "Both cooking and coding reward experimentation within constraints.",
    "In both cooking and coding, sometimes you have to break things to make them better.",
    "A good programmer writes code that humans can understand, just like a good chef makes dishes anyone can enjoy.",
    "The hardest bugs to find are those where your mental model of the code doesn't match the actual code.",
    "In cooking and programming, the right balance of ingredients is everything.",
    "A watched pot never boils, and a watched progress bar never completes.",
    "The best cooking and coding happen when you understand the 'why' behind every step.",
    "Writing code is like creating a recipe - both need structure, clarity, and creativity.",
    "Cooking and coding both require understanding how individual components affect the entire system.",
    "Just as spices can transform a dish, the right algorithm can transform software.",
    "Reusable code is like a versatile sauce - it serves many purposes.",
    "There are multiple ways to peel an orange, just as there are multiple ways to solve a problem.",
    "Debugging is twice as hard as writing the code in the first place - just like fixing an overseasoned dish.",
    "Optimization without measurement is like adjusting a recipe without tasting.",
    "If builders built buildings the way programmers wrote programs, the first woodpecker would destroy civilization.",
    "Like a soufflé, good code requires attention to detail and proper timing.",
    "The most important ingredient in both cooking and coding is patience.",
    "Programmers and chefs are both artists working in different mediums.",
    "The best part of cooking and coding is the constant learning process.",
    "Code should be written as if the person maintaining it is a violent psychopath who knows where you live.",
    "Cooking and coding both fail when you don't pay attention to the details.",
    "Both chefs and programmers know that simplicity often yields the best results.",
    "You can't make an omelette without breaking eggs; you can't develop software without breaking builds.",
    "In cooking and coding, the difference between good and great is often a willingness to start over.",
    "Always code and cook as if the person who will maintain your work is a violent psychopath who knows where you live.",
    "A finger pointing at the moon is not the moon; a specification pointing at a system is not the system.",
    "Just as you taste food while cooking, you should test code while programming."
];

$random_quote = $quotes[array_rand($quotes)];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/main.css">
        <title>C0D3-5T3W</title>
        <style>
            .quote-button {
                background: rgba(251, 42, 255, 0.4);
                border: 1px solid white;
                color: white;
                padding: 8px 15px;
                border-radius: 5px;
                cursor: pointer;
                margin-top: 10px;
                transition: all 0.3s;
            }
            .quote-button:hover {
                background: rgba(251, 42, 255, 0.7);
            }
            .quote-of-the-day {
                position: relative;
            }
            #quote-text {
                min-height: 80px;
                transition: opacity 0.3s ease;
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 15px;
                background: rgba(0, 0, 0, 0.2);
                border-radius: 10px;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <img src="assets/images/THELOGO.jpg" alt="5T3W Logo" class="logo">
            <h1>
                C0D3-5T3W
            </h1>
            <h1>
                Welcome!
            </h1>
            <h3 class="about-container">
                <div id="typing-title"></div>
                <div id="typing-content" class="typing-content">
                    <p class="typing-text">
                        -----------------------------
                    </p>                    

                    <p class="typing-text">
                        I like cooking, making Trench tunes, and messing around with code.
                    </p>
                    <p class="typing-text">
                        -----------------------------
                    </p>
                    <p class="typing-text">
                        I am currently learning Golang/C and JavaScript/Typescript.
                    </p>
                    <p class="typing-text">
                        -----------------------------
                    </p>
                    <p class="typing-text">
                        I grew up using a lot of Python because of Raspberry Pi's.
                    </p>
                    <p class="typing-text">
                        -----------------------------
                    </p>
                    <p class="typing-text">
                        My favorite food is Thai.
                    </p>
                    <p class="typing-text">
                        -----------------------------
                    </p>
                    <p class="typing-text">
                        My favorite musician is INFEKT
                    </p>
                    <p class="typing-text">
                        -----------------------------
                    </p>
                    <p class="typing-text">
                        I love my Fiance and my 2 perfect kitties Patience and Ziggy.
                    </p>
                    <p class="typing-text">
                        -----------------------------
                    </p>
                    <p class="typing-text">
                        And I love skating and taking Ziggy for walks with my partner.😸
                    </p>
                </div>
            </h3>
            <h2>
                <a href="pictures.html" style="color: white;">Pictures</a>                
            </h2>
            <h2>
                <a href="FlappyZig.html" style="color: white;">Play FlappyZig</a>
            </h2>
            <h2>
                <a href="particles.html" style="color: white;">Particles</a>
            </h2>
            <div id="soundcloud-widget" class="widget-container">
                <iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/1947466211&color=%23040404&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe><div style="font-size: 10px; color: #cccccc;line-break: anywhere;word-break: normal;overflow: hidden;white-space: nowrap;text-overflow: ellipsis; font-family: Interstate,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Garuda,Verdana,Tahoma,sans-serif;font-weight: 100;"><a href="https://soundcloud.com/brandon-stewart-792686080" title="5T3W 🥦" target="_blank" style="color: #cccccc; text-decoration: none;">5T3W 🥦</a> · <a href="https://soundcloud.com/brandon-stewart-792686080/fa1l1ng" title="FA1L1NG" target="_blank" style="color: #cccccc; text-decoration: none;">FA1L1NG</a></div>
            </div>
            <div id="spotify-widget" class="widget-container">
                <iframe style="border-radius:12px" src="https://open.spotify.com/embed/artist/1Cg54cIvfa7dz1GuYHvgAd?utm_source=generator&theme=0" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>                
            </div>
            <div class="quote-of-the-day">
                <h1>Random quote:</h1>
                <div id="quote-text">
                    <h3><p id="quote-content"><?php echo $random_quote; ?></p></h3>
                </div>
            </div>
        </div>
        <script src="assets/js/main.js"></script>
    </body>
</html>