<style>
    #load-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(5px);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    #loader {
        width: 150px;
        height: 150px;
        animation: zoom 1.5s ease-in infinite;
    }

    #loader img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    @keyframes zoom {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.3);
        }

        100% {
            transform: scale(1);
        }
    }
</style>

<div id="load-container">
    <div id="loader">
        <img src="./assets/img/logo.png" alt="HackFest Logo">
    </div>
</div>

<script>
    window.addEventListener('load', function () {
        const loader = document.getElementById('load-container');
        loader.style.display = 'none';
    });

    window.addEventListener('beforeunload', function () {
        const loader = document.getElementById('load-container');
        loader.style.display = 'flex';
    });

    // Show loader 
    function showLoader() {
        $('#load-container').fadeIn();
    }

    // Hide loader
    function hideLoader() {
        $('#load-container').fadeOut();
    }

    // Show loader on form submit
    $('form').submit(function () {
        showLoader();
    });
</script>