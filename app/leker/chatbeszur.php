<?php

session_start();
if (!isset($_SESSION['felh_id'])) {
    header("Location: ../belepes.php");
    exit();
} else {
    require("kapcsolat.php");
    if (isset($_GET['chat'])) {
        $fogadoAz = $_GET['chat'];
        if(isset($_POST['ChatUzenet'])){
            $mikor = date("Y-m-d H:i:s");
            $uzenet = $_POST['szoveg'];
            $sqlBeszur = mysqli_query($dbconn, "INSERT INTO uzenet (kimeno_id, bejovo_id, mikor, uzenet) VALUES ('{$_SESSION['felh_id']}', '{$fogadoAz}', '{$mikor}', '{$uzenet}')");
        }
    }
}

?>