const CONSTANTS = {
    BASE_GRAVITY: 0.2,
    BASE_JUMP_FORCE: -6.0,
    BASE_WALL_SPEED: 3,
    BASE_WALL_SPACING: 900,
    BASE_WALL_GAP: 225,
    BASE_ZIG_WIDTH: 45,
    BASE_ZIG_HEIGHT: 45,
    DEATH_PAUSE: 60,
    BASE_BULLET_SIZE: 45,
    BASE_ENEMY_SIZE: 35,
    BASE_ENEMY_SPEED: 6,
    BASE_ENEMY_SPAWN_INTERVAL: 300,
    BASE_ENEMY_BOB_AMPLITUDE: 100,
    ENEMY_BOB_SPEED: 0.1,
    ENEMY_POINT_VALUE: 5,
    BASE_BULLET_AUTO_AIM_RANGE: 800.0,
    BASE_BULLET_SPEED_TOTAL: 9.0,
    MAX_HIGH_SCORES: 5,
    BASE_TRAIL_LINE_WIDTH: 8,
    SPEED_INCREASE_INTERVAL: 20,
    SPEED_INCREASE_FACTOR: 0.15,
    MAX_SPEED_MULTIPLIER: 2.5,
    BULLET_SIZE_INCREASE: 2,
    MAX_BULLET_SIZE: 55, 
    GRAVITY: 0.3,
    JUMP_FORCE: -8.0,
    WALL_SPEED: 5,
    WALL_SPACING: 900,
    WALL_GAP: 300,
    ZIG_WIDTH: 45,
    ZIG_HEIGHT: 45,
    BULLET_SIZE: 45,
    ENEMY_SIZE: 35,
    ENEMY_SPEED: 6,
    ENEMY_BOB_AMPLITUDE: 100,
    BULLET_AUTO_AIM_RANGE: 800.0,
    BULLET_SPEED_TOTAL: 20.0,
    TRAIL_LINE_WIDTH: 8,
    
    SCREEN_WIDTH: 0,
    SCREEN_HEIGHT: 0,
    SCALE_FACTOR: 1 
};

interface Zig {
    x: number;
    y: number;
    velY: number;
    jumping: boolean;
}

interface Wall {
    x: number;
    height: number;
    passed: boolean;
}

interface Bullet {
    x: number;
    y: number;
    velX: number;
    velY: number;
    colorPhase: number;
}

interface Enemy {
    x: number;
    y: number;
    baseY: number;
    colorPhase: number;
    movePhase: number;
    shape: number;
}

interface TrailPoint {
    x: number;
    y: number;
}

class Game {
    private canvas: HTMLCanvasElement;
    private ctx: CanvasRenderingContext2D;
    private zig: Zig;
    private walls: Wall[];
    private bullets: Bullet[];
    private enemies: Enemy[];
    private score: number;
    private gameOver: boolean;
    private deathTimer: number;
    private canReset: boolean;
    private spawnTimer: number;
    private nextEnemyShape: number;
    private colorCycle: number;
    private highScores: number[];
    private trail: TrailPoint[];
    private trailLength: number;
    private zigImg: HTMLImageElement;
    private bgImg: HTMLImageElement;
    private pipeImg: HTMLImageElement;
    private meowImg: HTMLImageElement;
    private noImg: HTMLImageElement;
    private stopImg: HTMLImageElement;
    private downImg: HTMLImageElement;
    private badImg: HTMLImageElement;
    private lastTime: number;
    private speedMultiplier: number;
    private currentBulletSize: number;

