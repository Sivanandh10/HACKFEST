const registerButton = document.getElementById('register');

registerButton.addEventListener('mouseenter', () => {
    for (let i = 0; i < 10; i++) {
        createSprinkle();
    }
});

function createSprinkle() {
    const sprinkle = document.createElement('div');
    sprinkle.classList.add('sprinkle');
    sprinkle.style.left = ${Math.random() * 100}px;
    sprinkle.style.animationDuration = ${Math.random() * 1 + 0.5}s;
    document.body.appendChild(sprinkle);

    sprinkle.addEventListener('animationend', () => {
        sprinkle.remove();
    });
}