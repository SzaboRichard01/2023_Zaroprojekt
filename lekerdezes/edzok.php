<?php
//teljes edző lista kiíratására
    session_start();
    include_once "../kapcsolat.php";

    $kifejezes = (isset($_POST['kifejezes'])) ? $_POST['kifejezes'] : "";

    $felh_id = $_SESSION['felh_id'];
    $sql = mysqli_query($dbconn, "SELECT * FROM felhasznalok WHERE NOT felhasznalo_id = {$felh_id} AND CONCAT(vnev, ' ', knev) LIKE '%{$kifejezes}%'");

    $kimenet = "";
    while($sor = mysqli_fetch_assoc($sql)){
        $kimenet .= "<a href=\"edzoadatok.php?felhasznalo_id=" .$sor['felhasznalo_id']." \">
    <div class=\"edzo\">
    <div class=\"pkep\"><img src=\"pics/profile/" .$sor['kep']. "\"></div>
    <p>{$sor['vnev']} {$sor['knev']}</p>\n
    </div>";
    }
    

    echo $kimenet;
?>