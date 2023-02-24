<?php


if($_SESSION['p_tipus'] == "edző"){
    $felulet = "
    <h1>Kliensek Edzéstervei</h1>
    <div>";

        $sql = "SELECT kuldo_az, fogado_az, elfogadva FROM `edzo-felhasznalo`
                WHERE kuldo_az = {$_SESSION['felh_id']} OR fogado_az = {$_SESSION['felh_id']}";
        $eredmeny = mysqli_query($dbconn, $sql);
        while($sor = mysqli_fetch_assoc($eredmeny)){
            $kuldoaz = $sor['kuldo_az'];
            $fogadoaz = $sor['fogado_az'];
            $elfogadva = $sor['elfogadva'];

            if($_SESSION['felh_id'] == $kuldoaz && $elfogadva == 1){
                $sql2 = "SELECT * FROM `edzo-felhasznalo`
                    INNER JOIN felhasznalok ON felhasznalo_id = fogado_az
                    WHERE kuldo_az = {$_SESSION['felh_id']} AND fogado_az = {$fogadoaz}";
                $eredmeny2 = mysqli_query($dbconn, $sql2);
                $sor2 = mysqli_fetch_assoc($eredmeny2);

                $kliens = "
                <div class =\"kliens\">
                    <div class=\"felh\">
                        <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$sor2['kep']. "\"></div>
                        <p>{$sor2['vnev']} {$sor2['knev']}</p>
                    </div>
                    <div class=\"gombok\">
                        <button onclick=\"location.href='edzesterv-felvitel.php?felvitel=". $sor2['fogado_az'] ."'\">Edzésterv felvétele</button>
                    </div>
                </div>";
                $felulet .= $kliens;
            }
            else if($_SESSION['felh_id'] == $fogadoaz && $elfogadva == 1){
                $sql2 = "SELECT * FROM `edzo-felhasznalo`
                INNER JOIN felhasznalok ON felhasznalo_id = kuldo_az
                WHERE fogado_az = {$_SESSION['felh_id']} AND kuldo_az = {$kuldoaz}";
                $eredmeny2 = mysqli_query($dbconn, $sql2);
                $sor2 = mysqli_fetch_assoc($eredmeny2);

                $kliens = "
                <div class =\"kliens\">
                    <div class=\"felh\">
                        <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$sor2['kep']. "\"></div>
                        <p>{$sor2['vnev']} {$sor2['knev']}</p>\n
                    </div>
                    <div class=\"gombok\">
                        <button onclick=\"location.href='edzesterv-felvitel.php?felvitel=". $sor2['kuldo_az'] ."'\">Edzésterv felvétele</button>
                    </div>
                </div>";
                $felulet .= $kliens;
            }

        }

    $felulet .= "</div>";
}
if($_SESSION['p_tipus'] == "kliens"){
    $felulet = "<h1>{$vnev} {$knev} edzésterve/étrendje</h1>
    <div class=\"container\">
        <ul>
            <li class=\"edzesterv\"><b>Ide jön az edzésterv és az étrend</b></li>
        </ul>
    </div>
    <button onclick=\"location.href='edzesterv-felvitel.php';\">Új edzésterv felvitele</button>";
}
print($felulet);
?>