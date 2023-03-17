<?php
//Edző felkéréseknél az elfogadás gomb hatására az elfogadva értéket true-ra állítjuk
require("../kapcsolat.php");
session_start();
$felh_id = $_SESSION['felh_id'];
$datum = date('Y-m-d h:i:s');

$sql = mysqli_query($dbconn, "UPDATE edzoklienskapcs SET elfogadva = 1, kapcs_kezdete = '{$datum}' WHERE kuldo_az = {$_GET['kuldo_az']} AND fogado_az = {$felh_id}");
if($_SESSION['p_tipus'] == "edző"){
    header("Location: ../kliens.php");
}
else{
    header("Location: ../edzo.php");
}
?>