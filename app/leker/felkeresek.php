<?php
$felh_id = $_SESSION['felh_id'];
$pTipus = $_SESSION['p_tipus'];

$FelKeresett = (isset($_POST['FelKeresett'])) ? $_POST['FelKeresett'] : "";

$FelkKereso = "<form method=\"post\">
        <input type=\"search\" name=\"FelKeresett\" id=\"FelKeresett\" placeholder=\"Írjon be egy nevet a kereséshez\">
        <input class=\"kereses-gomb\" type=\"submit\" value=\"Keresés\">";
        
        $FelKeresett != '' ? $FelkKereso .= ("<button id='kereses-vissza' class='kereses-gomb' onclick='$FelKeresett = ''><i class='fa fa-arrow-left' aria-hidden='true'></i> Vissza</button>") : '';
    $FelkKereso .= "</form>";
print($FelkKereso);

$sql = "SELECT ekkapcs_id, kuldo_az, fogado_az, felkeres_datuma, elfogadva,
    felhasznalok.felhasznalo_id, felhasznalok.vnev, felhasznalok.knev, felhasznalok.kep
    FROM ekkapcs
    INNER JOIN felhasznalok ON felhasznalo_id = kuldo_az
    WHERE fogado_az = {$felh_id} AND elfogadva = 0
    AND CONCAT(vnev, ' ', knev) LIKE '%{$FelKeresett}%'
    ORDER BY felkeres_datuma DESC";
$eredmeny = mysqli_query($dbconn, $sql);
$eFelkeres = "";
while($sor = mysqli_fetch_assoc($eredmeny)){
    $kuldoaz = $sor['kuldo_az'];
    $teljesnev = "{$sor['vnev']} {$sor['knev']}";
    $eFelkeres .= "
    <div class=\"felkeres\">
        <a href=\"profilAdatok.php?felhasznalo_id=" .$sor['felhasznalo_id']." \" title=\"Profil megtekintése\">
            <div class=\"felh\">
                <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$sor['kep']. "\"></div>
                <p>{$sor['vnev']} {$sor['knev']}</p>\n
            </div>
        </a>
        <div class=\"gombok\">
            <button onclick=\"btnElfogad({$kuldoaz}, '{$teljesnev}')\">Elfogadás</button>
            <button onclick=\"btnElutasit({$kuldoaz}, '{$teljesnev}')\">Elutasítás</button>
        </div>
    </div>";
}
print($eFelkeres);
?>