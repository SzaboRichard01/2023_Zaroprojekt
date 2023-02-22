<?php
require("../kapcsolat.php");
session_start();
$felh_id = $_SESSION['felh_id'];
$sql = mysqli_query($dbconn, "UPDATE `edzo-felhasznalo` SET elfogadva = 1 WHERE edzo_az = {$_GET['edzo_az']} AND kliens_az = {$felh_id}");
header("Location: ../kezdolap.php");
?>