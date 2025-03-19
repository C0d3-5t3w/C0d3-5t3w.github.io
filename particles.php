<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/alt.css">
        <title>particles</title>
        <style>
            .particle {
                position: absolute;
                border-radius: 50%;
                pointer-events: none;
                animation: float 3s infinite;
            }
            @keyframes float {
                0% { transform: translateY(0); }
                50% { transform: translateY(-20px); }
                100% { transform: translateY(0); }
            }
        </style>
    </head>
    <body>
        <?php
        for($i = 0; $i < 50; $i++) {
            $size = rand(5, 20);
            $x = rand(0, 100);
            $y = rand(0, 100);
            $hue = rand(0, 360);
            echo "<div class='particle' style='
                width: {$size}px;
                height: {$size}px;
                left: {$x}%;
                top: {$y}%;
                background: hsla({$hue}, 70%, 50%, 0.6);
                animation-delay: " . ($i * 0.1) . "s;
            '></div>";
        }
        ?>
        <div class="content">
            <h1>
            <a href="index.html" style="color: white;">Home</a>
            </h1>
        </div>
        <script>
            //document.addEventListener('mousemove', (e) => {
                //document.querySelectorAll('.particle').forEach(particle => {
                    //const speed = Math.random() * 2 - 1;
                    //const x = (e.clientX * speed) / 50;
                    //const y = (e.clientY * speed) / 50;
                    //particle.style.transform = `translate(${x}px, ${y}px)`;
                //});
            //});
            document.querySelectorAll('.particle').forEach(particle => {
                particle.dataset.speed = Math.random() * 2 - 1;
            });
            document.addEventListener('mousemove', (e) => {
                document.querySelectorAll('.particle').forEach(particle => {
                    const speed = parseFloat(particle.dataset.speed);
                    const x = (e.clientX * speed) / 50;
                    const y = (e.clientY * speed) / 50;
                    particle.style.transform = `translate(${x}px, ${y}px)`;
                });
            });
        </script>
    </body>
</html>
<!-- -->
