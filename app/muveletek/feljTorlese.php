<?php
if(!isset($_GET['tevaz'])){
    header("Location: ../hiba.html");
} else{
    require("../kapcsolat.php");
    $torlendo = mysqli_real_escape_string($dbconn, $_GET['tevaz']);
    $sql = mysqli_query($dbconn, "DELETE FROM feljegyzesek WHERE felj_id = {$torlendo}");
    header("Location: ../kezdolap.php");
}
?>