    constructor() {
        this.canvas = document.createElement('canvas');
        this.setupCanvas();
        document.body.appendChild(this.canvas);
        this.ctx = this.canvas.getContext('2d')!;
        
        this.zig = {
            x: CONSTANTS.SCREEN_WIDTH / 4,
            y: CONSTANTS.SCREEN_HEIGHT / 2,
            velY: 0,
            jumping: false
        };
        
        this.walls = [];
        this.bullets = [];
        this.enemies = [];
        this.score = 0;
        this.gameOver = false;
        this.deathTimer = 0;
        this.canReset = false;
        this.spawnTimer = 0;
        this.nextEnemyShape = 0;
        this.colorCycle = 0;
        this.highScores = this.loadHighScores();
        this.trail = [];
        this.trailLength = 10;

        this.zigImg = new Image();
        this.zigImg.src = '../assets/images/z1.png';

        this.bgImg = new Image();
        this.bgImg.src = '../assets/images/bg1.png';

        this.pipeImg = new Image();
        this.pipeImg.src = '../assets/images/pip1.png';

        this.meowImg = new Image();
        this.meowImg.src = '../assets/images/meow.png';

        this.noImg = new Image();
        this.noImg.src = '../assets/images/no.png';

        this.stopImg = new Image();
        this.stopImg.src = '../assets/images/stop.png'; 

        this.downImg = new Image();
        this.downImg.src = '../assets/images/down.png';

        this.badImg = new Image();
        this.badImg.src = '../assets/images/bad.png';

        this.setupControls();
        window.addEventListener('resize', () => this.setupCanvas());
        
        this.lastTime = 0;
        this.speedMultiplier = 1.0;
        this.currentBulletSize = CONSTANTS.BULLET_SIZE;
        requestAnimationFrame(this.gameLoop.bind(this));
    }

    setupCanvas(): void {
        const targetAspectRatio = 16 / 9; 
        let width, height;
        
        const screenWidth = window.innerWidth;
        const screenHeight = window.innerHeight;
        
        if (screenWidth / screenHeight > targetAspectRatio) {
            height = screenHeight * 0.9; 
            width = height * targetAspectRatio;
        } else {
            width = screenWidth * 0.9; 
            height = width / targetAspectRatio;
        }
        
        this.canvas.width = width;
        this.canvas.height = height;
        this.canvas.style.display = 'block';
        this.canvas.style.margin = 'auto';
        
        CONSTANTS.SCREEN_WIDTH = width;
        CONSTANTS.SCREEN_HEIGHT = height;
        
        const referenceWidth = 1920;
        CONSTANTS.SCALE_FACTOR = width / referenceWidth;
        
        CONSTANTS.GRAVITY = CONSTANTS.BASE_GRAVITY * CONSTANTS.SCALE_FACTOR;
        CONSTANTS.JUMP_FORCE = CONSTANTS.BASE_JUMP_FORCE * CONSTANTS.SCALE_FACTOR;
        CONSTANTS.WALL_SPEED = CONSTANTS.BASE_WALL_SPEED * CONSTANTS.SCALE_FACTOR;
        CONSTANTS.WALL_SPACING = CONSTANTS.BASE_WALL_SPACING * CONSTANTS.SCALE_FACTOR;
        CONSTANTS.WALL_GAP = CONSTANTS.BASE_WALL_GAP * CONSTANTS.SCALE_FACTOR;
        CONSTANTS.ZIG_WIDTH = CONSTANTS.BASE_ZIG_WIDTH * CONSTANTS.SCALE_FACTOR;
        CONSTANTS.ZIG_HEIGHT = CONSTANTS.BASE_ZIG_HEIGHT * CONSTANTS.SCALE_FACTOR;
        CONSTANTS.BULLET_SIZE = CONSTANTS.BASE_BULLET_SIZE * CONSTANTS.SCALE_FACTOR;
        CONSTANTS.ENEMY_SIZE = CONSTANTS.BASE_ENEMY_SIZE * CONSTANTS.SCALE_FACTOR;
        CONSTANTS.ENEMY_SPEED = CONSTANTS.BASE_ENEMY_SPEED * CONSTANTS.SCALE_FACTOR;
        CONSTANTS.ENEMY_BOB_AMPLITUDE = CONSTANTS.BASE_ENEMY_BOB_AMPLITUDE * CONSTANTS.SCALE_FACTOR;
        CONSTANTS.BULLET_AUTO_AIM_RANGE = CONSTANTS.BASE_BULLET_AUTO_AIM_RANGE * CONSTANTS.SCALE_FACTOR;
        CONSTANTS.BULLET_SPEED_TOTAL = CONSTANTS.BASE_BULLET_SPEED_TOTAL * CONSTANTS.SCALE_FACTOR;
        CONSTANTS.TRAIL_LINE_WIDTH = CONSTANTS.BASE_TRAIL_LINE_WIDTH * CONSTANTS.SCALE_FACTOR;
        
        if (this.zig) {
            this.zig.x = CONSTANTS.SCREEN_WIDTH / 4;
        }
        
        this.currentBulletSize = CONSTANTS.BULLET_SIZE;
    }

