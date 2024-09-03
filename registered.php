<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Successfully</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
            background-color: #d0e1f9; 
        }

        h1 {
            margin-bottom: 20px;
            color: #10d760;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.3);
        }

        .container {
            position: relative;
            z-index: 1;
            background: rgba(79, 78, 78, 0.8); 
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .checkmark {
            margin: 20px 0;
            width: 250px; 
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        .message {
            font-size: 20px;
            margin: 10px 0;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }

        .bold {
            font-weight: bold;
            margin-top: 10px;
            font-size: 22px;
        }

        .back-button {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            background-color: #2e656d;
            color: white;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            font-size: 18px;
            margin-top: 20px;
        }

        .back-button:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(0, 255, 0, 0.7);
            background-color: #3b7a7e;
        }

        .animated-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://www.transparenttextures.com/patterns/diagonal-stripes-light.png');
            opacity: 0.1;
            z-index: 0;
        }
        .containers{
    margin: 10px auto;
    padding: 10px;
    background: #595959;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 500px;
}

h2 {
    color: #ec111199;
    font-size: 20px;
}
h3{
    color: white;
    
}

.social-icons {
    margin-top: 20px;
}

.social-icons a {
    margin: 0 15px;
}

.social-icons img {
    width: 40px; 
    height: 40px; 
}
        #myVideo {
    position: fixed;
    right: 0;
    bottom: 0;
    min-width: 100%;
    min-height: 100%;
    z-index: -1;
  }
    </style>
</head>
<body>
    <video autoplay muted loop id="myVideo">
        <source src="./assets/video/bg.mp4" type="video/mp4">
      </video>
    <div class="animated-bg"></div>
    <div class="container">
        <h1>REGISTERED SUCCESSFULLY</h1>
        <img class="checkmark" src="./assets/tick.gif" alt="Checkmark">
        <div class="message">Congratulation, you were registered successfully!</div>
        <div class="bold">STAY TUNED! WE WILL REACH YOU SOON THROUGH MAIL & WHATSAPP</div>
        <div class="containers">
            <h3><h2>Join Us!</h2>Keep Touch Get Updated</h3>
            <div class="social-icons">
                <a href="https://chat.whatsapp.com/BAvgvsx6lJ2CzaKIaq7dGn" target="_blank">
                    <img src="./assets/whatsapp logo.png" alt="WhatsApp" />
                </a>
                <a href="https://ig.me/j/AbbKIpeVdKUA2nw5/" target="_blank">
                    <img src="./assets/insta logo.com" alt="Instagram" />
                </a>
                <a href="https://t.me/+FzVtNwaFRNYzYjc1" target="_blank">
                    <img src="./assets/telegram.png" alt="Telegram" />
                </a>
            </div>
        </div>
        <button class="back-button" onclick="window.location.href='/'">BACK TO HOME</button>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
});
    </script>
</body>
</html>