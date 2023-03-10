<?php
session_start();
require("../kapcsolat.php");

$TervID = $_GET['edzesterv'];

//hova vezessen majd vissza
$sqlKapcsID = mysqli_query($dbconn, "SELECT ekkapcs_id FROM edzesterv WHERE edzesterv_id = {$TervID}");
$sorKapcsID = mysqli_fetch_assoc($sqlKapcsID);
$kapcsID = $sorKapcsID['ekkapcs_id'];

$sqlKi = mysqli_query($dbconn, "SELECT kuldo_az, fogado_az FROM ekkapcs WHERE ekkapcs_id = {$kapcsID}");
$sorKi = mysqli_fetch_assoc($sqlKi);
$kuldoID = $sorKi['kuldo_az'];
$fogadoID = $sorKi['fogado_az'];

if($kuldoID == $_SESSION['felh_id']){
    $kliensAZ = $fogadoID;
}
else{
    $kliensAZ = $kuldoID;
}
//----

$sqlTorles = mysqli_query($dbconn, "DELETE FROM edzesterv WHERE edzesterv_id = {$TervID}");

header("Location: ../etervM.php?kliens={$kliensAZ}");
?>