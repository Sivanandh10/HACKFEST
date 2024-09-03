window.onscroll = function() {
    const scrollIcon = document.getElementById("scrollToTop");
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        scrollIcon.classList.add("fade-in");
    } else {
        scrollIcon.classList.remove("fade-in");
    }
};

document.getElementById("scrollToTop").onclick = function() {
    window.scrollTo({ top: 0, behavior: 'smooth' }); // Smooth scroll to top
};