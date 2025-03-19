// Convert existing classes to use TypeScript types
interface Point {
    x: number;
    y: number;
    lifetime: number;
    size: number;
    alpha: number;
}

document.addEventListener("DOMContentLoaded", function(){
    interface ParticleForce {
        x: number;
        y: number;
    }

    class Particle {
        x: number;
        y: number;
        chars: string[];
        char: string;
        vx: number;
        vy: number;
        pushForce: ParticleForce;
        maxSpeed: number;
        radius: number;

        constructor(x: number, y: number) {
            this.x = x;
            this.y = y;
            this.chars = ['5', 'T', '3', 'W'];
            this.char = this.chars[Math.floor(Math.random() * this.chars.length)];
            this.vx = (Math.random() - 0.5) * 2;
            this.vy = (Math.random() - 0.5) * 2;
            this.pushForce = { x: 0, y: 0 };
            this.maxSpeed = 3;
            this.radius = 7.5;
        }

    }

    class ParticleSystem {
        canvas: HTMLCanvasElement;
        ctx: CanvasRenderingContext2D;
        particles: Particle[];
        maxParticles: number;
        resizeTimeout: number | null;
        lastFrame: number;
        fps: number;

        constructor() {
        }

    }

    class Trail {
        points: Array<{x: number, y: number, lifetime: number, size: number, alpha: number}>;
        maxPoints: number;
        mouseMoveHandler: (event: MouseEvent) => void;
        animationHandler: () => void;
        lastX: number;
        lastY: number;
        pushRadius: number;
        pushStrength: number;

        constructor() {
        }

    }

    class TypeWriter {
        titleElement: HTMLElement | null;
        contentElement: HTMLElement | null;
        textElements: NodeListOf<Element>;
        title: string;
        charIndex: number;
        textIndex: number;

        constructor() {
            this.titleElement = document.getElementById('typing-title');
            this.contentElement = document.getElementById('typing-content');
            this.textElements = document.querySelectorAll('.typing-text');
            this.title = "About me:";
            this.charIndex = 0;
            this.textIndex = 0;
            this.init();
        }

    }

});
