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
                pointer-events: auto; /* Changed from none to auto to enable mouse interaction */
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

            for($i = 0; $i < 50; $i++) {
                $size = rand(5, 20);
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
                // Get all particles
                const particles = document.querySelectorAll('.particle');
                
                // Add event listeners to each particle
                particles.forEach(particle => {
                    particle.dataset.speed = (Math.random() * 2 - 1).toFixed(2);
                    
                    // Add the event listener with a direct function reference
                    particle.addEventListener('mouseover', function() {
                        explodeParticle(this);
                    });
                });
                
                // Function to create a new particle
                function createParticle(size, x, y, hue) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.left = `${x}%`;
                    particle.style.top = `${y}%`;
                    particle.style.background = `hsla(${hue}, 70%, 50%, 0.6)`;
                    particle.style.animationDelay = `${Math.random() * 0.5}s`;
                    
                    // Store data attributes for future reference
                    particle.dataset.size = size;
                    particle.dataset.x = x;
                    particle.dataset.y = y;
                    particle.dataset.hue = hue;
                    particle.dataset.speed = (Math.random() * 2 - 1).toFixed(2);
                    
                    // Add to container
                    document.getElementById('particle-container').appendChild(particle);
                    
                    // Add event listener to the new particle
                    particle.addEventListener('mouseover', function() {
                        explodeParticle(this);
                    });
                    
                    return particle;
                }
                
                // Function to explode a particle
                function explodeParticle(particle) {
                    // Get the particle's data
                    const size = parseInt(particle.dataset.size || particle.style.width);
                    const x = parseFloat(particle.dataset.x || particle.style.left);
                    const y = parseFloat(particle.dataset.y || particle.style.top);
                    const hue = parseInt(particle.dataset.hue || 
                                 (particle.style.background.includes('hsla') ? 
                                  particle.style.background.match(/hsla\((\d+)/)[1] : 0));
                    
                    // Don't explode particles that are too small
                    if (size < 4) {
                        particle.remove();
                        return;
                    }
                    
                    // Create smaller particles
                    for (let i = 0; i < 5; i++) {
                        const newSize = size / 2;
                        const newX = x + (Math.random() * 10 - 5);
                        const newY = y + (Math.random() * 10 - 5);
                        const newHue = hue + (Math.random() * 30 - 15);
                        
                        createParticle(newSize, newX, newY, newHue);
                    }
                    
                    // Remove the original particle
                    particle.remove();
                }
                
                // Mouse move effect
                document.addEventListener('mousemove', (e) => {
                    const mouseX = e.clientX;
                    const mouseY = e.clientY;
                    const windowWidth = window.innerWidth;
                    const windowHeight = window.innerHeight;
                    
                    document.querySelectorAll('.particle').forEach(particle => {
                        const speed = parseFloat(particle.dataset.speed || 0);
                        
                        // Calculate the distance-based influence
                        const rect = particle.getBoundingClientRect();
                        const particleX = rect.left + rect.width / 2;
                        const particleY = rect.top + rect.height / 2;
                        
                        const dx = mouseX - particleX;
                        const dy = mouseY - particleY;
                        const distance = Math.sqrt(dx * dx + dy * dy);
                        
                        const maxDistance = 300; // Maximum distance for effect
                        
                        if (distance < maxDistance) {
                            // Stronger effect for closer particles
                            const influence = 1 - distance / maxDistance;
                            const moveX = dx * influence * speed * 0.1;
                            const moveY = dy * influence * speed * 0.1;
                            
                            // Apply the transform
                            particle.style.transform = `translate(${moveX}px, ${moveY}px)`;
                        }
                    });
                });
                
                // Periodically create new particles to replace the ones that exploded
                setInterval(() => {
                    if (document.querySelectorAll('.particle').length < 30) {
                        const size = 5 + Math.random() * 15;
                        const x = Math.random() * 100;
                        const y = Math.random() * 100;
                        const hue = Math.random() * 360;
                        createParticle(size, x, y, hue);
                    }
                }, 2000);
            });
        </script>
    </body>
</html>