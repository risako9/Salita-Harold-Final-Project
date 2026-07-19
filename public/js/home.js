const menuToggle = document.querySelector('.menu-toggle');
        const mainMenu = document.querySelector('#main-menu');
        const closeMenu = () => {
            mainMenu.classList.remove('open');
            menuToggle.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('menu-open');
        };

        menuToggle.addEventListener('click', () => {
            const isOpen = mainMenu.classList.toggle('open');
            menuToggle.setAttribute('aria-expanded', String(isOpen));
            document.body.classList.toggle('menu-open', isOpen);
        });

        mainMenu.querySelectorAll('a').forEach(link => link.addEventListener('click', closeMenu));
        document.addEventListener('keydown', event => { if (event.key === 'Escape') closeMenu(); });
        document.querySelector('#year').textContent = new Date().getFullYear();
