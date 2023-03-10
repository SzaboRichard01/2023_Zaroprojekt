<?php
if($_SESSION['p_tipus'] == "edző"){

    $kifejezes = (isset($_POST['kifejezes'])) ? $_POST['kifejezes'] : "";

    $felulet = "
    <h1>Kliensek Edzéstervei</h1>
    <div class=\"sKliensekL scrollbar\">
    <form method=\"post\">
        <input type=\"search\" name=\"kifejezes\" id=\"kifejezes\" placeholder=\"Írjon be egy nevet a kereséshez\">
        <input class=\"kereses-gomb\" type=\"submit\" value=\"Keresés\">";

            $kifejezes != "" ? $felulet .= "<button id=\"kereses-vissza\" class=\"kereses-gomb\" onclick=\"$kifejezes = ''\"><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Vissza</button>" : "";
            $kifejezes != "" ? $felulet .= "<p>Találatok <span>\"{$kifejezes}\"</span> kifejezésre:</p>" : '';

    $felulet .= "</form>
    ";

        $sql = "SELECT kuldo_az, fogado_az, elfogadva FROM ekkapcs
                WHERE elfogadva = 1 AND kuldo_az = {$_SESSION['felh_id']} OR fogado_az = {$_SESSION['felh_id']}";
        $eredmeny = mysqli_query($dbconn, $sql);
        while($sor = mysqli_fetch_assoc($eredmeny)){
            $kuldoaz = $sor['kuldo_az'];
            $fogadoaz = $sor['fogado_az'];

            if($kuldoaz == $_SESSION['felh_id']){
                $sql2 = "SELECT * FROM ekkapcs
                    INNER JOIN felhasznalok ON felhasznalo_id = fogado_az
                    WHERE CONCAT(vnev, ' ', knev) LIKE '%{$kifejezes}%'
                    AND kuldo_az = {$_SESSION['felh_id']} AND fogado_az = {$fogadoaz} AND elfogadva = 1";
                
                $kerdezendo = "fogado_az";
            }
            else if($_SESSION['felh_id'] == $fogadoaz){
                $sql2 = "SELECT * FROM ekkapcs
                INNER JOIN felhasznalok ON felhasznalo_id = kuldo_az
                WHERE CONCAT(vnev, ' ', knev) LIKE '%{$kifejezes}%'
                AND fogado_az = {$_SESSION['felh_id']} AND kuldo_az = {$kuldoaz} AND elfogadva = 1";

                $kerdezendo = "kuldo_az";
            }

            if(isset($sql2)){
                $eredmeny2 = mysqli_query($dbconn, $sql2);
                $sor2 = mysqli_fetch_assoc($eredmeny2);
                if($sor2 != 0){
                    $kliens = "
                    <div class =\"kliens\">
                        <a href=\"profilAdatok.php?felhasznalo_id=" .$sor2['felhasznalo_id']. "\" title=\"Profil megtekintése\">
                            <div class=\"felh\">
                                <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$sor2['kep']. "\"></div>
                                <p>{$sor2['vnev']} {$sor2['knev']}</p>\n
                            </div>
                        </a>
                            <div class=\"gombok\">
                                <button onclick=\"location.href='edzesterv-felvitel.php?felvitel=". $sor2[$kerdezendo] ."'\">Új Edzésterv Felvétele</button>
                                <button onclick=\"location.href='etervM.php?kliens=". $sor2[$kerdezendo] ."'\">Edzéstervek</button>
                            </div>
                    </div>";
                    $felulet .= $kliens;
                }
            }
        }

    $felulet .= "</div>";
}
if($_SESSION['p_tipus'] == "kliens"){
    $felulet = "<h1>{$vnev} {$knev} Edzéstervei</h1>";

    require("edzesterv/lekerdezes.php");
    $felulet .= $etervKi;
}
print($felulet);
?>