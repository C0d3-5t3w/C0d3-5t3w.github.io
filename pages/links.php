<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/main.css">
        <title>Links</title>
        <style>
            body {
                background-color: black;
                color: white;
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
            }
            h1 {
                color: white;
            }
            ul {
                list-style: none;
                padding: 0;
            }
            li {
                background: lightgray;
                color: black;
                margin: 10px 0;
                padding: 15px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            a {
                color: black;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
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
    </body>
</html>