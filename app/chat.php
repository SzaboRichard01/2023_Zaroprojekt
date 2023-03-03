<?php
session_start();
if (!isset($_SESSION['felh_id'])) {
    header("Location: ../belepes.php");
    exit();
} else {
    require("kapcsolat.php");
    //Saját profil adatainak lekérése
    require("leker/sajatProfil.php");
}

$kifejezesChat = (isset($_POST['kifejezesChat'])) ? $_POST['kifejezesChat'] : "";

if ($_SESSION['p_tipus'] == "edző") {
    $felhChat = "kliens";
}else{
    $felhChat = "edző";
}

$foszzesChat = mysqli_query($dbconn, "SELECT * FROM felhasznalok WHERE profil_tipus = '{$felhChat}' AND CONCAT(vnev, ' ', knev) LIKE '%{$kifejezesChat}%'");

$kimenetChat = "";
while($felhasznalo = mysqli_fetch_assoc($foszzesChat)) {
    $felhEllenorzes = "SELECT * FROM ekkapcs
                        WHERE fogado_az = {$_SESSION['felh_id']} AND kuldo_az = {$felhasznalo['felhasznalo_id']}
                        OR kuldo_az = {$_SESSION['felh_id']} AND fogado_az = {$felhasznalo['felhasznalo_id']}";
    $felhEllEredmeny = mysqli_query($dbconn, $felhEllenorzes);
    $felhEllSor = mysqli_fetch_assoc($felhEllEredmeny);


$felhVan = 0;
if (mysqli_num_rows($felhEllEredmeny) > 0) {
    $felhVan = 1;
    $felhElfogadva = $felhEllSor['elfogadva'];
}

$kimenetChat .= "                 
                 <div class=\"prof\">
                 <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$felhasznalo['kep']. "\"></div>
                 <p>{$felhasznalo['vnev']} {$felhasznalo['knev']}</p>
                 </div>";
}
$kimenetChat .= "";
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
    <title>Kezdőlap - <?php echo "{$vnev} {$knev}"; ?></title>
</head>
<body>
    <!-- Felső és oldalsó menü -->
    <?php require("leker/SidebarNavbar.php"); ?>
    
    <div class="wrapper">
        <div class="left_side_pannel">
            <a class="mcim">ShineGym&Fit</a>
            <div class="contact">
                <form method="post">
                <input type="search" name="kifejezesChat" id="kifejezesChat" placeholder="Írjon be egy nevet a kereséshez">
                <button id="kereses"><i class="fa fa-search"></i></button>
                </form>
                <?php print $kimenetChat;?>
            </div>
        </div>
        <div class="right_side_pannel">
            <div class="header">
            <div class="prof" onclick="location.href='sProfil.php';">
                <?php
                print "<p>{$vnev} {$knev}</p>
                    <div class=\"pkep\">{$profilkep}</div>";
                ?>
            </div>
            </div>
            <div class="container">
                <form method="post" class="chat-szoveg-kuldes">
                <textarea type="text" name="szoveg" id="szoveg" placeholder="Ide írja a szöveget..." style="font-family: 'Nunito', sans-serif; color: var(--feher); padding-top: 13px;"></textarea>
                <input type="submit" value="Küldés" name="kuldesChat" id="kuldesChat">
                </form>
            </div>
        </div>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>