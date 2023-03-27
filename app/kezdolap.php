<?php
session_start();
if (!isset($_SESSION['felh_id'])) {
    header("Location: ../belepes.php");
    exit();
} else {
    require("kapcsolat.php");

    //Saját profil adatainak lekérése
    require("leker/sajatProfil.php");

    //felhasználók listája
    require('leker/felhLista.php');
}?><!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../pics/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/app.css">
    <title>Kezdőlap - <?php echo "{$vnev} {$knev}"; ?></title>
</head>
<body>
    <!-- Felső és oldalsó menü -->
    <?php require("leker/SidebarNavbar.php"); ?>
    
    <main id="kezdoMain">

        <div class="sikeres">
            <?php
                if(isset($_SESSION['tevrogz'])){
                    print $_SESSION['tevrogz'];
                    unset($_SESSION['tevrogz']);
                }
            ?>
        </div>

        <h1>Üdvözöljük <span><?php echo "{$vnev} {$knev}!"; ?></span></h1>
        <div class="felh-lista scrollbar">
            <h2><i class="fa fa-search" aria-hidden="true"></i> <?php $_SESSION['p_tipus'] == "edző" ? print("Kliensek") : print("Edzők");?> keresése</h2>
            <form method="post">
                <input type="search" name="kifejezes" id="kifejezes" placeholder="Írjon be egy nevet a kereséshez">
                <input class="kereses-gomb" type="submit" value="Keresés">
                <?php
                    $kifejezes != "" ? print("<button id=\"kereses-vissza\" onclick=\"$kifejezes = ''\"><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Vissza</button>") : "";
                    $kifejezes != "" ? print("<p>Találatok <span>\"{$kifejezes}\"</span> kifejezésre:</p>") : '';
                ?>
            </form>

            <?php echo $kimenet ?>
        </div>
        <?php
            if($_SESSION['p_tipus'] == "kliens"){
                require("leker/tevekenysegek.php");

                if(isset($_GET['tev'])){
                    $tevAzon =  mysqli_real_escape_string($dbconn, $_GET['tev']);
                    $valTevsql = mysqli_query($dbconn, "SELECT datum, leiras FROM tevekenysegek WHERE tev_id = '{$tevAzon}' AND felhasznalo_id = {$_SESSION['felh_id']}");
                    $sTev = mysqli_fetch_assoc($valTevsql);
                    
                    if(mysqli_num_rows($valTevsql) != 0){
                        $tevTeljes = "<div class=\"tevTeljes\">
                        <p class=\"tdatum\">{$sTev['datum']}</p>
                            <div class=\"tleiras\">".
                                $sTev['leiras']
                            ."</div>
                            <i class=\"fa fa-times bezar\" aria-hidden=\"true\" onclick=\"tevTeljesBezar()\" title=\"Bezárás\"></i>
                            <div class=\"tevTeljGombok\">
                                <button onclick=\"tevTejlTorles('{$sTev['datum']}', {$tevAzon})\" title=\"Törlés\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button>
                                <button title=\"Módosítás\" onclick=\"location.href='muveletek/tevModositas.php?tevid={$tevAzon}'\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></button>
                            </div>
                        </div>";
                        
                        print $tevTeljes;
                    }
                }
            }
        ?>
    </main>

    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>