    setupControls(): void {
        document.addEventListener('keydown', (e) => {
            if (e.code === 'Space') {
                if (this.gameOver && this.canReset) {
                    this.reset();
                } else {
                    this.zig.jumping = true;
                }
            }
            if (e.code === 'KeyG' && !this.gameOver) {
                this.shoot();
            }
        });

        this.canvas.addEventListener('touchstart', (e) => {
            e.preventDefault();
            const touch = e.touches[0];
            const rect = this.canvas.getBoundingClientRect();
            const x = touch.clientX - rect.left;

            if (this.gameOver && this.canReset) {
                this.reset();
            } else if (x < this.canvas.width / 2) {
                this.zig.jumping = true;
            } else if (!this.gameOver) {
                this.shoot();
            }
        });
    }

    reset(): void {
        this.zig.x = CONSTANTS.SCREEN_WIDTH / 4;
        this.zig.y = CONSTANTS.SCREEN_HEIGHT / 2;
        this.zig.velY = 0;
        this.walls = [];
        this.bullets = [];
        this.enemies = [];
        this.score = 0;
        this.gameOver = false;
        this.deathTimer = 0;
        this.canReset = false;
        this.spawnTimer = 0;
        this.nextEnemyShape = 0;
        this.speedMultiplier = 1.0;
        this.currentBulletSize = CONSTANTS.BULLET_SIZE;
    }

    shoot(): void {
        const bulletX = this.zig.x + CONSTANTS.ZIG_WIDTH;
        const bulletY = this.zig.y + CONSTANTS.ZIG_HEIGHT / 2;
        const [hasTarget, targetX, targetY] = this.findNearestEnemy(bulletX, bulletY);

        let velX: number, velY: number;
        if (hasTarget) {
            const dx = targetX - bulletX;
            const dy = targetY - bulletY;
            const dist = Math.sqrt(dx * dx + dy * dy);
            velX = (dx / dist) * CONSTANTS.BULLET_SPEED_TOTAL;
            velY = (dy / dist) * CONSTANTS.BULLET_SPEED_TOTAL;
        } else {
            velX = CONSTANTS.BULLET_SPEED_TOTAL;
            velY = 0;
        }

        this.bullets.push({
            x: bulletX,
            y: bulletY,
            velX: velX,
            velY: velY,
            colorPhase: Math.random() * Math.PI * 3
        });
    }

    findNearestEnemy(x: number, y: number): [boolean, number, number] {
        let minDist = CONSTANTS.BULLET_AUTO_AIM_RANGE;
        let found = false;
        let targetX = 0, targetY = 0;

        for (const enemy of this.enemies) {
            const enemyCenterX = enemy.x + CONSTANTS.ENEMY_SIZE / 2;
            const enemyCenterY = enemy.y + CONSTANTS.ENEMY_SIZE / 2;
            const dist = Math.sqrt(Math.pow(x - enemyCenterX, 2) + Math.pow(y - enemyCenterY, 2));

            if (dist < minDist) {
                minDist = dist;
                found = true;
                targetX = enemyCenterX;
                targetY = enemyCenterY;
            }
        }

        return [found, targetX, targetY];
    }

    calculateDifficultyMultipliers(): void {
        const level = Math.floor(this.score / CONSTANTS.SPEED_INCREASE_INTERVAL);
        this.speedMultiplier = Math.min(
            1 + (level * CONSTANTS.SPEED_INCREASE_FACTOR),
            CONSTANTS.MAX_SPEED_MULTIPLIER
        );
        
        this.currentBulletSize = Math.min(
            CONSTANTS.BULLET_SIZE + (level * CONSTANTS.BULLET_SIZE_INCREASE),
            CONSTANTS.MAX_BULLET_SIZE
        );
    }

