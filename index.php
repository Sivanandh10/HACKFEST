<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/img/logo.png">
    <title>HACKFEST - An National Level Hackathon | Erode Sengunthar Engineering College</title>
    <link rel="StyleSheet" href="./assets/css/style.css?<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>

    <?php include "./loader.php"; ?>

    <?php
    include "./nav.php";
    ?>
    <div id="content">
        <div id="animatedText">Explore your ideas! Register fast..!</div>
        <script>
            const textElement = document.getElementById('animatedText');
            const originalText = textElement.innerText;

            function updateText() {
                textElement.innerText = originalText;
            }
            setInterval(updateText, 4000);
        </script>
        <div class="timer" id="countdown">
            <div id="days" class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">00</div>
                    <div class="flip-card-back">00</div>
                </div>
            </div>
            <div id="hours" class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">00</div>
                    <div class="flip-card-back">00</div>
                </div>
            </div>
            <div id="minutes" class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">00</div>
                    <div class="flip-card-back">00</div>
                </div>
            </div>
            <div id="seconds" class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">00</div>
                    <div class="flip-card-back">00</div>
                </div>
            </div>
            <div class="dhms">
                <p>Days</p>
                <p>Hrs</p>
                <p>Min</p>
                <p>Sec</p>
            </div>
        </div>
        <a href="register.php"><button class="button" id="register">Register</button></a>
        <script src="./assets/js/time.js"></script>
        <script src="./assets/js/button.js"></script>
        <div class="glow">
            <h3>Registration Is Free</h3>
            <h4>Shortlisted Ideas Has To Pay Rs.350/perHead</h4>
        </div>
        <video autoplay muted loop id="myVideo">
            <source src="./assets/video/bg.mp4" type="video/mp4">
        </video>
        <script src="./assets/js/time.js"></script>
        <a href="https://chat.whatsapp.com/BAvgvsx6lJ2CzaKIaq7dGn"><img width="50px" height="50px"
                src="./assets/img/whatsapp logo.png" alt="" class="wha-logo"><span></span></a>
        <a href="https://ig.me/j/AbbKIpeVdKUA2nw5/">
            <img width="50px" height="50px" src="./assets/img/insta logo.png" alt=""
                class="insta-logo"><span></span></a>
        <br>
        <section id="section1">
            <div class="home">
                <h1 class="hackfest">HACKFEST</h1>
                <img src="./assets/img/pngwing.com.png" alt="innovative idea"
                    width="250px " height="250px" class="home-img">
                <h3 class="home-para">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Join our 36-hour hackfest where innovators, developers, and designers come
                    together to solve real-world problems. Collaborate, create, and compete to build innovative
                    solutions using the latest technologies. Enjoy mentorship from industry experts, prizes for
                    outstanding projects, and networking opportunities with like-minded individuals. Showcase your
                    skills, learn from others, and take your ideas to the next level! Our hackfest is the perfect
                    platform to transform your ideas into reality, make a difference, and have fun while doing it. So,
                    gather your team, register now, and get ready to hack, learn, and grow!"</h3>
            </div>
        </section>
        <section>
            <div class="slider">
                <h1 class="sponser">SPONSORS</h1>
                <div class="slide-track">
                    <div class="slide">
                        <img src="./assets/img/livewire.png" alt="SPONSERSHIP">
                    </div>
                    <div class="slide">
                        <img src="./assets/img/livewire.png" alt="SPONSERSHIP">
                    </div>
                    <div class="slide">
                        <img src="./assets/img/livewire.png" alt="SPONSERSHIP">
                    </div>
                    <div class="slide">
                        <img src="./assets/img/livewire.png" alt="SPONSERSHIP">
                    </div>
                    <div class="slide">
                        <img src="./assets/img/livewire.png" alt="SPONSERSHIP">
                    </div>
                </div>
            </div>
        </section>
        <section id="section2">
            <div class="about">
                <h2 class="hackfest6">ABOUT US</h2>
            </div>
            <div class="abo-container">
                <div class="abo-wrapper">
                    <img src="./assets/img/mainblock.png">
                    <img src="./assets/img/slide2.webp">
                    <img src="./assets/img/arvr.jpeg">
                    <img src="./assets/img/lib.webp">
                </div>
            </div>
            <div class="obj-abo">
                <h3 class="about-obj">"Erode Sengunthar Engineering College (ESEC) is a premier institution located in
                    Erode, Tamil Nadu, dedicated to providing quality education in the field of engineering and
                    technology. Established in 1996, ESEC is affiliated with Anna University and approved by AICTE, New
                    Delhi. The college is recognized for its commitment to excellence in education, research, and
                    innovation."</h3>
                <div class="vi-but"><a href="https://erode-sengunthar.ac.in/"><button class="visit-site"><b>VISIT SITE</b></button></a></div>
            </div>
        </section>
        <section id="section3">
            <div class="title">
                <h1 class="hackfest1">SCHEDULE</h1>
                <p><b>TimeLine Of Event</b></p>
            </div>
            <div class="timeline">
                <div class="checkpoint">
                    <div>
                        <h2>22/09/2024 </h2>
                        <P><b>&nbsp;&nbsp;&nbsp;Hurry Up !
                                !</b><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Time's
                            Running Out! Don't Let Your Ideas Slip Away! Submit Now and Take the First Step towards
                            Success</P>
                    </div>
                </div>
                <div class="checkpoint">
                    <div>
                        <h2>23/09/2024</h2>
                        <P>Selected Teams, Get Ready! You'll receive a confirmation email or WhatsApp message from us
                            once your team is selected. Stay tuned!</P>
                    </div>
                </div>
                <div class="checkpoint">
                    <div>
                        <h2>24/09/2024</h2>
                        <P>Don't miss the deadline! The last date for payment to selected teams or ideas.</P>
                    </div>
                </div>
                <div class="checkpoint">
                    <div>
                        <h2>25/09/2024</h2>
                        <P>The countdown begins! The event will be starting soon, and it's time to explore the latest
                            innovations and trends</P>
                    </div>
                </div>
                <div class="checkpoint">
                    <div>
                        <h2>27/09/2024 </h2>
                        <P>The Hackfest event will end, and we'll be celebrating the winners and their innovative
                            solutions that will shape the future.</P>
                    </div>
                </div>
            </div>
        </section>
        <section class="course">
            <div class="hf">
                <h1 class="prize">Hackfest Grand Prizes!</h1>
            </div>
            <p class="show"><b>Show off your skills and win big!</b>
            </p>
            <div class="row">

                <div class="course-col">

                    <h1 class="st"><b>WORTH OF</b></h1>
                    <h2 class="cpst">RS.50,000/-
                        <br> +
                    </h2>
                    <h3 class="dayst">30days Free Internship</h3>
                    <h4>With Certificate</h4>
                </div>
            </div>
            <h1 class="PARTI">"ALL PARTICIPANT WILL RECIVE PARTICIPATED<br> CERTIFICATE"</h1>
        </section>
        <h1 class="hackfest2">JURY MEMBERS</h1>
        <div class="jury-container">
            <div class="jury-member">
                <img src="./assets/img/ANANDH SAMY.jpeg" alt="Jury Member 1" class="jury-photo">
                <h3 class="jury-name">ANANDH SAMY</h3>
                <p class="jury-details">Enterprise Cyber Security Strategist | SIEM Consultant<BR> at <b>ZOHO
                        CORPORATION</b></p>
            </div>
            <div class="jury-member">
                <img src="./assets/img/ASHOKKUMAR MANISEKARAN.jpeg" alt="Jury Member 2" class="jury-photo">
                <h3 class="jury-name">ASHOKKUMAR MANISEKARAN</h3>
                <p class="jury-details">ENTREPRENEUR | FOUNDER | DEVELOPER |TRAINER<BR>at <b>PRAYA LABS</b></p>
            </div>
            <script>
                document.querySelectorAll('.jury-member').forEach(member => {
                    member.addEventListener('mouseover', () => {
                        member.style.opacity = '1';
                    });
                    member.addEventListener('mouseout', () => {
                        member.style.opacity = '1';
                    });
                });
            </script>
        </div>
        <div class="rl">
            <ul class="accordion">
                <h1 class="hackfest5">RUELS</h1><BR>
                <li>
                    <input type="radio" name="accordion" id="first" radio>
                    <label for="first">
                        <h6 class="q">HOW MUCH MEMBERS IN A TEAM ?</h6>
                    </label>
                    <div class="content">
                        <p>In a Team there can me maximum of 4 members and should not less than 2 members.</p>
                    </div>
                </li>
                <li>
                    <input type="radio" name="accordion" id="second">
                    <label for="second">
                        <h6 class="q">TEAM CAN BE FROM DIFFERENT COLLEGE AND DEPARTMENT ARE ALLOWED ?</h6>
                    </label>
                    <div class="content">
                        <p>Teams from different departments are allowed,But from different college are not allowed.</p>
                    </div>
                </li>
                <li>
                    <input type="radio" name="accordion" id="third">
                    <label for="third">
                        <h6 class="q">DOES IT IS HELD IN ONLINE OR OFFLINE?</h6>
                    </label>
                    <div class="content">
                        <p>To submit your idea it's online,After sortlisted of your team there will be offline event.
                        </p>
                    </div>
                </li>
                <li>
                    <input type="radio" name="accordion" id="fourth">
                    <label for="fourth">
                        <h6 class="q">DOES WE HAVE TO PAY MONEY FOR IDEA SUBBMISSION ?</h6>
                    </label>
                    <div class="content">
                        <p>For idea subbmission it's completely free,After shortlisted you have to pay money to join the
                            event </p>
                    </div>
                </li>
            </ul>
        </div>
        <?php
        include "./footer.php";
        ?>
    </div>
    </div>
    </div>
    <div id="scrollToTop" class="scroll-icon">&#8593;</div>
    <script src="./assets/js/scroll.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>