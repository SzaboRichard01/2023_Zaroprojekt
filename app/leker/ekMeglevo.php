<?php
$felh_id = $_SESSION['felh_id'];
$pTipus = $_SESSION['p_tipus'];

$keresett = (isset($_POST['keresett'])) ? $_POST['keresett'] : "";

$FelkKereso = "<form method=\"post\">
        <input type=\"search\" name=\"keresett\" id=\"keresett\" placeholder=\"Írjon be egy nevet a kereséshez\">
        <input class=\"kereses-gomb\" type=\"submit\" value=\"Keresés\">";
        
        $keresett != '' ? $FelkKereso .= ("<button id='kereses-vissza' class='kereses-gomb' onclick='$keresett = ''><i class='fa fa-arrow-left' aria-hidden='true'></i> Vissza</button>") : '';
    $FelkKereso .= "</form>";
print($FelkKereso);



$sql = "SELECT kuldo_az, fogado_az, elfogadva
    FROM `edzo-felhasznalo`
    INNER JOIN felhasznalok ON felhasznalo_id = kuldo_az
    WHERE fogado_az = {$felh_id} OR kuldo_az = {$felh_id} AND elfogadva = 1
    AND CONCAT(vnev, ' ', knev) LIKE '%{$keresett}%'
    ORDER BY felkeres_datuma DESC";
$eredmeny = mysqli_query($dbconn, $sql);
$eFelkeres = "";
while($sor = mysqli_fetch_assoc($eredmeny)){
    $kuldoaz = $sor['kuldo_az'];
    $fogadoaz = $sor['fogado_az'];
    $elfogadva = $sor['elfogadva'];


    if($felh_id == $kuldoaz && $elfogadva == 1){
        $sql2 = "SELECT * FROM `edzo-felhasznalo`
                INNER JOIN felhasznalok ON felhasznalo_id = fogado_az
                WHERE kuldo_az = {$felh_id} AND fogado_az = {$fogadoaz}";
        $eredmeny2 = mysqli_query($dbconn, $sql2);
        $sor2 = mysqli_fetch_assoc($eredmeny2);
            $eFelkeres .= "
            <div class=\"felkeres\">
                <a href=\"profilAdatok.php?felhasznalo_id=" .$sor2['felhasznalo_id']." \">
                    <div class=\"felh\">
                        <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$sor2['kep']. "\"></div>
                        <p>{$sor2['vnev']} {$sor2['knev']}</p>\n
                    </div>
                </a>
                <div class=\"gombok\">
                    
                </div>
            </div>";
    }
    else if($felh_id == $fogadoaz && $elfogadva == 1){
        $sql2 = "SELECT * FROM `edzo-felhasznalo`
        INNER JOIN felhasznalok ON felhasznalo_id = kuldo_az
        WHERE fogado_az = {$felh_id} AND kuldo_az = {$kuldoaz}";
        $eredmeny2 = mysqli_query($dbconn, $sql2);
        $sor2 = mysqli_fetch_assoc($eredmeny2);
            $eFelkeres .= "
            <div class=\"felkeres\">
                <a href=\"profilAdatok.php?felhasznalo_id=" .$sor2['felhasznalo_id']." \">
                    <div class=\"felh\">
                        <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$sor2['kep']. "\"></div>
                        <p>{$sor2['vnev']} {$sor2['knev']}</p>\n
                    </div>
                </a>
                <div class=\"gombok\">
                    
                </div>
            </div>";
    }
}
print($eFelkeres);
?>