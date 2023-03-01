<?php
//Edzésterv lekérdezése az adott kliensnek

session_start();
require("../kapcsolat.php");
$kliensID = $_SESSION['felh_id'];

$eredmeny = mysqli_query($dbconn, "SELECT neve, leiras, edzesterv.ekkapcs_id FROM edzesterv INNER JOIN ekkapcs ON ekkapcs.ekkapcs_id = edzesterv.ekkapcs_id WHERE
        kuldo_az = '{$kliensID}'
        OR fogado_az = '{$kliensID}'");

$etervKi = "<div class=\"edzestervek\">";
while($sor = mysqli_fetch_assoc($eredmeny)){
    $etervKi .= "<div class=\"edzesterv\">
        <table>
            <tr>
                <th>Edzésterv neve:</th>
                <td>{$sor['neve']}</td>
            </tr>
            <tr>
                <th>Leírás:</th>
                <td>{$sor['leiras']}</td>
            </tr>
        </table>
    </div>";
}
$etervKi .= "</div>";

echo $etervKi;
?>