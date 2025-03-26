<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>FlappyZig Game</title>
    <style>        
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #000000;
        }

        canvas {
            display: block;
            margin: auto;
            max-width: 100%;
            max-height: 100%;
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
    </style>
</head>
<body class="body">
    <a href="index.html" class="home-link">Home</a>
    <div class="canvas">
    <script src="assets/js/FlappyZig.js" class="canvas"></script>
    </div>
    <div id="controls" style="bottom: 0; color: white; text-align: center; padding: 20px; font-family: Arial, sans-serif;">
        <h3>Controls:</h3>
        <p>Desktop: SPACE to jump, G to shoot</p>
        <p>Mobile: Tap left half to jump, right half to shoot</p>
    </div>
</body>
</html>