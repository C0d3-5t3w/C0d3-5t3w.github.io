class PageSiteMapDropdown {
    private dropdown!: HTMLElement;
    private button!: HTMLElement;
    private content!: HTMLElement;
    private isOpen: boolean = false;

    constructor() {
        this.createElements();
        this.setupEventListeners();
    }

    private createElements(): void {
        this.dropdown = document.createElement('div');
        this.dropdown.className = 'site-dropdown';
        this.dropdown.style.position = 'fixed';
        this.dropdown.style.top = '10px';
        this.dropdown.style.left = '10px';
        this.dropdown.style.zIndex = '1000';

        this.button = document.createElement('button');
        this.button.textContent = '🗺️ Navigation';
        this.button.className = 'dropdown-button';
        this.button.style.backgroundColor = 'var(--accent-teal)';
        this.button.style.color = 'var(--primary-color)';
        this.button.style.border = '1px solid var(--primary-color)';
        this.button.style.padding = '8px 15px';
        this.button.style.cursor = 'pointer';
        this.button.style.borderRadius = '5px';
        this.button.style.fontSize = '16px';
        
        this.content = document.createElement('div');
        this.content.className = 'dropdown-content';
        this.content.style.display = 'none';
        this.content.style.position = 'absolute';
        this.content.style.backgroundColor = 'var(--dark-bg)';
        this.content.style.minWidth = '160px';
        this.content.style.boxShadow = '0px 8px 16px 0px rgba(255,255,255,0.2)';
        this.content.style.zIndex = '1';
        this.content.style.border = '1px solid var(--primary-color)';
        this.content.style.borderRadius = '5px';
        this.content.style.marginTop = '5px';

        const links = [
            { text: '🏠 Home', url: '../index.html' },
            { text: '📷 Pictures', url: 'pictures.html' },
            { text: '🍲 Recipes', url: 'recipes.html' },
            { text: '💡 Advice', url: 'advice.html' },
            { text: '🎮 FlappyZig', url: 'FlappyZig.html' },
            { text: '✨ Particles', url: 'particles.html' },
            { text: '🔗 Links', url: 'links.html' }
        ];

        links.forEach(link => {
            const a = document.createElement('a');
            a.href = link.url;
            a.textContent = link.text;
            a.style.color = 'var(--primary-color)';
            a.style.padding = '12px 16px';
            a.style.textDecoration = 'none';
            a.style.display = 'block';
            a.style.borderBottom = '1px solid rgba(255,255,255,0.1)';
            
            a.addEventListener('mouseover', () => {
                a.style.backgroundColor = 'var(--accent-teal)';
            });
            
            a.addEventListener('mouseout', () => {
                a.style.backgroundColor = 'transparent';
            });
            
            this.content.appendChild(a);
        });

        this.dropdown.appendChild(this.button);
        this.dropdown.appendChild(this.content);
        
        document.body.appendChild(this.dropdown);
    }

    private setupEventListeners(): void {
        this.button.addEventListener('click', (e) => {
            e.stopPropagation();
            this.toggleDropdown();
        });

        document.addEventListener('click', () => {
            if (this.isOpen) {
                this.closeDropdown();
            }
        });

        this.content.addEventListener('click', (event) => {
            event.stopPropagation();
        });
    }

    private toggleDropdown(): void {
        this.isOpen = !this.isOpen;
        this.content.style.display = this.isOpen ? 'block' : 'none';
        
        if (this.isOpen) {
            this.button.style.boxShadow = '0 0 10px var(--accent-teal)';
        } else {
            this.button.style.boxShadow = 'none';
        }
    }

    private closeDropdown(): void {
        this.isOpen = false;
        this.content.style.display = 'none';
        this.button.style.boxShadow = 'none';
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new PageSiteMapDropdown();
});
