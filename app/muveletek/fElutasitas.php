<?php
//Edző felkéréseknél az elutasítás gomb megnyomására töröljük a felkérést az adatbázisból
require("../kapcsolat.php");
session_start();
$felh_id = $_SESSION['felh_id'];
$sql = mysqli_query($dbconn, "DELETE FROM edzoklienskapcs WHERE kuldo_az = {$_GET['kuldo_az']} AND fogado_az = {$felh_id}");

if($_SESSION['p_tipus'] == "edző"){
    header("Location: ../kliens.php");
}
else{
    header("Location: ../edzo.php");
}
?>