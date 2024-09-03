const endDate = new Date("september 22, 2024 00:00:00").getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = endDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            updateTimerDisplay("days", days);
            updateTimerDisplay("hours", hours);
            updateTimerDisplay("minutes", minutes);
            updateTimerDisplay("seconds", seconds);
        }

        function updateTimerDisplay(unit, value) {
            const unitElement = document.getElementById(unit);
            const flipCardInner = unitElement.querySelector('.flip-card-inner');
            const  currentValue = flipCardInner.querySelector('.flip-card-front').textContent;
            const newValue = String(value).padStart(2, '0');

            if (currentValue !== newValue) {
                flipCardInner.querySelector('.flip-card-back').textContent = newValue;

                flipCardInner.style.transform = 'rotateY(180deg)';

                setTimeout(() => {
                    flipCardInner.querySelector('.flip-card-front').textContent = newValue;
                    flipCardInner.style.transform = 'rotateY(0deg)';
                }, 300); 
            }
        }

        setInterval(updateCountdown, 1000);