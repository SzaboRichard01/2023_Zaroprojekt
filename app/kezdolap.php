<?php
session_start();
require("kapcsolat.php");
if (!isset($_SESSION['felh_id'])) {
    header("Location: ../belepes.php");
    exit();
} else {
    //Saját profil adatainak lekérése
    require("leker/sajatProfil.php");

    $kifejezes = (isset($_POST['kifejezes'])) ? $_POST['kifejezes'] : "";

    //Kliens típusú felhasználók listája
    require('leker/felhLista.php');
}
?><!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/app.css">
    <title>Kezdőlap - <?php echo "{$vnev} {$knev}"; ?></title>
</head>
<body>
    <!-- Felső és oldalsó menü -->
    <?php require("leker/SidebarNavbar.php"); ?>
    
    <main id="kezdoMain">
        <h1>Üdvözöljük <span><?php echo "{$vnev} {$knev}!"; ?></span></h1>
        <div class="felh-lista">
            <h2><i class="fa fa-search" aria-hidden="true"></i> <?php $_SESSION['p_tipus'] == "edző" ? print("Kliensek") : print("Edzők");?> keresése</h2>
            <form method="post">
                <input type="search" name="kifejezes" id="kifejezes" placeholder="Írjon be egy nevet a kereséshez">
                <input class="kereses-gomb" type="submit" value="Keresés">
                <?php
                    $kifejezes != "" ? print("<button id=\"kereses-vissza\" class=\"kereses-gomb\" onclick=\"$kifejezes = ''\"><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Vissza</button>") : "";
                    $kifejezes != "" ? print("<p>Találatok <span>\"{$kifejezes}\"</span> kifejezésre:</p>") : '';
                ?>
            </form>

            <?php echo $kimenet ?>
        </div>
    </main>

    <script src="../js/script.js"></script>
</body>
</html>