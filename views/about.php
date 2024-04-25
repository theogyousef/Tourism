<?php


// require '../controller/config.php';
require '../includes/config.php';
require '../includes/Dbh.php';

// include "header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="../public/css/about.css">
</head>

<body>
    <header>
        <h1>About Us</h1>
    </header>

    <div class="container">
        <div class="about-section">
            <h2>Our Story</h2>
            <p>Our team recognized the challenges facing Egypt's tourism sector, particularly the lack of a centralized booking system for transportation and accommodations. To address this issue, we developed an innovative solution aimed at streamlining travel arrangements and enhancing the overall tourism experience in Egypt. By integrating booking services into a single platform, we aim to provide convenience and efficiency for both tourists and citizens exploring Egypt's cultural heritage and tourist attractions. Our mission is to unlock the full potential of Egypt's tourism industry and create unforgettable experiences for travelers worldwide..</p>
        </div>

        <div class="team-section">
            <h2>Our Team</h2>
            <div class="team-member">
                <h3>Youssef Ehab</h3>
                <p>Co-Founder</p>
            </div>
            <div class="team-member">
                <h3>Moaz Mohamed</h3>
                <p>Lead Developer</p>
            </div>
            <div class="team-member">
                <h3>Mariam Samy</h3>
                <p>Designer</p>
            </div>
            <div class="team-member">
                <h3>Mohamed Rabeei</h3>
                <p>Marketing Manager</p>
            </div>
        </div>
    </div>

    <footer>
        <?php
        include "footer.php";
        ?>
    </footer>
</body>

</html>