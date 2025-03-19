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
            .content {
                position: relative;
                z-index: 1;
            }
        </style>
    </head>
    <body>
        <?php
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

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
            function createParticle(size, x, y, hue) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${x}%`;
                particle.style.top = `${y}%`;
                particle.style.background = `hsla(${hue}, 70%, 50%, 0.6)`;
                particle.style.animationDelay = `${Math.random() * 0.5}s`;
                particle.dataset.speed = Math.random() * 2 - 1;
                document.body.appendChild(particle);
                particle.addEventListener('mouseover', () => explodeParticle(particle));
            }

            function explodeParticle(particle) {
                const size = parseInt(particle.style.width);
                const x = parseFloat(particle.style.left);
                const y = parseFloat(particle.style.top);
                const hue = parseInt(particle.style.background.match(/hsla\((\d+)/)[1]);

                for (let i = 0; i < 5; i++) {
                    createParticle(size / 2, x + Math.random() * 10 - 5, y + Math.random() * 10 - 5, hue + Math.random() * 20 - 10);
                }

                particle.remove();
            }

            document.querySelectorAll('.particle').forEach(particle => {
                particle.dataset.speed = Math.random() * 2 - 1;
                particle.addEventListener('mouseover', () => explodeParticle(particle));
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