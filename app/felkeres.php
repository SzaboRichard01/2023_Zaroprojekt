<?php
    require "kapcsolat.php";
    session_start();

    $valasztott = mysqli_real_escape_string($dbconn, $_GET['felhasznalo_id']);
    $felh_id = $felh_id = $_SESSION['felh_id'];

    $sql = mysqli_query($dbconn, "INSERT INTO `edzo-felhasznalo` (edzo_az, kliens_az) VALUES ('{$felh_id}', '{$valasztott}')");
    //header("Location: kliens.php");
?>