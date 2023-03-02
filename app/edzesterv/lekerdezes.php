<?php
//Edzésterv lekérdezése az adott kliensnek

require("kapcsolat.php");
$kliensID = $_SESSION['felh_id'];

$eredmeny = mysqli_query($dbconn, "SELECT edzesterv.neve, edzesterv.leiras, edzesterv.ekkapcs_id, kuldo_az, fogado_az FROM edzesterv INNER JOIN ekkapcs ON ekkapcs.ekkapcs_id = edzesterv.ekkapcs_id WHERE
        kuldo_az = '{$kliensID}'
        OR fogado_az = '{$kliensID}'");

$etervKi = "<div class=\"edzestervek\">";
while($sor = mysqli_fetch_assoc($eredmeny)){
    $kuldoAz = $sor['kuldo_az'];
    $fogadoAz = $sor['fogado_az'];
    if($kuldoAz == $kliensID){
        $edzoID = $fogadoAz;
    }
    else{
        $edzoID = $kuldoAz;
    }

    $edzoneve = mysqli_query($dbconn, "SELECT vnev, knev FROM felhasznalok WHERE felhasznalo_id = {$edzoID}");
    $eneve = mysqli_fetch_assoc($edzoneve);
    $eVnev = $eneve['vnev'];
    $eKnev = $eneve['knev'];

    $etervKi .= "<div class=\"edzesterv\">
        <div class=\"etneve\">
            <p>Edzésterv neve</p>
            <h3>{$sor['neve']}</h3>
        </div>
        <div class=\"etleirasa\">
            <p>Leírás<br>{$sor['leiras']}</p>
        </div>
        <div class=\"etkitol\">
            <p>Edző neve</p>
            <h3>{$eVnev} {$eKnev}</h3>
        </div>
    </div>";
}
$etervKi .= "</div>";
?>