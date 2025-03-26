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
                animation: float 3s infinite;
                transition: transform 0.3s ease-out;
                z-index: 10;
            }
            @keyframes float {
                0% { transform: translateY(0); }
                50% { transform: translateY(-20px); }
                100% { transform: translateY(0); }
            }
            .content {
                position: relative;
                z-index: 100;
            }
            body {
                overflow-x: hidden;
                min-height: 100vh;
            }
        </style>
    </head>
    <body>
        <div id="particle-container">
            <?php
            header("Cache-Control: no-cache, must-revalidate");
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

            for($i = 0; $i < 1000; $i++) { 
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
                    animation-delay: " . ($i * 0.1) . "s;
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
                
                particles.forEach(particle => {
                    particle.dataset.speed = (Math.random() * 2 - 1).toFixed(2);
                    particle.dataset.velX = (Math.random() * 2 - 1).toFixed(2);
                    particle.dataset.velY = (Math.random() * 2 - 1).toFixed(2);
                    
                    particle.addEventListener('mouseover', function() {
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
                    particle.style.animationDelay = `${Math.random() * 0.5}s`;
                    
                    particle.dataset.size = size;
                    particle.dataset.x = x;
                    particle.dataset.y = y;
                    particle.dataset.hue = hue;
                    particle.dataset.speed = (Math.random() * 2 - 1).toFixed(2);
                    particle.dataset.velX = (Math.random() * 2 - 1).toFixed(2);
                    particle.dataset.velY = (Math.random() * 2 - 1).toFixed(2);
                    
                    document.getElementById('particle-container').appendChild(particle);
                    
                    particle.addEventListener('mouseover', function() {
                        explodeParticle(this);
                    });
                    
                    return particle;
                }
                
                function explodeParticle(particle) {
                    const size = parseInt(particle.dataset.size || particle.style.width);
                    const x = parseFloat(particle.dataset.x || particle.style.left);
                    const y = parseFloat(particle.dataset.y || particle.style.top);
                    const hue = parseInt(particle.dataset.hue || 
                                 (particle.style.background.includes('hsla') ? 
                                  particle.style.background.match(/hsla\((\d+)/)[1] : 0));
                    
                    if (size < 4) {
                        particle.remove();
                        return;
                    }
                    
                    for (let i = 0; i < 5; i++) {
                        const newSize = size / 2;
                        const newX = x + (Math.random() * 10 - 5);
                        const newY = y + (Math.random() * 10 - 5);
                        const newHue = hue + (Math.random() * 30 - 15);
                        
                        createParticle(newSize, newX, newY, newHue);
                    }
                    
                    particle.remove();
                }
                
                function checkCollisions() {
                    const particleArray = Array.from(document.querySelectorAll('.particle'));
                    
                    for (let i = 0; i < particleArray.length; i++) {
                        for (let j = i + 1; j < particleArray.length; j++) {
                            const p1 = particleArray[i];
                            const p2 = particleArray[j];
                            
                            const p1Rect = p1.getBoundingClientRect();
                            const p2Rect = p2.getBoundingClientRect();
                            
                            const p1X = p1Rect.left + p1Rect.width / 2;
                            const p1Y = p1Rect.top + p1Rect.height / 2;
                            const p2X = p2Rect.left + p2Rect.width / 2;
                            const p2Y = p2Rect.top + p2Rect.height / 2;
                            
                            const dx = p2X - p1X;
                            const dy = p2Y - p1Y;
                            const distance = Math.sqrt(dx * dx + dy * dy);
                            
                            const minDistance = (p1Rect.width + p2Rect.width) / 2;
                            
                            if (distance < minDistance) {
                                const tempVelX = p1.dataset.velX;
                                const tempVelY = p1.dataset.velY;
                                
                                p1.dataset.velX = p2.dataset.velX;
                                p1.dataset.velY = p2.dataset.velY;
                                
                                p2.dataset.velX = tempVelX;
                                p2.dataset.velY = tempVelY;
                                
                                const angle = Math.atan2(dy, dx);
                                const pushX = Math.cos(angle) * 2;
                                const pushY = Math.sin(angle) * 2;
                                
                                p1.style.transform = `translate(${-pushX}px, ${-pushY}px)`;
                                p2.style.transform = `translate(${pushX}px, ${pushY}px)`;
                            }
                        }
                    }
                }
                
                function moveParticles() {
                    document.querySelectorAll('.particle').forEach(particle => {
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
                    const windowWidth = window.innerWidth;
                    const windowHeight = window.innerHeight;
                    
                    document.querySelectorAll('.particle').forEach(particle => {
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
                    checkCollisions();
                    
                    if (document.querySelectorAll('.particle').length < 600) {
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