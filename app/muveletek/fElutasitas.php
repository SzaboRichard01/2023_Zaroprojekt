<?php
//Edző felkéréseknél az elutasítás gomb megnyomására töröljük a felkérést az adatbázisból
require("../kapcsolat.php");
session_start();
$felh_id = $_SESSION['felh_id'];
$sql = mysqli_query($dbconn, "DELETE FROM `edzo-felhasznalo` WHERE edzo_az ={$_GET['edzo_az']} AND kliens_az = {$felh_id}");
header("Location: ../kezdolap.php");
?>