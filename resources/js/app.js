import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    let currentTheme = localStorage.getItem('theme') || 'auto';

    if (currentTheme === 'light') {
        document.body.setAttribute('data-bs-theme', 'light');
    } else if (currentTheme === 'dark') {
        document.body.setAttribute('data-bs-theme', 'dark');
    } else {
        document.body.removeAttribute('data-bs-theme');
    }

    const themeButtons = document.querySelectorAll('[data-bs-theme-value]');

    themeButtons.forEach(button => {
        button.addEventListener('click', function () {
            let selectedTheme = button.getAttribute('data-bs-theme-value');

            if (selectedTheme === 'light') {
                document.body.setAttribute('data-bs-theme', 'light');
            } else if (selectedTheme === 'dark') {
                document.body.setAttribute('data-bs-theme', 'dark');
            } else {
                document.body.removeAttribute('data-bs-theme');
            }

            localStorage.setItem('theme', selectedTheme);

            themeButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
        });
    });
});