    update(): void {
        if (this.gameOver) {
            this.deathTimer++;
            if (this.deathTimer >= CONSTANTS.DEATH_PAUSE) {
                this.canReset = true;
                if (this.deathTimer === CONSTANTS.DEATH_PAUSE) {
                    this.saveHighScore(this.score);
                }
            }
            return;
        }

        this.calculateDifficultyMultipliers();

        this.colorCycle += 0.05;
        if (this.colorCycle >= Math.PI * 2) this.colorCycle = 0;

        for (let i = 0; i < this.trail.length; i++) {
            this.trail[i].x -= CONSTANTS.WALL_SPEED;
        }
        
        this.trail.unshift({ x: this.zig.x, y: this.zig.y });
        this.trail = this.trail.filter(pos => pos.x > -CONSTANTS.ZIG_WIDTH);

        this.zig.velY += CONSTANTS.GRAVITY;
        this.zig.y += this.zig.velY;

        if (this.zig.jumping) {
            this.zig.velY = CONSTANTS.JUMP_FORCE;
            this.zig.jumping = false;
        }

        if (this.walls.length === 0 || this.walls[this.walls.length - 1].x < CONSTANTS.SCREEN_WIDTH - CONSTANTS.WALL_SPACING) {
            const minGapPosition = 50 * CONSTANTS.SCALE_FACTOR;
            const maxGapPosition = CONSTANTS.SCREEN_HEIGHT - CONSTANTS.WALL_GAP - 50 * CONSTANTS.SCALE_FACTOR;
            const height = Math.random() * (maxGapPosition - minGapPosition) + minGapPosition;
            
            this.walls.push({
                x: CONSTANTS.SCREEN_WIDTH,
                height: height,
                passed: false
            });
        }

        this.walls.forEach(wall => {
            wall.x -= CONSTANTS.WALL_SPEED * this.speedMultiplier;
            if (!wall.passed && wall.x + 40 < this.zig.x) {
                wall.passed = true;
                this.score++;
            }
        });

        this.walls = this.walls.filter(wall => wall.x > -40);

        this.bullets.forEach(bullet => {
            bullet.x += bullet.velX;
            bullet.y += bullet.velY;
            bullet.colorPhase += 0.05;
            if (bullet.colorPhase >= Math.PI * 2) bullet.colorPhase = 0;
        });

        this.bullets = this.bullets.filter(bullet => 
            bullet.x < CONSTANTS.SCREEN_WIDTH && 
            bullet.y > 0 && 
            bullet.y < CONSTANTS.SCREEN_HEIGHT
        );

        this.spawnTimer++;
        const scaledSpawnInterval = Math.max(60, CONSTANTS.BASE_ENEMY_SPAWN_INTERVAL / CONSTANTS.SCALE_FACTOR);
        if (this.spawnTimer >= scaledSpawnInterval) {
            this.spawnTimer = 0;
            const newY = Math.random() * (CONSTANTS.SCREEN_HEIGHT - CONSTANTS.ENEMY_SIZE);
            this.enemies.push({
                x: CONSTANTS.SCREEN_WIDTH,
                y: newY,
                baseY: newY,
                colorPhase: Math.random() * Math.PI * 2,
                movePhase: Math.random() * Math.PI * 2,
                shape: this.nextEnemyShape
            });
            this.nextEnemyShape = (this.nextEnemyShape + 1) % 4;
        }

        this.enemies.forEach(enemy => {
            enemy.x -= CONSTANTS.ENEMY_SPEED * this.speedMultiplier;
            enemy.colorPhase += 0.05;
            enemy.movePhase += CONSTANTS.ENEMY_BOB_SPEED;
            enemy.y = enemy.baseY + Math.sin(enemy.movePhase) * CONSTANTS.ENEMY_BOB_AMPLITUDE;
        });

        this.enemies = this.enemies.filter(enemy => enemy.x > -CONSTANTS.ENEMY_SIZE);

        if (this.zig.y < 0 || this.zig.y > CONSTANTS.SCREEN_HEIGHT) {
            this.gameOver = true;
        }

        this.walls.forEach(wall => {
            if (this.checkWallCollision(wall)) {
                this.gameOver = true;
            }
        });

        this.enemies.forEach(enemy => {
            if (this.checkEnemyCollision(enemy)) {
                this.gameOver = true;
            }
        });

        this.bullets.forEach(bullet => {
            this.enemies = this.enemies.filter(enemy => {
                if (this.checkBulletEnemyCollision(bullet, enemy)) {
                    this.score += CONSTANTS.ENEMY_POINT_VALUE;
                    return false;
                }
                return true;
            });
        });

        this.enemies = this.enemies.filter(enemy => {
            if (this.checkEnemyTrailCollision(enemy)) {
                this.score += CONSTANTS.ENEMY_POINT_VALUE;
                return false;
            }
            return true;
        });
        
        this.enemies.forEach(enemy => {
            if (this.checkEnemyCollision(enemy)) {
                this.gameOver = true;
            }
        });
    }

