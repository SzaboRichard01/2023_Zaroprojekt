<?php
session_start();
require("../kapcsolat.php");
$edzestervID =  mysqli_real_escape_string($dbconn, $_GET['edzesterv']);

//Edzésterv alap adatai
$etSQL = mysqli_query($dbconn, "SELECT neve, leiras, ekkapcs_id FROM edzesterv WHERE edzesterv_id = {$edzestervID}");
$etA = mysqli_fetch_assoc($etSQL);
$etNeve = $etA['neve'];
$etLeiras = $etA['leiras'];
$ekkapcsID = $etA['ekkapcs_id'];

//Melyik az edző
$sqlKapcs = mysqli_query($dbconn, "SELECT kuldo_az, fogado_az FROM ekkapcs WHERE ekkapcs_id = {$ekkapcsID}");
$kapcsSor = mysqli_fetch_assoc($sqlKapcs);
$kuldoAz = $kapcsSor['kuldo_az'];
$fogadoAz = $kapcsSor['fogado_az'];
if($kuldoAz == $_SESSION['felh_id']){
    $edzoID = $fogadoAz;
}
else{
    $edzoID = $kuldoAz;
}
//----

$sqlEdzo = mysqli_query($dbconn, "SELECT vnev, knev FROM felhasznalok WHERE felhasznalo_id = {$edzoID}");
$edzoEr = mysqli_fetch_assoc($sqlEdzo);
$edzoNeve = "{$edzoEr['vnev']} {$edzoEr['knev']}";


//----

//Edzésterv edzés része
$edzSQL = mysqli_query($dbconn, "SELECT nap, edzesterv FROM edzes WHERE edzesterv_id = {$edzestervID}");
$etEdzes = "";
$edzDb = mysqli_num_rows($edzSQL); //Hány darab edzésnap tartozik az adott edzéstervhez
while($edzSor = mysqli_fetch_assoc($edzSQL)){
    $etEdzes .= "<div class=\"etEdzes\">
        <h3>{$edzSor['nap']}</h3>
        <p>{$edzSor['edzesterv']}</p>
    </div>";
}
//---

//Edzésterv étrend része
$etSQL = mysqli_query($dbconn, "SELECT nap, etrend FROM etrend WHERE edzesterv_id = {$edzestervID}");
$etEtrend = "";
$etDb = mysqli_num_rows($etSQL); // Hány darab értrend tartozik az adott edzéstervhez
while($etSor = mysqli_fetch_assoc($etSQL)){
    $etEtrend .= "<div class=\"etEtrend\">
        <h3>{$etSor['nap']}</h3>
        <p>{$etSor['etrend']}</p>
    </div>";
}
//---

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
    <link rel="stylesheet" href="../../css/app.css">
    <title>Étrend</title>
</head>
<body>
    <?php
    //Sajnát profil adatai (Navbar részhez)
    require("../leker/sajatProfil.php");

    //Felső és oldalsó menü
    require("../leker/SidebarNavbar.php");
    ?>
    <main>
        <div class="tEdzesterv">
            <div class="etneve">
                <p>Edzésterv neve</p>
                <h3><?php print $etNeve; ?></h3>
            </div>
            <div class="etLeiras">
                <h3>Leírás</h3>
                <p><?php print $etLeiras; ?></p>
            </div>
            <div class="etTartalom">
                <div class="etEdzesek">
                    <h2>Edzés</h2>
                    <?php print $etEdzes; ?>
                </div>
                <div class="etEtrendek">
                    <h2>Étrend</h2>
                    <?php print $etEtrend; ?>
                </div>
            </div>
            <div class="etkitol">
                <p>Edző neve</p>
                <h3><?php print $edzoNeve; ?></h3>
            </div>
        </div>
    </main>
</body>
</html>