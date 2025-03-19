document.addEventListener("DOMContentLoaded", function(){
    class MatrixEffect {
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
            this.chars = '5T3W'.split(''); 
            this.drops = [];
            this.bobPhases = [];
            this.spawnRates = []; 
            
            this.resizeTimeout = null;
            this.animate = this.animate.bind(this);

            this.init();
            window.addEventListener('resize', () => this.init());
            this.lastFrame = 0;
            this.fps = 32; 
            this.animate();
        }
        
        init() {
            const oldCanvas = this.canvas.cloneNode();
            const oldWidth = this.canvas.width;
            const oldHeight = this.canvas.height;
            
            this.canvas.width = window.innerWidth;
            this.canvas.height = window.innerHeight;
            
            if (this.drops.length > 0) {
                const ratio = this.canvas.width / oldWidth;
                const columns = Math.floor(this.canvas.width / 15);
                const oldDrops = [...this.drops];
                this.drops = Array(columns).fill(0);
                
                oldDrops.forEach((drop, i) => {
                    const newIndex = Math.floor(i * ratio);
                    if (newIndex < columns) {
                        this.drops[newIndex] = drop;
                    }
                });
            } else {
                const columns = Math.floor(this.canvas.width / 15);
                this.drops = Array(columns).fill(1).map(() => this.canvas.height + Math.random() * 50);
                this.bobPhases = Array(columns).fill(0).map(() => Math.random() * Math.PI * 2);
                this.spawnRates = Array(columns).fill(0).map(() => Math.random() * 0.3 + 0.5);
            }
            
            if (oldWidth > 0) {
                this.ctx.drawImage(oldCanvas, 0, 0);
            }
        }
        
        animate(timestamp) {
            if (!this.lastFrame) this.lastFrame = timestamp;
            const elapsed = timestamp - this.lastFrame;
            
            if (elapsed > (1000 / this.fps)) {
                this.ctx.fillStyle = 'rgba(0, 0, 0, .05)';
                this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
                
                this.ctx.fillStyle = 'rgba(251, 42, 255, 0.75)'; 
                this.ctx.font = '15px monospace';
                
                this.drops.forEach((drop, i) => {
                    const text = this.chars[Math.floor(Math.random() * this.chars.length)];
                    this.bobPhases[i] += 0.03;
                    const bobOffset = Math.sin(this.bobPhases[i]) * 5;
                    const x = (i * 15) + bobOffset;
                    const y = drop;
                    
                    this.ctx.fillText(text, x, y);
                    
                    if (y < -20) { 
                        this.drops[i] = this.canvas.height + (Math.random() * 30);
                        this.spawnRates[i] = Math.random() * 0.3 + 0.5;
                    } else {
                        this.drops[i] = drop - (0.8 * this.spawnRates[i]);
                    }
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

    class PictureGlow {
        constructor() {
            this.containers = document.querySelectorAll('.picture-container');
            this.setupGlowEffects();
        }

        setupGlowEffects() {
            this.containers.forEach(container => {
                const canvas = container.querySelector('.glow');
                const ctx = canvas.getContext('2d');
                
                const updateCanvasSize = () => {
                    canvas.width = container.offsetWidth;
                    canvas.height = container.offsetHeight;
                };
                
                updateCanvasSize();
                window.addEventListener('resize', updateCanvasSize);

                container.addEventListener('mousemove', (e) => {
                    const rect = container.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    
                    const gradient = ctx.createRadialGradient(
                        x, y, 0,
                        x, y, 100
                    );
                    
                    gradient.addColorStop(0, 'rgba(255, 255, 255, 0.2)');
                    gradient.addColorStop(0.5, 'rgba(255, 255, 255, 0.1)');
                    gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');
                    
                    ctx.fillStyle = gradient;
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                });

                container.addEventListener('mouseleave', () => {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                });
            });
        }
    }

    const matrix = new MatrixEffect();
    const trail = new Trail();
    const pictureGlow = new PictureGlow();
    
    window.addEventListener('resize', () => {
        if (matrix.resizeTimeout) {
            clearTimeout(matrix.resizeTimeout);
        }
        matrix.resizeTimeout = setTimeout(() => matrix.init(), 100);
    });
});
