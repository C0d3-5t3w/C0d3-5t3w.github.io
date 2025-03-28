<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/main.css">
        <title>Links</title>
        <style>
            body {
                margin: 0;
                padding: 0;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                color: var(--primary-color);
                background-color: var(--background-color);
                position: relative;
                align-items: center;
                padding: 20px;
            }
            h1 {
                color: var(--primary-color);
                background-color: var(--accent-red);
                border: 1px solid var(--primary-color);
                padding: 10px;
                margin: 20px 0;
                width: 100%;
                text-align: center;
            }
            ul {
                list-style: none;
                padding: 0;
                width: 100%;
                max-width: 800px;
            }
            li {
                background: var(--dark-bg);
                color: var(--primary-color);
                margin: 10px 0;
                padding: 15px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
                border: 1px solid var(--primary-color);
            }
            a {
                color: var(--accent-teal);
                text-decoration: none;
            }
            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body class="content">
        <h1>Personal Links:</h1>
        <ul>
            <li><a href="https://github.com/C0d3-5t3w">GitHub Profile</a></li>
            <li><a href="https://github.com/C0d3-5t3w/c0d3-5t3w.github.io">GitHub Repository</a></li>
            <li><a href="https://m.soundcloud.com/brandon-stewart-792686080">SoundCloud Profile</a></li>
            <!-- <li><a href="link">text</a></li> for easy copy and paste since I keep editing from mobile -->
        </ul>
        <h2>
            <a href="../index.html" style="color: white;">Home</a>
        </h2>
        <script src="../assets/js/alt.js"></script>
    </body>
</html>