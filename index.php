<?php
$quotes = [
    "Code is like humor. When you have to explain it, it’s bad.",
    "Fix the cause, not the symptom.",
    "Optimism is an occupational hazard of programming: feedback is the treatment.",
    "When to use iterative development? You should use iterative development only on projects that you want to succeed.",
    "Simplicity is the soul of efficiency.",
    "Before software can be reusable it first has to be usable.",
    "Make it work, make it right, make it fast."
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
    </head>
    <body>
        <div class="content">
            <img src="assets/images/THELOGO.jpg" alt="5T3W Logo" class="logo">
            <h1>
                C0D3
            </h1>
            <h2>
                5T3W
            </h2>
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
                <h2>Quote of the Day:</h2>
                <p><?php echo $random_quote; ?></p>
            </div>
        </div>
        <script src="assets/js/main.js"></script>
    </body>
</html>