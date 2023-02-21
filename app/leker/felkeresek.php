<?php
$felh_id = $_SESSION['felh_id'];
$pTipus = $_SESSION['p_tipus'];

$sql = "SELECT edzo_az, kliens_az, felkeres_datuma
        FROM `edzo-felhasznalo`
        INNER JOIN felhasznalok ON felhasznalo_id = 
        WHERE kliens_az = {$felh_id}";
$eredmeny = mysqli_query($dbconn, $sql);
$sor = mysqli_fetch_assoc($eredmeny);

$felkeres = "";
print("{$sor['edzo_az']}");

?>