<?php
$felh_id = $_SESSION['felh_id']; //Bejelentkezett profil azonosítója
$pTipus = $_SESSION['p_tipus']; //Bejelentkezett profil típusa (edző/kliens)

//Kereső
$keresett = (isset($_POST['keresett'])) ? $_POST['keresett'] : "";
$MKereso = "<form method=\"post\">
        <input type=\"search\" name=\"keresett\" id=\"keresett\" placeholder=\"Írjon be egy nevet a kereséshez\">
        <input class=\"kereses-gomb\" type=\"submit\" value=\"Keresés\">";

        $keresett != '' ? $MKereso .= ("<button id='kereses-vissza' class='kereses-gomb' onclick='$keresett = ''><i class='fa fa-arrow-left' aria-hidden='true'></i> Vissza</button>") : '';
    $MKereso .= "</form>";
print($MKereso);
//------

$sql = "SELECT kuldo_az, fogado_az, elfogadva
    FROM ekkapcs
    WHERE elfogadva = 1
    ORDER BY felkeres_datuma DESC";
$eredmeny = mysqli_query($dbconn, $sql);
$eFelkeres = "";
while($sor = mysqli_fetch_assoc($eredmeny)){
    $kuldoaz = $sor['kuldo_az'];
    $fogadoaz = $sor['fogado_az'];

    if($felh_id == $kuldoaz){
        $sql2 = "SELECT * FROM ekkapcs
                INNER JOIN felhasznalok ON felhasznalo_id = fogado_az
                WHERE kuldo_az = {$felh_id} AND fogado_az = {$fogadoaz}
                AND CONCAT(vnev, ' ', knev) LIKE '%{$keresett}%'";
        $eredmeny2 = mysqli_query($dbconn, $sql2);
        $sor2 = mysqli_fetch_assoc($eredmeny2);
        
        if($sor2 > 1){
            $teljesnev = "{$sor2['vnev']} {$sor2['knev']}";
            $eFelkeres .= "
            <div class=\"mkliens\">
                <a href=\"profilAdatok.php?felhasznalo_id=" .$sor2['felhasznalo_id']." \" title=\"Profil megtekintése\">
                    <div class=\"felh\">
                        <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$sor2['kep']. "\"></div>
                        <p>{$sor2['vnev']} {$sor2['knev']}</p>\n
                    </div>
                </a>
                <div class=\"gombok\">
                    <button onclick=\"location.href='chat.php?chat={$sor2['felhasznalo_id']}'\">Csevegés</button>
                    <button onclick=\"MeglevoTorles({$sor2['ekkapcs_id']}, '{$teljesnev}')\">Törlés</button>
                </div>
            </div>";
        }
    }
    if($felh_id == $fogadoaz){
        $sql2 = "SELECT * FROM ekkapcs
        INNER JOIN felhasznalok ON felhasznalo_id = kuldo_az
        WHERE fogado_az = {$felh_id} AND kuldo_az = {$kuldoaz}
        AND CONCAT(vnev, ' ', knev) LIKE '%{$keresett}%'";
        $eredmeny2 = mysqli_query($dbconn, $sql2);
        $sor2 = mysqli_fetch_assoc($eredmeny2);
        if($sor2 > 1){
            $teljesnev = "{$sor2['vnev']} {$sor2['knev']}";
            $eFelkeres .= "
            <div class=\"mkliens\">
                <a href=\"profilAdatok.php?felhasznalo_id=" .$sor2['felhasznalo_id']." \" title=\"Profil megtekintése\">
                    <div class=\"felh\">
                        <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$sor2['kep']. "\"></div>
                        <p>{$sor2['vnev']} {$sor2['knev']}</p>\n
                    </div>
                </a>
                <div class=\"gombok\">
                    <button onclick=\"location.href='chat.php?chat={$sor2['felhasznalo_id']}'\">Csevegés</button>
                    <button onclick=\"MeglevoTorles({$sor2['ekkapcs_id']}, '{$teljesnev}')\">Törlés</button>
                </div>
            </div>";
        }
    }
}
print($eFelkeres);
?>