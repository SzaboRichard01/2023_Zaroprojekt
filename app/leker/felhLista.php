<?php
//Keresőmező - Ha van keresett kifejezés (név) akkor a keresett kifejezésre hasonlító találatokat jeleníti meg a teljes lista helyett
$kifejezes = (isset($_POST['kifejezes'])) ? $_POST['kifejezes'] : "";

//Lekérdezés - a $felhTipus változóban adjuk meg hogy milyen típusú profilokat akarunk lekérdezni
$fosszes = mysqli_query($dbconn, "SELECT * FROM felhasznalok WHERE profil_tipus = '{$felhTipus}' AND CONCAT(vnev, ' ', knev) LIKE '%{$kifejezes}%'");

//Összes edző típusú felhasználó listájának összeállítása a $kimenet változóba
$kimenet = "";
while($felh = mysqli_fetch_assoc($fosszes)){
    $kimenet .= "<a href=\"profilAdatok.php?felhasznalo_id=" .$felh['felhasznalo_id']." \">
    <div class=\"felh\">
    <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$felh['kep']. "\"></div>
    <p>{$felh['vnev']} {$felh['knev']}</p>\n
    </div></a>";
}
//------
?>