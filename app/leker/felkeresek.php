<?php
$felh_id = $_SESSION['felh_id'];
$pTipus = $_SESSION['p_tipus'];

$keresett = (isset($_POST['keresett'])) ? $_POST['keresett'] : "";

/*Csak akkor jelenjen meg a keresőmező
és a felkérések lista
ha bejelentkezett profil típusa kliens*/
if($pTipus == "kliens"){
    $eFelkKereso = "<form method=\"post\">
            <input type=\"search\" name=\"keresett\" id=\"keresett\" placeholder=\"Írjon be egy nevet a kereséshez\">
            <input class=\"kereses-gomb\" type=\"submit\" value=\"Keresés\">";
            
            $keresett != '' ? $eFelkKereso .= ("<button id='kereses-vissza' class='kereses-gomb' onclick='$keresett = ''><i class='fa fa-arrow-left' aria-hidden='true'></i> Vissza</button>") : '';

        $eFelkKereso .= "</form>";
    print($eFelkKereso);

    $sql = "SELECT `edzo-felhasznalo_id`, edzo_az, kliens_az, felkeres_datuma, elfogadva,
        felhasznalok.felhasznalo_id, felhasznalok.vnev, felhasznalok.knev, felhasznalok.kep
        FROM `edzo-felhasznalo`
        INNER JOIN felhasznalok ON felhasznalo_id = edzo_az
        WHERE kliens_az = {$felh_id} AND elfogadva = 0
        AND CONCAT(vnev, ' ', knev) LIKE '%{$keresett}%'
        ORDER BY felkeres_datuma DESC";
    $eredmeny = mysqli_query($dbconn, $sql);

    $eFelkeres = "";
    while($sor = mysqli_fetch_assoc($eredmeny)){
        $edzoaz = $sor['edzo_az'];

        $eFelkeres .= "
        <div class=\"felkeres\">
            <a href=\"profilAdatok.php?felhasznalo_id=" .$sor['felhasznalo_id']." \">
                <div class=\"felh\">
                    <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$sor['kep']. "\"></div>
                    <p>{$sor['vnev']} {$sor['knev']}</p>\n
                </div>
            </a>
            <div class=\"gombok\">
                <button onclick=\"location.href='muveletek/fMegerosites.php?edzo_az={$edzoaz}'\">Elfogadás</button>
                <button onclick=\"location.href='muveletek/fElutasitas.php?edzo_az={$edzoaz}'\">Elutasítás</button>
            </div>
        </div>";
    }
    print($eFelkeres);
}
//-------------
?>