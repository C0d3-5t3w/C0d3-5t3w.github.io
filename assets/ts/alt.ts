document.addEventListener("DOMContentLoaded", function(){
    interface Point {
        x: number;
        y: number;
        lifetime: number;
        size: number;
        alpha: number;
    }

    class Trail {
        points: Point[];
        maxPoints: number;
        mouseMoveHandler: (event: MouseEvent) => void;
        animationHandler: () => void;
        lastX: number;
        lastY: number;
        pushRadius: number;
        pushStrength: number;
        
        constructor() {
            this.points = [];
            this.maxPoints = 25; 
            this.mouseMoveHandler = this.handleMouseMove.bind(this);
            this.animationHandler = this.animate.bind(this);
            this.lastX = 0;
            this.lastY = 0;
            this.pushRadius = 80; 
            this.pushStrength = 2;
            
            document.addEventListener('mousemove', this.mouseMoveHandler);
            requestAnimationFrame(this.animationHandler);
        }

        handleMouseMove(event: MouseEvent): void {
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

        animate(): void {
            const canvas = document.querySelector('canvas');
            if (!canvas) return;
            
            const ctx = canvas.getContext('2d');
            if (!ctx) return;

            this.points.forEach((point) => {
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
        containers: NodeListOf<Element>;

        constructor() {
            this.containers = document.querySelectorAll('.picture-container');
            this.setupGlowEffects();
        }

        setupGlowEffects(): void {
            this.containers.forEach(container => {
                const canvas = container.querySelector('.glow') as HTMLCanvasElement;
                if (!canvas) return;
                
                const ctx = canvas.getContext('2d');
                if (!ctx) return;
                
                const updateCanvasSize = () => {
                    canvas.width = (container as HTMLElement).offsetWidth;
                    canvas.height = (container as HTMLElement).offsetHeight;
                };
                
                updateCanvasSize();
                window.addEventListener('resize', updateCanvasSize);

                (container as HTMLElement).addEventListener('mousemove', ((e: MouseEvent) => {
                    const rect = (container as HTMLElement).getBoundingClientRect();
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
                }) as EventListener);

                container.addEventListener('mouseleave', () => {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                });
            });
        }
    }

    class TypeWriter {
        titleElement: HTMLElement;
        contentElement: HTMLElement;
        textElements: NodeListOf<Element>;
        title: string;
        charIndex: number;
        textIndex: number;

        constructor() {
            this.titleElement = document.getElementById('typing-title')!;
            this.contentElement = document.getElementById('typing-content')!;
            this.textElements = document.querySelectorAll('.typing-text');
            this.title = "About me:";
            this.charIndex = 0;
            this.textIndex = 0;
            this.init();
        }

        init(): void {
            this.typeTitle();
        }

        typeTitle(): void {
            if (this.charIndex < this.title.length) {
                this.titleElement.textContent += this.title.charAt(this.charIndex);
                this.charIndex++;
                setTimeout(() => this.typeTitle(), 100);
            } else {
                this.contentElement.style.opacity = '1';
                this.showContent();
            }
        }

        showContent(): void {
            if (this.textIndex < this.textElements.length) {
                this.textElements[this.textIndex].classList.add('visible');
                this.textIndex++;
                setTimeout(() => this.showContent(), 100);
            }
        }
    }

    class FogEffect {
        fogCorners: HTMLElement[] = [];
        
        constructor() {
            this.createFogElements();
            this.animateFog();
        }
        
        createFogElements(): void {
            const fogContainer = document.createElement('div');
            fogContainer.className = 'fog-container';
            document.body.appendChild(fogContainer);
            
            const positions = ['top-left', 'top-right', 'bottom-left', 'bottom-right'];
            
            positions.forEach(position => {
                const fogCorner = document.createElement('div');
                fogCorner.className = `fog-corner ${position}`;
                fogContainer.appendChild(fogCorner);
                this.fogCorners.push(fogCorner);
            });
        }
        
        animateFog(): void {
            this.fogCorners.forEach((corner, index) => {
                const pulseSpeed = 3000 + (index * 500); 
                corner.style.animation = `fogPulse ${pulseSpeed}ms infinite alternate ease-in-out`;
            });
        }
    }

    const trail = new Trail();
    const typeWriter = new TypeWriter();
    const pictureGlow = new PictureGlow(); 
    const fogEffect = new FogEffect();

    let heading = document.querySelector("h1") as HTMLHeadingElement;
    heading.addEventListener("click", function(){
        heading.textContent = "Y0U'R3";
    });

    let Heading = document.querySelector("h2") as HTMLHeadingElement;
    Heading.addEventListener("click", function(){
        Heading.textContent = "AMAZ1NG!";
    });
});
