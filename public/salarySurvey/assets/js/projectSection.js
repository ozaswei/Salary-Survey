const canvas = document.getElementById('bubbleCanvas');
const ctx = canvas.getContext('2d');
let width, height;
let bubbles = [];

function resizeCanvas() {
    width = canvas.width = window.innerWidth;
    height = canvas.height = document.querySelector('.projects-section').offsetHeight;
}

function createBubbles(count) {
    bubbles = [];
    for (let i = 0; i < count; i++) {
        bubbles.push({
            x: Math.random() * width,
            y: Math.random() * height,
            radius: Math.random() * 20 + 10,
            dx: (Math.random() - 0.5) * 1,
            dy: (Math.random() - 0.5) * 1,
            opacity: Math.random() * 0.5 + 0.2
        });
    }
}

function drawBubbles() {
    ctx.clearRect(0, 0, width, height);
    for (let bubble of bubbles) {
        ctx.beginPath();
        ctx.arc(bubble.x, bubble.y, bubble.radius, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(255,255,255,${bubble.opacity})`;
        ctx.fill();
    }
}

function updateBubbles() {
    for (let bubble of bubbles) {
        bubble.x += bubble.dx;
        bubble.y += bubble.dy;
        if (bubble.x < 0 || bubble.x > width) bubble.dx *= -1;
        if (bubble.y < 0 || bubble.y > height) bubble.dy *= -1;
    }
}

function animate() {
    drawBubbles();
    updateBubbles();
    requestAnimationFrame(animate);
}

window.addEventListener('resize', () => {
    resizeCanvas();
    createBubbles(30);
});

resizeCanvas();
createBubbles(30);
animate();