    draw(): void {
        this.ctx.fillStyle = 'black';
        this.ctx.fillRect(0, 0, CONSTANTS.SCREEN_WIDTH, CONSTANTS.SCREEN_HEIGHT);

        if (this.bgImg.complete) {
            this.ctx.drawImage(this.bgImg, 0, 0, CONSTANTS.SCREEN_WIDTH, CONSTANTS.SCREEN_HEIGHT);
        }

        if (this.trail.length >= 2) {
            for (let i = 1; i < this.trail.length; i++) {
                const opacity = (this.trailLength - i) / this.trailLength;
                const r = Math.sin(this.colorCycle + i * 0.2) * 127 + 128;
                const g = Math.sin(this.colorCycle + i * 0.2 + 2 * Math.PI / 3) * 127 + 128;
                const b = Math.sin(this.colorCycle + i * 0.2 + 4 * Math.PI / 3) * 127 + 128;
                
                this.ctx.save();
                this.ctx.globalAlpha = opacity * 0.5;
                this.ctx.lineWidth = CONSTANTS.TRAIL_LINE_WIDTH;
                this.ctx.lineCap = 'round';
                this.ctx.strokeStyle = `rgb(${r}, ${g}, ${b})`;
                this.ctx.shadowBlur = 20;
                this.ctx.shadowColor = `rgb(${r}, ${g}, ${b})`;
                
                this.ctx.beginPath();
                this.ctx.moveTo(
                    this.trail[i-1].x + CONSTANTS.ZIG_WIDTH/2,
                    this.trail[i-1].y + CONSTANTS.ZIG_HEIGHT/2
                );
                this.ctx.lineTo(
                    this.trail[i].x + CONSTANTS.ZIG_WIDTH/2,
                    this.trail[i].y + CONSTANTS.ZIG_HEIGHT/2
                );
                this.ctx.stroke();
                this.ctx.restore();
            }
        }

        this.ctx.save();
        const r = Math.sin(this.colorCycle) * 127 + 128;
        const g = Math.sin(this.colorCycle + 2 * Math.PI / 3) * 127 + 128;
        const b = Math.sin(this.colorCycle + 4 * Math.PI / 3) * 127 + 128;
        
        this.ctx.shadowBlur = 30;
        this.ctx.shadowColor = `rgb(${r}, ${g}, ${b})`;
        
        this.ctx.drawImage(
            this.zigImg,
            this.zig.x,
            this.zig.y,
            CONSTANTS.ZIG_WIDTH,
            CONSTANTS.ZIG_HEIGHT
        );
        
        this.ctx.restore();

        this.walls.forEach(wall => this.drawWall(wall));

        this.bullets.forEach(bullet => this.drawBullet(bullet));

        this.enemies.forEach(enemy => this.drawEnemy(enemy));

        this.drawUI();
    }

