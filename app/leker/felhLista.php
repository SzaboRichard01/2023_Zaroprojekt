<?php
//Keresőmező - Ha van keresett kifejezés (név) akkor a keresett kifejezésre hasonlító találatokat jeleníti meg a teljes lista helyett
$kifejezes = (isset($_POST['kifejezes'])) ? $_POST['kifejezes'] : "";

//Lekérdezés - a $felhTipus változóban adjuk meg hogy milyen típusú profilokat akarunk lekérdezni
if($_SESSION['p_tipus'] == "edző"){
    $felhTipus = "kliens";
}
else{
    $felhTipus = "edző";
}

$fosszes = mysqli_query($dbconn, "SELECT felhasznalo_id, vnev, knev, kep FROM felhasznalok WHERE profil_tipus = '{$felhTipus}' AND CONCAT(vnev, ' ', knev) LIKE '%{$kifejezes}%'");

//Összes megfelelő típusú felhasználó listájának összeállítása a $kimenet változóba
$kimenet = "";
while($felh = mysqli_fetch_assoc($fosszes)){
    $fEll = "SELECT elfogadva FROM edzoklienskapcs
            WHERE fogado_az = {$_SESSION['felh_id']} AND kuldo_az = {$felh['felhasznalo_id']}
            OR kuldo_az = {$_SESSION['felh_id']} AND fogado_az = {$felh['felhasznalo_id']}";
    $fEllEredmeny = mysqli_query($dbconn, $fEll);
    $fEllSor = mysqli_fetch_assoc($fEllEredmeny);

    $fvan = 0;
    if(mysqli_num_rows($fEllEredmeny) > 0){
        $fvan = 1;
        $felfogadva = $fEllSor['elfogadva'];
    }


    $kimenet .= "<div class=\"felhKeret\">
        <a href=\"profilAdatok.php?felhasznalo_id=" .$felh['felhasznalo_id']." \">
        <div class=\"felh\">
        <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$felh['kep']. "\"></div>
        <p>{$felh['vnev']} {$felh['knev']} ";

        if($fvan == 1){
            if($felfogadva == 1){
                if($_SESSION['p_tipus'] == "edző"){
                    $kimenet .= "(Már a kliensei közé tartozik)";
                }
                if($_SESSION['p_tipus'] == "kliens"){
                    $kimenet .= "(Már az edzői közé tartozik)";
                }
            }
            else{
                $kimenet .= "(Felkérve)";
            }
        }

    $kimenet .= "</p>
    </div></a></div>";
}
//------
?>