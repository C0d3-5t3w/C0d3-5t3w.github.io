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
    <title>particles</title>
    <style>
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: auto;
            transition: transform 0.3s ease-out, background 0.3s ease;
            z-index: 10;
            cursor: pointer;
            border: 1px solid rgba(255, 255, 255, 0.1);
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
        .flash {
            position: absolute;
            background: var(--primary-color);
            border-radius: 50%;
            opacity: 0;
            animation: flash 0.1s forwards;
        }
        @keyframes flash {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }
        .content {
            position: relative;
            z-index: 100;
        }
        body {
            background-color: var(--background-color);
            overflow-x: hidden;
            min-height: 100vh;
        }
        #particle-stats {
            position: fixed;
            bottom: 10px;
            right: 10px;
            color: var(--primary-color);
            background: var(--accent-teal);
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
            z-index: 1000;
            border: 1px solid var(--primary-color);
        }
    </style>
</head>
<body>
    <div id="particle-stats" class="terminal-text">Particles: <span id="particle-count">0</span></div>
    
    <div class="particle-controls">
        <h3>Particle Controls</h3>
        <div class="control-item">
            <label for="particle-size">Size:</label>
            <input type="range" id="particle-size" min="5" max="50" value="20">
        </div>
        <div class="control-item">
            <label for="particle-speed">Speed:</label>
            <input type="range" id="particle-speed" min="1" max="10" value="5">
        </div>
        <button id="add-particles" class="pulse-button">Add More Particles</button>
    </div>
    
    <div id="particle-container">
        <?php
        for($i = 0; $i < 250; $i++) { 
            $size = rand(10, 30); 
            $x = rand(0, 100);
            $y = rand(0, 100);
            $hue = rand(0, 360);
            echo "<div class='particle enhanced' 
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
    <div class="content page-content">
    <script src="../assets/js/altdropdown.js"></script>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const particles = document.querySelectorAll('.particle');
            const particleContainer = document.getElementById('particle-container');
            const particleCountDisplay = document.getElementById('particle-count');
            const screenWidth = window.innerWidth;
            const screenHeight = window.innerHeight;
            
            // Add new controls functionality
            const sizeSlider = document.getElementById('particle-size');
            const speedSlider = document.getElementById('particle-speed');
            const addButton = document.getElementById('add-particles');
            
            let particleSpeed = 5;
            
            sizeSlider.addEventListener('change', function() {
                const newSize = this.value;
                document.querySelectorAll('.particle').forEach(p => {
                    p.style.width = `${newSize}px`;
                    p.style.height = `${newSize}px`;
                });
            });
            
            speedSlider.addEventListener('change', function() {
                particleSpeed = this.value;
            });
            
            addButton.addEventListener('click', function() {
                for (let i = 0; i < 25; i++) {
                    const size = sizeSlider.value;
                    const x = Math.random() * 100;
                    const y = Math.random() * 100;
                    const hue = Math.random() * 360;
                    createParticle(size, x, y, hue);
                }
            });
            
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
            
            function createParticle(size, x, y, hue, angle = null, distance = null) {
                const particle = document.createElement('div');
                particle.className = 'particle enhanced';
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${x}%`;
                particle.style.top = `${y}%`;
                particle.style.background = `hsla(${hue}, 70%, 50%, 0.6)`;
                particle.style.boxShadow = `0 0 15px var(--alt-glow)`;
                
                particle.dataset.size = size;
                particle.dataset.x = x;
                particle.dataset.y = y;
                particle.dataset.hue = hue;
                particle.dataset.angle = angle;
                particle.dataset.distance = distance;
                
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
                moveParticle(particle);
                return particle;
            }
            
            function explodeParticle(particle) {
                const size = parseFloat(particle.dataset.size);
                const x = parseFloat(particle.dataset.x);
                const y = parseFloat(particle.dataset.y);
                const hue = parseInt(particle.dataset.hue);

                console.log('Exploding particle:', size, x, y, hue);
                
                const flash = document.createElement('div');
                flash.className = 'flash';
                flash.style.width = `${size}px`;
                flash.style.height = `${size}px`;
                flash.style.left = `${x}%`;
                flash.style.top = `${y}%`;
                particleContainer.appendChild(flash);
                setTimeout(() => flash.remove(), 100);

                if (size < 5) {
                    particle.remove();
                    updateParticleCount();
                    return;
                }
                
                particle.classList.add('exploding');
                
                const numChildren = Math.min(Math.floor(size / 2), 5);
                
                for (let i = 0; i < numChildren; i++) {
                    const newSize = Math.max(size / 2, 5); 
                    const angle = (i / numChildren) * Math.PI * 2; 
                    const distance = Math.min(screenWidth, screenHeight) / 2;
                    
                    const newX = x + (Math.cos(angle) * distance * 0.01);
                    const newY = y + (Math.sin(angle) * distance * 0.01);
                    
                    const newHue = (hue + Math.random() * 60 - 30) % 360;
                    
                    createParticle(newSize, newX, newY, newHue, angle, distance);
                }
                
                setTimeout(() => {
                    particle.remove();
                    updateParticleCount();
                }, 500); 
            }

            function moveParticle(particle) {
                const angle = parseFloat(particle.dataset.angle);
                const distance = parseFloat(particle.dataset.distance);
                let speed = 0.1;
                const deceleration = speed / (5 * 60); 

                function move() {
                    if (speed <= 0) return;
                    
                    const x = parseFloat(particle.dataset.x);
                    const y = parseFloat(particle.dataset.y);
                    const newX = x + Math.cos(angle) * speed;
                    const newY = y + Math.sin(angle) * speed;

                    particle.style.left = `${newX}%`;
                    particle.style.top = `${newY}%`;

                    particle.dataset.x = newX;
                    particle.dataset.y = newY;

                    speed -= deceleration;

                    requestAnimationFrame(move);
                }

                move();
            }

            function checkAndRespawnParticles() {
                const particleCount = document.querySelectorAll('.particle').length;
                if (particleCount < 50) {
                    for (let i = 0; i < 10; i++) {
                        const size = rand(10, 30); 
                        const x = rand(0, 100);
                        const y = rand(0, 100);
                        const hue = rand(0, 360);
                        createParticle(size, x, y, hue);
                    }
                }
            }

            function rand(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }

            setInterval(checkAndRespawnParticles, 3000);

            document.addEventListener('touchstart', function(e) {
                const touch = e.touches[0];
                const element = document.elementFromPoint(touch.clientX, touch.clientY);
                if (element && element.classList.contains('particle')) {
                    explodeParticle(element);
                }
            });
        });
    </script>
    <script src="../assets/js/alt.js"></script>
</body>
</html>