    drawWall(wall: Wall): void {
        this.ctx.fillStyle = 'black';
        this.ctx.fillRect(wall.x - 2, 0, 44, wall.height);
        this.ctx.fillRect(wall.x - 2, wall.height + CONSTANTS.WALL_GAP, 44, CONSTANTS.SCREEN_HEIGHT - wall.height - CONSTANTS.WALL_GAP);

        if (this.pipeImg.complete) {
            const pattern = this.ctx.createPattern(this.pipeImg, 'repeat');
            if (pattern) {
                this.ctx.save();

                this.ctx.beginPath();
                this.ctx.rect(wall.x, 0, 40, wall.height);
                this.ctx.clip();
                this.ctx.translate(wall.x, 0);
                this.ctx.fillStyle = pattern;
                this.ctx.fillRect(0, 0, 40, wall.height);
                this.ctx.restore();

                this.ctx.save();
                this.ctx.beginPath();
                this.ctx.rect(wall.x, wall.height + CONSTANTS.WALL_GAP, 40, CONSTANTS.SCREEN_HEIGHT - wall.height - CONSTANTS.WALL_GAP);
                this.ctx.clip();
                this.ctx.translate(wall.x, wall.height + CONSTANTS.WALL_GAP);
                this.ctx.fillStyle = pattern;
                this.ctx.fillRect(0, 0, 40, CONSTANTS.SCREEN_HEIGHT - wall.height - CONSTANTS.WALL_GAP);
                this.ctx.restore();
            }
        } else {
            this.ctx.fillStyle = 'white';
            this.ctx.fillRect(wall.x, 0, 40, wall.height);
            this.ctx.fillRect(wall.x, wall.height + CONSTANTS.WALL_GAP, 40, CONSTANTS.SCREEN_HEIGHT - wall.height - CONSTANTS.WALL_GAP);
        }
    }

    drawBullet(bullet: Bullet): void {
        const r = 0.5 + Math.sin(bullet.colorPhase) * 0.5;
        const g = 0.5 + Math.sin(bullet.colorPhase + Math.PI * 2/3) * 0.5;
        const b = 0.5 + Math.sin(bullet.colorPhase + Math.PI * 4/3) * 0.5;
        
        if (this.meowImg.complete) {
            this.ctx.save();
            
            this.ctx.shadowBlur = 20;
            this.ctx.shadowColor = `rgb(${r * 255},${g * 255},${b * 255})`;
            
            this.ctx.drawImage(
                this.meowImg,
                bullet.x,
                bullet.y,
                this.currentBulletSize,
                this.currentBulletSize
            );
            
            this.ctx.restore();
        } else {
            this.ctx.strokeStyle = `rgb(${r * 255},${g * 255},${b * 255})`;
            this.ctx.beginPath();
            this.ctx.arc(
                bullet.x + this.currentBulletSize/2,
                bullet.y + this.currentBulletSize/2,
                this.currentBulletSize/2,
                0,
                Math.PI * 2
            );
            this.ctx.stroke();
        }
    }

