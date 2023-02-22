<?php
    //Kliens profillal edzőt
    require "../kapcsolat.php";
    session_start();

    $valasztott = mysqli_real_escape_string($dbconn, $_GET['felhasznalo_id']);
    $felh_id = $_SESSION['felh_id'];

    $datum = date('Y-m-d h:i:s');

    $sql = mysqli_query($dbconn, "INSERT INTO `edzo-felhasznalo` (edzo_az, kliens_az, felkeres_datuma) VALUES ('{$felh_id}', '{$valasztott}', '{$datum}')");
    header("Location: ../kliens.php");
?>