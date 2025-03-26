<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>particles</title>
    <style>
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: auto;
            transition: transform 0.3s ease-out, background 0.3s ease;
            z-index: 10;
            cursor: pointer;
        }
        @keyframes explode {
            0% { transform: scale(1) rotate(0deg); opacity: 1; }
            50% { transform: scale(1.5) rotate(180deg); opacity: 0.7; }
            100% { transform: scale(2) rotate(360deg); opacity: 0; }
        }
        .exploding {
            animation: explode 0.5s forwards !important;
            pointer-events: none;
        }
        .content {
            position: relative;
            z-index: 100;
        }
        body {
            overflow-x: hidden;
            min-height: 100vh;
        }
        #particle-stats {
            position: fixed;
            bottom: 10px;
            right: 10px;
            color: white;
            background: linear-gradient(45deg, red, teal, gold);
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div id="particle-stats">Particles: <span id="particle-count">0</span></div>
    <div id="particle-container">
        <?php
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

        for($i = 0; $i < 250; $i++) { 
            $size = rand(10, 30); 
            $x = rand(0, 100);
            $y = rand(0, 100);
            $hue = rand(0, 360);
            echo "<div class='particle' 
                data-size='{$size}'
                data-x='{$x}'
                data-y='{$y}'
                data-hue='{$hue}'
                style='
                width: {$size}px;
                height: {$size}px;
                left: {$x}%;
                top: {$y}%;
                background: hsla({$hue}, 70%, 50%, 0.6);
            '></div>";
        }
        ?>
    </div>
    <div class="content">
        <h1>
        <a href="index.html" style="color: white;">Home</a>
        </h1>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const particles = document.querySelectorAll('.particle');
            const particleContainer = document.getElementById('particle-container');
            const particleCountDisplay = document.getElementById('particle-count');
            
            function updateParticleCount() {
                particleCountDisplay.textContent = document.querySelectorAll('.particle').length;
            }
            updateParticleCount();
            
            particles.forEach(particle => {
                particle.addEventListener('mouseenter', function(e) {
                    e.stopPropagation();
                    explodeParticle(this);
                });

                particle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    explodeParticle(this);
                });
            });
            
            function createParticle(size, x, y, hue) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${x}%`;
                particle.style.top = `${y}%`;
                particle.style.background = `hsla(${hue}, 70%, 50%, 0.6)`;
                
                particle.dataset.size = size;
                particle.dataset.x = x;
                particle.dataset.y = y;
                particle.dataset.hue = hue;
                
                particleContainer.appendChild(particle);
                
                particle.addEventListener('mouseenter', function(e) {
                    e.stopPropagation();
                    explodeParticle(this);
                });

                particle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    explodeParticle(this);
                });
                
                updateParticleCount();
                return particle;
            }
            
            function explodeParticle(particle) {
                const size = parseFloat(particle.dataset.size);
                const x = parseFloat(particle.dataset.x);
                const y = parseFloat(particle.dataset.y);
                const hue = parseInt(particle.dataset.hue);

                console.log('Exploding particle:', size, x, y, hue);
                
                if (size < 5) {
                    particle.remove();
                    updateParticleCount();
                    return;
                }
                
                particle.classList.add('exploding');
                
                const numChildren = Math.min(Math.floor(size / 2), 8);
                
                for (let i = 0; i < numChildren; i++) {
                    const newSize = Math.max(size / 2, 5); 
                    const angle = (i / numChildren) * Math.PI * 2; 
                    const distance = size / 2; 
                    
                    const newX = x + (Math.cos(angle) * distance * 0.1) + (Math.random() * 5 - 2.5);
                    const newY = y + (Math.sin(angle) * distance * 0.1) + (Math.random() * 5 - 2.5);
                    
                    const newHue = (hue + Math.random() * 60 - 30) % 360;
                    
                    createParticle(newSize, newX, newY, newHue);
                }
                
                setTimeout(() => {
                    particle.remove();
                    updateParticleCount();
                }, 500); 
            }

            document.addEventListener('touchstart', function(e) {
                const touch = e.touches[0];
                const element = document.elementFromPoint(touch.clientX, touch.clientY);
                if (element && element.classList.contains('particle')) {
                    explodeParticle(element);
                }
            });
        });
    </script>
</body>
</html>