    drawEnemy(enemy: Enemy): void {
        const r = 0.5 + Math.sin(enemy.colorPhase) * 0.5;
        const g = 0.5 + Math.sin(enemy.colorPhase + Math.PI * 2/3) * 0.5;
        const b = 0.5 + Math.sin(enemy.colorPhase + Math.PI * 4/3) * 0.5;
        
        this.ctx.strokeStyle = `rgb(${r * 255},${g * 255},${b * 255})`;
        this.ctx.lineWidth = 2;

        const centerX = enemy.x + CONSTANTS.ENEMY_SIZE/2;
        const centerY = enemy.y + CONSTANTS.ENEMY_SIZE/2;
        const size = CONSTANTS.ENEMY_SIZE;

        switch(enemy.shape) {
            case 0: 
                if (this.stopImg.complete) {
                    this.ctx.save();
                    this.ctx.shadowBlur = 20;
                    this.ctx.shadowColor = `rgb(${r * 255},${g * 255},${b * 255})`;
                    this.ctx.drawImage(
                        this.stopImg,
                        enemy.x,
                        enemy.y,
                        size,
                        size
                    );
                    this.ctx.restore();
                } else {
                    this.ctx.beginPath();
                    this.ctx.arc(centerX, centerY, size/2, 0, Math.PI * 2);
                    this.ctx.stroke();
                }
                break;
            case 1:
                if (this.noImg.complete) {
                    this.ctx.save();
                    this.ctx.shadowBlur = 20;
                    this.ctx.shadowColor = `rgb(${r * 255},${g * 255},${b * 255})`;
                    this.ctx.drawImage(
                        this.noImg,
                        enemy.x,
                        enemy.y,
                        size,
                        size
                    );
                    this.ctx.restore();
                } else {
                    this.ctx.beginPath();
                    this.ctx.moveTo(centerX, enemy.y);
                    this.ctx.lineTo(enemy.x + size, centerY);
                    this.ctx.lineTo(centerX, enemy.y + size);
                    this.ctx.lineTo(enemy.x, centerY);
                    this.ctx.closePath();
                    this.ctx.stroke();
                }
                break;
            case 2:
                if (this.downImg.complete) {
                    this.ctx.save();
                    this.ctx.shadowBlur = 20;
                    this.ctx.shadowColor = `rgb(${r * 255},${g * 255},${b * 255})`;
                    this.ctx.drawImage(
                        this.downImg,
                        enemy.x,
                        enemy.y,
                        size,
                        size
                    );
                    this.ctx.restore();
                } else {
                    this.ctx.beginPath();
                    this.ctx.moveTo(centerX, enemy.y);
                    this.ctx.lineTo(enemy.x + size, centerY);
                    this.ctx.lineTo(centerX, enemy.y + size);
                    this.ctx.lineTo(enemy.x, centerY);
                    this.ctx.closePath();
                    this.ctx.stroke();
                }
                break;
            case 3:
                if (this.badImg.complete) {
                    this.ctx.save();
                    this.ctx.shadowBlur = 20;
                    this.ctx.shadowColor = `rgb(${r * 255},${g * 255},${b * 255})`;
                    this.ctx.drawImage(
                        this.badImg,
                        enemy.x,
                        enemy.y,
                        size,
                        size
                    );
                    this.ctx.restore();
                } else {
                    this.ctx.beginPath();
                    this.ctx.moveTo(enemy.x, enemy.y);
                    this.ctx.lineTo(enemy.x + size, enemy.y + size);
                    this.ctx.moveTo(enemy.x + size, enemy.y);
                    this.ctx.lineTo(enemy.x, enemy.y + size);
                    this.ctx.stroke();
                }
                break;
        }
    }

    drawUI(): void {
        const fontSize = Math.max(16, Math.round(20 * CONSTANTS.SCALE_FACTOR));
        
        this.ctx.fillStyle = 'white';
        this.ctx.font = `${fontSize}px Arial`;
        
        if (this.gameOver) {
            this.ctx.fillText(`Game Over! Score: ${this.score}`, 10, 30 * CONSTANTS.SCALE_FACTOR);
            this.ctx.fillText('High Scores:', 10, 60 * CONSTANTS.SCALE_FACTOR);
            this.highScores.forEach((score, i) => {
                this.ctx.fillText(`${i + 1}. ${score}`, 10, (90 + i * 30) * CONSTANTS.SCALE_FACTOR);
            });
            if (this.canReset) {
                this.ctx.fillText('Tap or Press SPACE to restart', 10, (90 + this.highScores.length * 30) * CONSTANTS.SCALE_FACTOR);
            }
        } else {
            this.ctx.fillText(`Score: ${this.score}`, 10, 30 * CONSTANTS.SCALE_FACTOR);
            if (this.highScores.length > 0) {
                const highScoreX = Math.min(200 * CONSTANTS.SCALE_FACTOR, CONSTANTS.SCREEN_WIDTH - 150);
                this.ctx.fillText(`High Score: ${this.highScores[0]}`, highScoreX, 30 * CONSTANTS.SCALE_FACTOR);
            }
        }
    }

    checkWallCollision(wall: Wall): boolean {
        return (
            this.zig.x < wall.x + 40 &&
            this.zig.x + CONSTANTS.ZIG_WIDTH > wall.x &&
            (this.zig.y < wall.height ||
            this.zig.y + CONSTANTS.ZIG_HEIGHT > wall.height + CONSTANTS.WALL_GAP)
        );
    }

