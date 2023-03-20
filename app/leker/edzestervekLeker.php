<?php
//Edzésterv lekérdezése az adott kliensnek

require("kapcsolat.php");
$kliensID = $_SESSION['felh_id'];

function shorter($text, $chars_limit){
    if (mb_strlen($text) > $chars_limit){
        $new_text = mb_substr($text, 0, $chars_limit);
        $new_text = trim($new_text);
        return $new_text . "...";
    }
    else{
        return $text;
    }
}

$eredmeny = mysqli_query($dbconn, "SELECT terv.terv_id, terv.neve, terv.leiras, terv.kapcs_id, kuldo_az, fogado_az
        FROM terv INNER JOIN edzoklienskapcs ON edzoklienskapcs.kapcs_id = terv.kapcs_id
        WHERE kuldo_az = '{$kliensID}'
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

    $etID = $sor['terv_id'];

    $edzoneve = mysqli_query($dbconn, "SELECT vnev, knev FROM felhasznalok WHERE felhasznalo_id = {$edzoID}");
    $eneve = mysqli_fetch_assoc($edzoneve);
    $eVnev = $eneve['vnev'];
    $eKnev = $eneve['knev'];

    $etervKi .= "<a href=\"teljeset.php?edzesterv={$etID}\">
    <div class=\"edzesterv\">
        <div class=\"etneve\">
            <p>Edzésterv neve</p>
            <h3>{$sor['neve']}</h3>
        </div>
        <div class=\"etleirasa\">
            <p>Leírás<br>". shorter(strip_tags($sor['leiras']), 150)."</p>
        </div>
        <div class=\"etkitol\">
            <p>Edző neve</p>
            <h3>{$eVnev} {$eKnev}</h3>
        </div>
    </div>
    </a>";
}
$etervKi .= "</div>";
?>