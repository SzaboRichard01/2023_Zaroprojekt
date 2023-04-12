<?php
session_start();
if(!isset($_SESSION['felh_id'])){
    header('Location: ../../belepes.php');
} else{
    require("../kapcsolat.php");
    mysqli_query($dbconn, "DELETE FROM felhasznalok WHERE felhasznalo_id = {$_SESSION['felh_id']}");
    header('Location: ../../index.html');
}
?>