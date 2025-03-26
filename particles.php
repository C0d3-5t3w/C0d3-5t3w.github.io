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
                particle.dataset.speed = (Math.random() * 2 - 1).toFixed(2);
                particle.dataset.velX = (Math.random() * 2 - 1).toFixed(2);
                particle.dataset.velY = (Math.random() * 2 - 1).toFixed(2);
                
                particle.addEventListener('mouseenter', function(e) {
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
                particle.dataset.speed = (Math.random() * 2 - 1).toFixed(2);
                particle.dataset.velX = (Math.random() * 2 - 1).toFixed(2);
                particle.dataset.velY = (Math.random() * 2 - 1).toFixed(2);
                
                particleContainer.appendChild(particle);
                
                particle.addEventListener('mouseenter', function(e) {
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
                    
                    const childParticle = createParticle(newSize, newX, newY, newHue);
                    
                    childParticle.dataset.velX = (Math.cos(angle) * 2 + Math.random() - 0.5).toFixed(2);
                    childParticle.dataset.velY = (Math.sin(angle) * 2 + Math.random() - 0.5).toFixed(2);
                }
                
                setTimeout(() => {
                    particle.remove();
                    updateParticleCount();
                }, 500); 
            }
            
            function moveParticles() {
                document.querySelectorAll('.particle:not(.exploding)').forEach(particle => {
                    const rect = particle.getBoundingClientRect();
                    const x = rect.left;
                    const y = rect.top;
                    
                    let velX = parseFloat(particle.dataset.velX || 0);
                    let velY = parseFloat(particle.dataset.velY || 0);
                    
                    particle.style.left = `${(x + velX) / window.innerWidth * 100}%`;
                    particle.style.top = `${(y + velY) / window.innerHeight * 100}%`;
                    
                    if (x < 0 || x > window.innerWidth - rect.width) {
                        particle.dataset.velX = (-velX).toFixed(2);
                    }
                    
                    if (y < 0 || y > window.innerHeight - rect.height) {
                        particle.dataset.velY = (-velY).toFixed(2);
                    }
                });
            }
            
            document.addEventListener('mousemove', (e) => {
                const mouseX = e.clientX;
                const mouseY = e.clientY;
                
                document.querySelectorAll('.particle:not(.exploding)').forEach(particle => {
                    const speed = parseFloat(particle.dataset.speed || 0);
                    
                    const rect = particle.getBoundingClientRect();
                    const particleX = rect.left + rect.width / 2;
                    const particleY = rect.top + rect.height / 2;
                    
                    const dx = mouseX - particleX;
                    const dy = mouseY - particleY;
                    const distance = Math.sqrt(dx * dx + dy * dy);
                    
                    const maxDistance = 300; 
                    
                    if (distance < maxDistance) {
                        const influence = 1 - distance / maxDistance;
                        const moveX = dx * influence * speed * 0.1;
                        const moveY = dy * influence * speed * 0.1;
                        
                        particle.style.transform = `translate(${moveX}px, ${moveY}px)`;
                    }
                });
            });
            
            setInterval(() => {
                moveParticles();
                
                const currentCount = document.querySelectorAll('.particle').length;
                
                if (currentCount < 600) {
                    const size = 10 + Math.random() * 20; 
                    const x = Math.random() * 100;
                    const y = Math.random() * 100;
                    const hue = Math.random() * 360;
                    createParticle(size, x, y, hue);
                }
            }, 100);
        });
    </script>
</body>
</html>