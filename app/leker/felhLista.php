<?php
//Keresőmező - Ha van keresett kifejezés (név) akkor a keresett kifejezésre hasonlító találatokat jeleníti meg a teljes lista helyett
$kifejezes = (isset($_POST['kifejezes'])) ? $_POST['kifejezes'] : "";

//Lekérdezés - a $felhTipus változóban adjuk meg hogy milyen típusú profilokat akarunk lekérdezni
$eredmeny = mysqli_query($dbconn, "SELECT * FROM felhasznalok WHERE profil_tipus = '{$felhTipus}' AND CONCAT(vnev, ' ', knev) LIKE '%{$kifejezes}%'");

//Összes edző típusú felhasználó listájának összeállítása a $kimenet változóba
$kimenet = "";
while($sor = mysqli_fetch_assoc($eredmeny)){
    $kimenet .= "<a href=\"profilAdatok.php?felhasznalo_id=" .$sor['felhasznalo_id']." \">
    <div class=\"felh\">
    <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$sor['kep']. "\"></div>
    <p>{$sor['vnev']} {$sor['knev']}</p>\n
    </div>";
}
//------
?>