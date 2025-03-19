document.addEventListener("DOMContentLoaded", function(){
    class Particle {
        constructor(x, y) {
            this.x = x;
            this.y = y;
            this.chars = ['5', 'T', '3', 'W'];
            this.char = this.chars[Math.floor(Math.random() * this.chars.length)];
            this.vx = (Math.random() - 0.5) * 2;
            this.vy = (Math.random() - 0.5) * 2;
            this.pushForce = { x: 0, y: 0 };
        }

        update() {
            this.vx += this.pushForce.x;
            this.vy += this.pushForce.y;
            this.x += this.vx;
            this.y += this.vy;
            
            this.pushForce.x *= 0.95;
            this.pushForce.y *= 0.95;
            this.vx *= 0.99;
            this.vy *= 0.99;
        }

        draw(ctx) {
            ctx.font = '15px monospace';
            ctx.fillStyle = `rgba(251, 42, 255, 0.75)`;
            ctx.fillText(this.char, this.x, this.y);
        }
    }

    class ParticleSystem {
        constructor() {
            this.canvas = document.createElement('canvas');
            this.canvas.style.position = 'fixed';
            this.canvas.style.top = '0';
            this.canvas.style.left = '0';
            this.canvas.style.width = '100%';
            this.canvas.style.height = '100%';
            this.canvas.style.zIndex = '1';
            document.body.prepend(this.canvas);
            
            this.ctx = this.canvas.getContext('2d');
            this.particles = [];
            this.resizeTimeout = null;
            this.animate = this.animate.bind(this);
            this.maxParticles = 100;
            this.init();
            window.addEventListener('resize', () => this.init());
            this.lastFrame = 0;
            this.fps = 32; 
            this.canvas.__particles__ = this.particles; 
            this.animate();
        }
        
        init() {
            this.canvas.width = window.innerWidth;
            this.canvas.height = window.innerHeight;
            
            this.particles = [];
            for (let i = 0; i < this.maxParticles; i++) {
                const x = Math.random() * this.canvas.width;
                const y = Math.random() * this.canvas.height;
                this.particles.push(new Particle(x, y));
            }
            this.canvas.__particles__ = this.particles;
        }
        
        animate(timestamp) {
            if (!this.lastFrame) this.lastFrame = timestamp;
            const elapsed = timestamp - this.lastFrame;
            
            if (elapsed > (1000 / this.fps)) {
                this.ctx.fillStyle = 'rgba(0, 0, 0, .1)';
                this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
                
                this.particles.forEach(particle => {
                    particle.update();
                    particle.draw(this.ctx);
                    
                    if (particle.x < 0) particle.x = this.canvas.width;
                    if (particle.x > this.canvas.width) particle.x = 0;
                    if (particle.y < 0) particle.y = this.canvas.height;
                    if (particle.y > this.canvas.height) particle.y = 0;
                });
                
                this.lastFrame = timestamp;
            }
            
            requestAnimationFrame((ts) => this.animate(ts));
        }
    }

    class Trail {
        constructor() {
            this.points = [];
            this.maxPoints = 25; 
            this.mouseMoveHandler = this.handleMouseMove.bind(this);
            this.animationHandler = this.animate.bind(this);
            this.lastX = 0;
            this.lastY = 0;
            this.pushRadius = 100;
            this.pushStrength = 5;
            
            document.addEventListener('mousemove', this.mouseMoveHandler);
            requestAnimationFrame(this.animationHandler);
        }

        handleMouseMove(event) {
            const x = event.clientX;
            const y = event.clientY;
            
            if (this.lastX && this.lastY) {
                const dx = x - this.lastX;
                const dy = y - this.lastY;
                const distance = Math.sqrt(dx * dx + dy * dy);
                
                const steps = Math.min(Math.floor(distance / 1.5), 6); 
                for (let i = 0; i < steps; i++) {
                    const ratio = i / steps;
                    const point = {
                        x: this.lastX + dx * ratio,
                        y: this.lastY + dy * ratio,
                        lifetime: 25,
                        size: 8,     
                        alpha: 0.6   
                    };
                    this.points.push(point);
                }
            }
            
            this.lastX = x;
            this.lastY = y;

            while (this.points.length > this.maxPoints) {
                this.points.shift();
            }

            this.pushParticles(x, y);
        }

        pushParticles(x, y) {
            const particles = document.querySelector('canvas').__particles__;
            if (!particles) return;

            particles.forEach(particle => {
                const dx = particle.x - x;
                const dy = particle.y - y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                
                if (distance < this.pushRadius) {
                    const force = (1 - distance / this.pushRadius) * this.pushStrength;
                    particle.pushForce.x += (dx / distance) * force;
                    particle.pushForce.y += (dy / distance) * force;
                }
            });
        }

        animate() {
            const canvas = document.querySelector('canvas');
            const ctx = canvas.getContext('2d');

            this.points.forEach((point, index) => {
                const opacity = (point.lifetime / 25) * point.alpha; 
                
                const gradient = ctx.createRadialGradient(
                    point.x, point.y, 0,
                    point.x, point.y, point.size
                );
                gradient.addColorStop(0, `rgba(80, 0, 0, ${opacity})`);
                gradient.addColorStop(1, `rgba(0, 93, 82, 0.93)`);
                
                ctx.fillStyle = gradient;
                ctx.beginPath();
                ctx.arc(point.x, point.y, point.size, 0, Math.PI * 2);
                ctx.fill();
                
                point.lifetime -= 0.6; 
                point.size += 0.35;     
                point.alpha *= 0.96; 
            });

            this.points = this.points.filter(point => point.lifetime > 0);
            requestAnimationFrame(this.animationHandler);
        }
    }

    class TypeWriter {
        constructor() {
            this.titleElement = document.getElementById('typing-title');
            this.contentElement = document.getElementById('typing-content');
            this.textElements = document.querySelectorAll('.typing-text');
            this.title = "About me:";
            this.charIndex = 0;
            this.textIndex = 0;
            this.init();
        }

        init() {
            this.typeTitle();
        }

        typeTitle() {
            if (this.charIndex < this.title.length) {
                this.titleElement.textContent += this.title.charAt(this.charIndex);
                this.charIndex++;
                setTimeout(() => this.typeTitle(), 100);
            } else {
                this.contentElement.style.opacity = '1';
                this.showContent();
            }
        }

        showContent() {
            if (this.textIndex < this.textElements.length) {
                this.textElements[this.textIndex].classList.add('visible');
                this.textIndex++;
                setTimeout(() => this.showContent(), 100);
            }
        }
    }

    const particles = new ParticleSystem();
    const trail = new Trail();
    const typeWriter = new TypeWriter();
    
    window.addEventListener('resize', () => {
        if (particles.resizeTimeout) {
            clearTimeout(particles.resizeTimeout);
        }
        particles.resizeTimeout = setTimeout(() => particles.init(), 100);
    });

    let heading = document.querySelector("h1");
    heading.addEventListener("click", function(){
        heading.textContent = "🍌";
    });

    let Heading = document.querySelector("h2");
    Heading.addEventListener("click", function(){
        Heading.textContent = "🥦";
    });

    let githubButton = document.createElement("button");
    githubButton.textContent = "My GitHub";
    githubButton.style.position = "fixed";
    githubButton.style.top = "10px";
    githubButton.style.right = "10px";
    githubButton.style.zIndex = "2";
    document.querySelector('.content').appendChild(githubButton);

    githubButton.addEventListener("click", function(){
        alert("🫶🏼");
        window.open("https://github.com/C0d3-5t3w", "_blank");
    });

});
