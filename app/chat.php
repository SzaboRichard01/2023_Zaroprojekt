<?php
session_start();
if (!isset($_SESSION['felh_id'])) {
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
    <link rel="stylesheet" href="../css/app.css">
    <!-- <link rel="stylesheet" href="../css/chat.css"> -->
    <title>Kezdőlap - <?php echo "{$vnev} {$knev}"; ?></title>
</head>
<body>
    <!-- Felső és oldalsó menü -->
    <?php require("leker/SidebarNavbar.php"); ?>
    
    <main>
        <?php
            print("<div class=\"felh\">
            <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$sor['kep']. "\"></div>
            <p>{$sor['vnev']} {$sor['knev']}</p>\n
            </div>");
        ?>
        <div class="chat">
        </div>
        <div class="chatszoveg">
        <form method="post">
            <input type="text" name="uzenet" id="uzenet">
            <input type="submit" value="Küldés" name="kuldes" id="kuldes">
        </form>
        </div>
    </main>

    <script src="../js/script.js"></script>
</body>
</html>