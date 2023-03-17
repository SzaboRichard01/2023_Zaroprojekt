<?php
require("kapcsolat.php");
$torlendo = mysqli_real_escape_string($dbconn, $_GET['eftorlendo']);

//Törlés
mysqli_query($dbconn, "DELETE FROM edzoklienskapcs WHERE kapcs_id = {$torlendo}");
?>