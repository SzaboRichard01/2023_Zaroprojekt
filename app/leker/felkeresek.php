<?php
$felh_id = $_SESSION['felh_id'];
$pTipus = $_SESSION['p_tipus'];

$sql = "SELECT edzo_az, kliens_az, felkeres_datuma
        FROM `edzo-felhasznalo`
        INNER JOIN felhasznalok ON felhasznalo_id = edzo_az
        WHERE kliens_az = {$felh_id}";
$eredmeny = mysqli_query($dbconn, $sql);
$sor = mysqli_fetch_assoc($eredmeny);
$edzoaz = $sor['edzo_az'];

$kifejezes = "";
$edzolekerd = mysqli_query($dbconn, "SELECT * FROM felhasznalok WHERE felhasznalo_id = {$edzoaz} AND CONCAT(vnev, ' ', knev) LIKE '%{$kifejezes}%'");

$kimenet = "";
while($sor2 = mysqli_fetch_assoc($edzolekerd)){
    $kimenet .= "<a href=\"profilAdatok.php?felhasznalo_id=" .$sor2['felhasznalo_id']." \">
    <div class=\"felh\">
    <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$sor2['kep']. "\"></div>
    <p>{$sor2['vnev']} {$sor2['knev']}</p>\n
    </div>";
}
print($kimenet);

$felkeres = "";

?>