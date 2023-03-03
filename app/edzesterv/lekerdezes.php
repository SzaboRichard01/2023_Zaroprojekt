<?php
//Edzésterv lekérdezése az adott kliensnek

require("kapcsolat.php");
$kliensID = $_SESSION['felh_id'];

function shorter($text, $chars_limit)
{
    // Check if length is larger than the character limit
    if (strlen($text) > $chars_limit)
    {
        // If so, cut the string at the character limit
        $new_text = substr($text, 0, $chars_limit);
        // Trim off white space
        $new_text = trim($new_text);
        // Add at end of text ...
        return $new_text . "...";
    }
    // If not just return the text as is
    else
    {
    return $text;
    }
}

$eredmeny = mysqli_query($dbconn, "SELECT edzesterv.edzesterv_id, edzesterv.neve, edzesterv.leiras, edzesterv.ekkapcs_id, kuldo_az, fogado_az
        FROM edzesterv INNER JOIN ekkapcs ON ekkapcs.ekkapcs_id = edzesterv.ekkapcs_id
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

    $etID = $sor['edzesterv_id'];

    $edzoneve = mysqli_query($dbconn, "SELECT vnev, knev FROM felhasznalok WHERE felhasznalo_id = {$edzoID}");
    $eneve = mysqli_fetch_assoc($edzoneve);
    $eVnev = $eneve['vnev'];
    $eKnev = $eneve['knev'];

    $etervKi .= "<a href=\"teljeset.php?edzesterv=". $etID ."\"><div class=\"edzesterv\">
        <div class=\"etneve\">
            <p>Edzésterv neve</p>
            <h3>{$sor['neve']}</h3>
        </div>
        <div class=\"etleirasa\">
            <p>Leírás<br>". shorter($sor['leiras'], 150)."</p>
        </div>
        <div class=\"etkitol\">
            <p>Edző neve</p>
            <h3>{$eVnev} {$eKnev}</h3>
        </div>
    </div></a>";
}
$etervKi .= "</div>";
?>