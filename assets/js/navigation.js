// script.js
const navIcon = document.getElementById('navIcon');
const navbar = document.getElementById('navbar');

navIcon.addEventListener('click', () => {
    navbar.style.display = navbar.style.display === 'block' ? 'none' : 'block';
});

document.addEventListener('click', (event) => {
    if (!navIcon.contains(event.target) && !navbar.contains(event.target)) {
        navbar.style.display = 'none';
    }
});