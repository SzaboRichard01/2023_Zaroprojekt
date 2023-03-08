<?php
session_start();
require("kapcsolat.php");
//Lapvédelem ha senki nincs bejelentkezve vagy
//ha a bejelentkezett profil típusa kliens
//akkor nem férhetünk hozzá a kliens.php oldalhoz
if (!isset($_SESSION['felh_id']) || $_SESSION['p_tipus'] == "kliens") {
    header("Location: ../belepes.php");
    exit();
} else {
    //Saját profil adatainak lekérése
    require("leker/sajatProfil.php");
}
?><!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../pics/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/app.css">
    <title>Kliensek kezelése</title>
</head>
<body>
    <!-- Felső és oldalsó menü -->
    <?php require("leker/SidebarNavbar.php"); ?>
    
    <main class="felh-main">
        <h1>Kliensek</h1>
        <div class="container">
            <div class="meglevo">
                <h2>Klienseim</h2>
                <?php require("leker/ekMeglevo.php"); ?>
            </div>
            <div class="felkeresek">
                <h2>Kliens felkérések</h2>
                <?php require("leker/felkeresek.php"); ?>
            </div>
        </div>
    </main>

    <script src="../js/script.js"></script>
</body>
</html>