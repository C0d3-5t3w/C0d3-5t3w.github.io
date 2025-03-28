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
    <link rel="stylesheet" href="../assets/css/alt.css">
    <title>FlappyZig Game</title>
</head>
<body>
    <h2>
        <script src="../assets/js/altdropdown.js"></script>
    </h2>
    <div class="game-container">
        <div class="game-overlay"></div>
        <div class="canvas">
            <script src="../assets/js/FlappyZig.js" class="canvas"></script>
        </div>
        <div id="controls" class="game-controls">
            <h3>Controls:</h3>
            <p>Desktop: SPACE to jump, G to shoot</p>
            <p>Mobile: Tap left half to jump, right half to shoot</p>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const controls = document.getElementById('controls');

            function hideControls() {
                controls.classList.add('fade-out');
                setTimeout(() => {
                    controls.style.display = 'none';
                }, 300);
            }

            document.addEventListener('click', hideControls);
            document.addEventListener('keydown', function(event) {
                if (event.code === 'Space') {
                    hideControls();
                }
            });
        });
    </script>
</body>
</html>