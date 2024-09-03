// script.js
document.addEventListener("DOMContentLoaded", function() {
    const members = document.querySelectorAll('.member');
    members.forEach((member) => {
        member.addEventListener('mouseenter', () => {
            member.style.boxShadow = "0 8px 20px rgba(0, 0, 0, 0.3)";
            member.style.transform = "scale(1.05)";
        });

        member.addEventListener('mouseleave', () => {
            member.style.boxShadow = "";
            member.style.transform = "";
        });
    });
});