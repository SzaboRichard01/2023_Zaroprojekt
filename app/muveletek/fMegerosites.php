<?php
//Edző felkéréseknél az elfogadás gomb hatására az elfogadva értéket true-ra állítjuk
require("../kapcsolat.php");
session_start();
$felh_id = $_SESSION['felh_id'];
$datum = date('Y-m-d h:i:s');

$sql = mysqli_query($dbconn, "UPDATE `edzo-felhasznalo` SET elfogadva = 1, kapcs_kezdete = '{$datum}' WHERE kuldo_az = {$_GET['kuldo_az']} AND fogado_az = {$felh_id}");
header("Location: ../kezdolap.php");
?>