    checkEnemyCollision(enemy: Enemy): boolean {
        const zigCenterX = this.zig.x + CONSTANTS.ZIG_WIDTH/2;
        const zigCenterY = this.zig.y + CONSTANTS.ZIG_HEIGHT/2;
        const enemyCenterX = enemy.x + CONSTANTS.ENEMY_SIZE/2;
        const enemyCenterY = enemy.y + CONSTANTS.ENEMY_SIZE/2;
        
        const distance = Math.sqrt(
            Math.pow(zigCenterX - enemyCenterX, 2) +
            Math.pow(zigCenterY - enemyCenterY, 2)
        );
        
        return distance < CONSTANTS.ZIG_WIDTH/2 + CONSTANTS.ENEMY_SIZE/2;
    }

    checkBulletEnemyCollision(bullet: Bullet, enemy: Enemy): boolean {
        const bulletCenterX = bullet.x + this.currentBulletSize/2;
        const bulletCenterY = bullet.y + this.currentBulletSize/2;
        const enemyCenterX = enemy.x + CONSTANTS.ENEMY_SIZE/2;
        const enemyCenterY = enemy.y + CONSTANTS.ENEMY_SIZE/2;
        
        const distance = Math.sqrt(
            Math.pow(bulletCenterX - enemyCenterX, 2) +
            Math.pow(bulletCenterY - enemyCenterY, 2)
        );
        
        return distance < this.currentBulletSize/2 + CONSTANTS.ENEMY_SIZE/2;
    }

    checkEnemyTrailCollision(enemy: Enemy): boolean {
        const enemyCenterX = enemy.x + CONSTANTS.ENEMY_SIZE/2;
        const enemyCenterY = enemy.y + CONSTANTS.ENEMY_SIZE/2;
        
        for (let i = 1; i < this.trail.length; i++) {
            const trailX1 = this.trail[i-1].x + CONSTANTS.ZIG_WIDTH/2;
            const trailY1 = this.trail[i-1].y + CONSTANTS.ZIG_HEIGHT/2;
            const trailX2 = this.trail[i].x + CONSTANTS.ZIG_WIDTH/2;
            const trailY2 = this.trail[i].y + CONSTANTS.ZIG_HEIGHT/2;
            
            const distance = this.pointLineDistance(
                enemyCenterX, 
                enemyCenterY, 
                trailX1, 
                trailY1, 
                trailX2, 
                trailY2
            );
            
            if (distance < CONSTANTS.ENEMY_SIZE/2 + CONSTANTS.TRAIL_LINE_WIDTH/2) {
                return true;
            }
        }
        return false;
    }

    pointLineDistance(x: number, y: number, x1: number, y1: number, x2: number, y2: number): number {
        const A = x - x1;
        const B = y - y1;
        const C = x2 - x1;
        const D = y2 - y1;
        
        const dot = A * C + B * D;
        const lenSq = C * C + D * D;
        let param = -1;
        
        if (lenSq !== 0)
            param = dot / lenSq;
        
        let xx, yy;
        
        if (param < 0) {
            xx = x1;
            yy = y1;
        } else if (param > 1) {
            xx = x2;
            yy = y2;
        } else {
            xx = x1 + param * C;
            yy = y1 + param * D;
        }
        
        const dx = x - xx;
        const dy = y - yy;
        return Math.sqrt(dx * dx + dy * dy);
    }

    loadHighScores(): number[] {
        const scores = localStorage.getItem('highScores');
        return scores ? JSON.parse(scores) : [];
    }

    saveHighScore(score: number): void {
        let scores = this.loadHighScores();
        scores.push(score);
        scores.sort((a, b) => b - a);
        if (scores.length > CONSTANTS.MAX_HIGH_SCORES) {
            scores = scores.slice(0, CONSTANTS.MAX_HIGH_SCORES);
        }
        this.highScores = scores;
        localStorage.setItem('highScores', JSON.stringify(scores));
    }

    gameLoop(timestamp: number): void {
        const deltaTime = timestamp - this.lastTime;
        this.lastTime = timestamp;

        this.update();
        this.draw();

        requestAnimationFrame(this.gameLoop.bind(this));
    }
}

window.onload = () => new Game();

// <3