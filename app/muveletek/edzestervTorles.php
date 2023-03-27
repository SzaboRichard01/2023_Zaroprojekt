<?php
session_start();
if(!isset($_GET['edzesterv'])){
    header("Location: ../hiba.html");
} else{
    require("../kapcsolat.php");

    $TervID = $_GET['edzesterv'];

    //hova vezessen majd vissza törlés után
    $sqlKapcsID = mysqli_query($dbconn, "SELECT kapcs_id FROM terv WHERE terv_id = {$TervID}");
    $sorKapcsID = mysqli_fetch_assoc($sqlKapcsID);
    $kapcsID = $sorKapcsID['kapcs_id'];

    $sqlKi = mysqli_query($dbconn, "SELECT kuldo_az, fogado_az FROM edzoklienskapcs WHERE kapcs_id = {$kapcsID}");
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

    $sqlTorles = mysqli_query($dbconn, "DELETE FROM terv WHERE terv_id = {$TervID}");

    header("Location: ../etervM.php?kliens={$kliensAZ}");
}
?>