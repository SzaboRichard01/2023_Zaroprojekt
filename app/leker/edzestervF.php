<?php
if($_SESSION['p_tipus'] == "edző"){
    $felulet = "
    <h1>Kliensek Edzéstervei</h1>
    <div class=\"sKliensekL\">";

        $sql = "SELECT kuldo_az, fogado_az, elfogadva FROM ekkapcs
                WHERE elfogadva = 1 AND kuldo_az = {$_SESSION['felh_id']} OR fogado_az = {$_SESSION['felh_id']}";
        $eredmeny = mysqli_query($dbconn, $sql);
        while($sor = mysqli_fetch_assoc($eredmeny)){
            $kuldoaz = $sor['kuldo_az'];
            $fogadoaz = $sor['fogado_az'];

            if($kuldoaz == $_SESSION['felh_id']){
                $sql2 = "SELECT * FROM ekkapcs
                    INNER JOIN felhasznalok ON felhasznalo_id = fogado_az
                    WHERE kuldo_az = {$_SESSION['felh_id']} AND fogado_az = {$fogadoaz}";
                
                $kerdezendo = "fogado_az";
            }
            else if($_SESSION['felh_id'] == $fogadoaz){
                $sql2 = "SELECT * FROM ekkapcs
                INNER JOIN felhasznalok ON felhasznalo_id = kuldo_az
                WHERE fogado_az = {$_SESSION['felh_id']} AND kuldo_az = {$kuldoaz}";

                $kerdezendo = "kuldo_az";
            }

            if(isset($sql2)){
                $eredmeny2 = mysqli_query($dbconn, $sql2);
                $sor2 = mysqli_fetch_assoc($eredmeny2);

                $kliens = "
                <div class =\"kliens\">
                    <a href=\"profilAdatok.php?felhasznalo_id=" .$sor2['felhasznalo_id']. "\">
                        <div class=\"felh\">
                            <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$sor2['kep']. "\"></div>
                            <p>{$sor2['vnev']} {$sor2['knev']}</p>\n
                        </div>
                    </a>
                        <div class=\"gombok\">
                            <button onclick=\"location.href='edzesterv-felvitel.php?felvitel=". $sor2[$kerdezendo] ."'\">Új Edzésterv Felvétele</button>
                            <button>Edzéstervek</button>
                        </div>
                </div>";
                $felulet .= $kliens;
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