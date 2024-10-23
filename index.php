<?php
require_once ('lib/config.php');
require_once ('lib/security.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portfolio de Julien Varachas développeur web full stack à La Rochelle - Charente Maritime 17">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.scss">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" href="assets/icones/Logo 1 BorderDev-25.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="assets/script.js" defer></script>
    <title>PortFolio - Julien</title>
</head>
<body class="background">
    <?php require_once ('templates/nav.php'); ?>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
    <main>
        <?php require_once ('templates/main.php'); ?>
    </main>
    <section class="container projects " id="projects-section">
        <?php require_once ('templates/projects.php'); ?>
    </section>
    <section class="container" id="skills-section">
        <?php require_once ('templates/skills.php'); ?>
    </section>
    <section class="container mt-5" id="about-section">
        <?php require_once ('templates/aboutme.php'); ?>
    </section>
    <section class="container mt-5 mb-5 contact" id="contact-section">
        <?php require_once ('templates/contact.php'); ?>
    </section>
    <div id="customAlert" class="custom-alert" style="display:none;">
    <div class="custom-alert-content">
        <p id="customAlertMsg"></p>
        <button class="btn" onclick="closeCustomAlert()">Fermer</button>
    </div>
</div> 
</body>
</html>