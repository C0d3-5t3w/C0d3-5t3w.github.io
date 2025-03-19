const CONSTANTS = {
    GRAVITY: 0.2,
    JUMP_FORCE: -6.0,
    WALL_SPEED: 3,
    WALL_SPACING: 800,
    WALL_GAP: 200,
    ZIG_WIDTH: 35,
    ZIG_HEIGHT: 35,
    DEATH_PAUSE: 60,
    BULLET_SIZE: 35,
    ENEMY_SIZE: 35,
    ENEMY_SPEED: 4,
    ENEMY_SPAWN_INTERVAL: 300,
    ENEMY_BOB_AMPLITUDE: 100,
    ENEMY_BOB_SPEED: 0.1,
    ENEMY_POINT_VALUE: 5,
    BULLET_AUTO_AIM_RANGE: 800.0,
    BULLET_SPEED_TOTAL: 15.0,
    MAX_HIGH_SCORES: 5,
    TRAIL_LINE_WIDTH: 8  
};

class Game {
    constructor() {
        this.canvas = document.createElement('canvas');
        this.setupCanvas();
        document.body.appendChild(this.canvas);
        this.ctx = this.canvas.getContext('2d');
        
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
        this.zigImg.src = 'assets/images/z1.png';

        this.bgImg = new Image();
        this.bgImg.src = 'assets/images/bg1.png';

        this.pipeImg = new Image();
        this.pipeImg.src = 'assets/images/pip1.png';

        this.meowImg = new Image();
        this.meowImg.src = 'assets/images/meow.png';

        this.noImg = new Image();
        this.noImg.src = 'assets/images/no.png';

        this.stopImg = new Image();
        this.stopImg.src = 'assets/images/stop.png'; 

        this.downImg = new Image();
        this.downImg.src = 'assets/images/down.png';

        this.badImg = new Image();
        this.badImg.src = 'assets/images/bad.png';

        this.setupControls();
        window.addEventListener('resize', () => this.setupCanvas());
        
        this.lastTime = 0;
        requestAnimationFrame(this.gameLoop.bind(this));
    }

    setupCanvas() {
        const aspectRatio = 9/7;
        let width = Math.min(window.innerWidth * 0.95, window.innerHeight * aspectRatio * 0.95);
        let height = width / aspectRatio;

        if (height > window.innerHeight * 0.95) {
            height = window.innerHeight * 0.95;
            width = height * aspectRatio;
        }

        this.canvas.width = width;
        this.canvas.height = height;
        this.canvas.style.display = 'block';
        this.canvas.style.margin = 'auto';

        CONSTANTS.SCREEN_WIDTH = width;
        CONSTANTS.SCREEN_HEIGHT = height;
    }

