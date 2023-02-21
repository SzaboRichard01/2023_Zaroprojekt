<?php
$felh_id = $_SESSION['felh_id'];
$pTipus = $_SESSION['p_tipus'];



$sql = "SELECT `edzo-felhasznalo_id`, edzo_az, kliens_az, felkeres_datuma, elfogadva,
        felhasznalok.felhasznalo_id, felhasznalok.vnev, felhasznalok.knev, felhasznalok.kep
        FROM `edzo-felhasznalo`
        INNER JOIN felhasznalok ON felhasznalo_id = edzo_az
        WHERE kliens_az = {$felh_id} AND elfogadva = 0
        AND CONCAT(vnev, ' ', knev) LIKE '%{$kifejezes}%'";
$eredmeny = mysqli_query($dbconn, $sql);
while($sor = mysqli_fetch_assoc($eredmeny)){
    $edzoaz = $sor['edzo_az'];


$felkeres = "";

    $felkeres .= "<div class=\"felkeres\">
    <a href=\"profilAdatok.php?felhasznalo_id=" .$sor['felhasznalo_id']." \">
    <div class=\"felh\">
    <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$sor['kep']. "\"></div>
    <p>{$sor['vnev']} {$sor['knev']}</p>\n
    </div></a>
    <button onclick=\"location.href='muveletek/fMegerosites.php?edzo_az={$edzoaz}'\">Megerősítés</button>
    <button>Elutasítás</button>
    </div>";

print($felkeres);
}
?>