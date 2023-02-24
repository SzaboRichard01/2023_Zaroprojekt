<?php
require("../kapcsolat.php");
$torlendo = mysqli_real_escape_string($dbconn, $_GET['ef_id']);

//Törlés
$sql = mysqli_query($dbconn, "DELETE FROM `edzo-felhasznalo` WHERE `edzo-felhasznalo_id` = {$torlendo}");
header("Location: ../kezdolap.php");
?>