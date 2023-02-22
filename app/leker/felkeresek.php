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

$sql = "SELECT `edzo-felhasznalo_id`, kuldo_az, fogado_az, felkeres_datuma, elfogadva,
    felhasznalok.felhasznalo_id, felhasznalok.vnev, felhasznalok.knev, felhasznalok.kep
    FROM `edzo-felhasznalo`
    INNER JOIN felhasznalok ON felhasznalo_id = kuldo_az
    WHERE fogado_az = {$felh_id} AND elfogadva = 0
    AND CONCAT(vnev, ' ', knev) LIKE '%{$keresett}%'
    ORDER BY felkeres_datuma DESC";
$eredmeny = mysqli_query($dbconn, $sql);
$eFelkeres = "";
while($sor = mysqli_fetch_assoc($eredmeny)){
    $kuldoaz = $sor['kuldo_az'];
    $eFelkeres .= "
    <div class=\"felkeres\">
        <a href=\"profilAdatok.php?felhasznalo_id=" .$sor['felhasznalo_id']." \">
            <div class=\"felh\">
                <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$sor['kep']. "\"></div>
                <p>{$sor['vnev']} {$sor['knev']}</p>\n
            </div>
        </a>
        <div class=\"gombok\">
            <button onclick=\"location.href='muveletek/fMegerosites.php?kuldo_az={$kuldoaz}'\">Elfogadás</button>
            <button onclick=\"location.href='muveletek/fElutasitas.php?kuldo_az={$kuldoaz}'\">Elutasítás</button>
        </div>
    </div>";
}
print($eFelkeres);
?>