    setupControls() {
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

        // Mobile controls top/bottom
        //this.canvas.addEventListener('touchstart', (e) => {
            //e.preventDefault();
            //const touch = e.touches[0];
            //const rect = this.canvas.getBoundingClientRect();
            //const y = touch.clientY - rect.top;
            
            //if (this.gameOver && this.canReset) {
                //this.reset();
            //} else if (y > this.canvas.height / 2) {
                //this.zig.jumping = true;
            //} else if (!this.gameOver) {
                //this.shoot();
            //}
        //});
        // Mobile controls left/right
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

    reset() {
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
    }

    shoot() {
        const bulletX = this.zig.x + CONSTANTS.ZIG_WIDTH;
        const bulletY = this.zig.y + CONSTANTS.ZIG_HEIGHT / 2;
        const [hasTarget, targetX, targetY] = this.findNearestEnemy(bulletX, bulletY);

        let velX, velY;
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

    findNearestEnemy(x, y) {
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

    update() {
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
            const height = Math.random() * (CONSTANTS.SCREEN_HEIGHT - CONSTANTS.WALL_GAP - 100) + 50;
            this.walls.push({
                x: CONSTANTS.SCREEN_WIDTH,
                height: height,
                passed: false
            });
        }

        this.walls.forEach(wall => {
            wall.x -= CONSTANTS.WALL_SPEED;
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
        if (this.spawnTimer >= CONSTANTS.ENEMY_SPAWN_INTERVAL) {
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
            enemy.x -= CONSTANTS.ENEMY_SPEED;
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
    }

    draw() {
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

    drawWall(wall) {
        this.ctx.fillStyle = 'black';
        this.ctx.fillRect(wall.x - 2, 0, 44, wall.height);
        this.ctx.fillRect(wall.x - 2, wall.height + CONSTANTS.WALL_GAP, 44, CONSTANTS.SCREEN_HEIGHT - wall.height - CONSTANTS.WALL_GAP);

        if (this.pipeImg.complete) {
            const pattern = this.ctx.createPattern(this.pipeImg, 'repeat');
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
        } else {
            this.ctx.fillStyle = 'white';
            this.ctx.fillRect(wall.x, 0, 40, wall.height);
            this.ctx.fillRect(wall.x, wall.height + CONSTANTS.WALL_GAP, 40, CONSTANTS.SCREEN_HEIGHT - wall.height - CONSTANTS.WALL_GAP);
        }
    }

    drawBullet(bullet) {
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
                CONSTANTS.BULLET_SIZE,
                CONSTANTS.BULLET_SIZE
            );
            
            this.ctx.restore();
        } else {
            this.ctx.strokeStyle = `rgb(${r * 255},${g * 255},${b * 255})`;
            this.ctx.beginPath();
            this.ctx.arc(
                bullet.x + CONSTANTS.BULLET_SIZE/2,
                bullet.y + CONSTANTS.BULLET_SIZE/2,
                CONSTANTS.BULLET_SIZE/2,
                0,
                Math.PI * 2
            );
            this.ctx.stroke();
        }
    }

    drawEnemy(enemy) {
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

    drawUI() {
        this.ctx.fillStyle = 'white';
        this.ctx.font = '20px Arial';
        if (this.gameOver) {
            this.ctx.fillText(`Game Over! Score: ${this.score}`, 10, 30);
            this.ctx.fillText('High Scores:', 10, 60);
            this.highScores.forEach((score, i) => {
                this.ctx.fillText(`${i + 1}. ${score}`, 10, 90 + i * 30);
            });
            if (this.canReset) {
                this.ctx.fillText('Tap or Press SPACE to restart', 10, 90 + this.highScores.length * 30);
            }
        } else {
            this.ctx.fillText(`Score: ${this.score}`, 10, 30);
            if (this.highScores.length > 0) {
                this.ctx.fillText(`High Score: ${this.highScores[0]}`, 200, 30);
            }
        }
    }

    checkWallCollision(wall) {
        return (
            this.zig.x < wall.x + 40 &&
            this.zig.x + CONSTANTS.ZIG_WIDTH > wall.x &&
            (this.zig.y < wall.height ||
            this.zig.y + CONSTANTS.ZIG_HEIGHT > wall.height + CONSTANTS.WALL_GAP)
        );
    }

    checkEnemyCollision(enemy) {
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

    checkBulletEnemyCollision(bullet, enemy) {
        const bulletCenterX = bullet.x + CONSTANTS.BULLET_SIZE/2;
        const bulletCenterY = bullet.y + CONSTANTS.BULLET_SIZE/2;
        const enemyCenterX = enemy.x + CONSTANTS.ENEMY_SIZE/2;
        const enemyCenterY = enemy.y + CONSTANTS.ENEMY_SIZE/2;
        
        const distance = Math.sqrt(
            Math.pow(bulletCenterX - enemyCenterX, 2) +
            Math.pow(bulletCenterY - enemyCenterY, 2)
        );
        
        return distance < CONSTANTS.BULLET_SIZE/2 + CONSTANTS.ENEMY_SIZE/2;
    }

    loadHighScores() {
        const scores = localStorage.getItem('highScores');
        return scores ? JSON.parse(scores) : [];
    }

    saveHighScore(score) {
        let scores = this.loadHighScores();
        scores.push(score);
        scores.sort((a, b) => b - a);
        if (scores.length > CONSTANTS.MAX_HIGH_SCORES) {
            scores = scores.slice(0, CONSTANTS.MAX_HIGH_SCORES);
        }
        this.highScores = scores;
        localStorage.setItem('highScores', JSON.stringify(scores));
    }

    gameLoop(timestamp) {
        const deltaTime = timestamp - this.lastTime;
        this.lastTime = timestamp;

        this.update();
        this.draw();

        requestAnimationFrame(this.gameLoop.bind(this));
    }
}

window.onload = () => new Game();
