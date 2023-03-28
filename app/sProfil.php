<?php
session_start();
if (!isset($_SESSION['felh_id'])) {
    header("Location: ../belepes.php");
    exit();
} else {
    require("kapcsolat.php");
    define('eleres', true);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../pics/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/app.css">
    <title><?php echo("{$vnev} {$knev}") ?> - Saját profil</title>
</head>
<body>
    <!-- Felső és oldalsó menü -->
    <?php require("leker/SidebarNavbar.php"); ?>

    <main>
        <h1 class="sprofh">Saját profil adatai</h1>
        <div class="sikeres">
            <?php
                if(isset($_SESSION['sikAdatMod'])){
                    print $_SESSION['sikAdatMod'];
                    unset($_SESSION['sikAdatMod']);
                }
            ?>
        </div>
        <!-- Saját profil adatainak megjelenítése a $kimenet változóból -->
        <div class="fadatok">
            <?php print($kimenet) ?>
        </div>
    </main>

    <script src="../js/script.js"></script>
</body>
</html>