<?php
session_start();
if (!isset($_SESSION['felh_id'])) {
    header("Location: ../belepes.php");
    exit();
} else {
    define('eleres', true);
    require("kapcsolat.php");
    //Saját profil adatainak lekérése
    require("leker/sajatProfil.php");


    //Oldalsó lista
    //Keresőmező - Ha van keresett kifejezés (név) akkor a keresett kifejezésre hasonlító találatokat jeleníti meg a teljes lista helyett
    $kifejezesChat = (isset($_POST['kifejezesChat'])) ? $_POST['kifejezesChat'] : "";
    //Lekérdezés - a $felhChat változóban adjuk meg hogy milyen típusú profilokat akarunk lekérdezni
    if ($_SESSION['p_tipus'] == "edző") {
        $felhChat = "kliens";
    }else{
        $felhChat = "edző";
    }

    $fosszesChat = mysqli_query($dbconn, "SELECT * FROM felhasznalok WHERE profil_tipus = '{$felhChat}' AND CONCAT(vnev, ' ', knev) LIKE '%{$kifejezesChat}%'");
    //Összes edző típusú felhasználó listájának összeállítása a $chatLista változóba
    $chatLista = "";
    while($felhasznalo = mysqli_fetch_assoc($fosszesChat)) {
        $chatLista .= "<a href=\"?chat={$felhasznalo['felhasznalo_id']}\">          
                        <div class=\"prof\">
                        <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$felhasznalo['kep']. "\"></div>
                        <p>{$felhasznalo['vnev']} {$felhasznalo['knev']}</p>
                        </div>
                    </a>";
    }
    //oldalsó lista vége

    //Chat rész
    if (isset($_GET['chat'])) {
        $sqlValP = mysqli_query($dbconn, "SELECT vnev, knev, kep, profil_tipus FROM felhasznalok WHERE felhasznalo_id = {$_GET['chat']}");
        $ValP = mysqli_fetch_assoc($sqlValP);
        $Vvnev = $ValP['vnev'];
        $Vknev = $ValP['knev'];
        $Vkep = $ValP['kep'];
        $Vptipus = $ValP['profil_tipus'];
        
        if($_SESSION['p_tipus'] == "edző" && $Vptipus == "kliens" || $_SESSION['p_tipus'] == "kliens" && $Vptipus == "edző"){
            $_SESSION['chataz'] = $_GET['chat'];
            $fogadoAz = $_GET['chat'];
            if(isset($_POST['ChatUzenet']) && $_POST['szoveg'] != ""){
                $uzenet = $_POST['szoveg'];
                $sqlBeszur = mysqli_query($dbconn, "INSERT INTO uzenetek (kimeno_id, bejovo_id, uzenet) VALUES ('{$_SESSION['felh_id']}', '{$fogadoAz}', '{$uzenet}')");
            }
        } else{
            header("Location: hiba.html");
        }

    }
    //Chat rész vége
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
    <title>Chat - <?php echo "{$vnev} {$knev}"; ?></title>
</head>
<body>
    <!-- Felső és oldalsó menü -->
    <?php require("leker/SidebarNavbar.php"); ?>
    <main class="chatMain">
        <div class="chatWrapper">
            <div class="left_side_pannel">
                <a class="mcim">ShineGym&Fit</a>
                <div class="contact">
                    <form method="post">
                    <input type="search" name="kifejezesChat" id="kifejezesChat" placeholder="Írjon be egy nevet a kereséshez">
                    <button id="kereses"><i class="fa fa-search"></i></button>
                    </form>
                    <?php print $chatLista;?>
                </div>
            </div>
            <div class="right_side_pannel">
                <div class="header">
                    <?php
                    if(isset($_GET['chat'])){
                        $profil = "<div class=\"prof\" onclick=\"location.href='profilAdatok.php?felhasznalo_id={$_GET['chat']}';\">";

                        isset($_GET['chat']) ? $profil .= "<div class=\"pkep\"><img src=\"../pics/profile/{$Vkep}\"></div><p>{$Vvnev} {$Vknev}</p>" : '';

                        $profil .= "</div>";
                        print $profil;
                    }
                    ?>
                </div>
                <div class="container">
                    <div class="chatUzenetek">
                        <!-- Üzenetek kiírása -->
                    </div>
                    <form method="post" class="chat-szoveg-kuldes">
                    <textarea type="text" name="szoveg" id="szoveg" placeholder="Ide írja a szöveget..." style="font-family: 'Nunito', sans-serif; padding-top: 13px;"></textarea>
                    <button type="submit" name="ChatUzenet" id="ChatUzenet" title="Küldés"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="leker/chat.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>