<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/css/main.css"> -->
    <title>FlappyZig Game</title>
    <style>        
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: linear-gradient(45deg, red, teal, gold);
        }

        canvas {
            display: block;
            width: 100vw;
            height: 100vh;
        }

        .home-link {
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 10px;
            font-family: Arial, sans-serif;
        }

        .home-link:hover {
            text-decoration: underline;
        }

        #controls {
            position: absolute;
            bottom: 0;
            width: 100%;
            color: white;
            text-align: center;
            padding: 20px;
            font-family: Arial, sans-serif;
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <a href="index.html" class="home-link">Home</a>
    <div class="canvas">
        <script src="assets/js/FlappyZig.js" class="canvas"></script>
    </div>
    <div id="controls">
        <h3>Controls:</h3>
        <p>Desktop: SPACE to jump, G to shoot</p>
        <p>Mobile: Tap left half to jump, right half to shoot</p>
    </div>
</body>
</html>