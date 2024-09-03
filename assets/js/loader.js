window.onload = function() {
    setTimeout(function() {
        document.getElementById('loader').style.display = 'none';
        document.getElementById('content').style.display = 'block';
        document.getElementById('content').style.filter = 'none';
        document.getElementById('content').style.opacity = '1';
    }, 3000);
};