<?php

if (!isset($_SESSION['felh_id'])) {
    header("Location: ../belepes.php");
    exit();
} else {
    require("kapcsolat.php");
    if (isset($_GET['chat'])) {
        $fogadoAz = $_GET['chat'];
        $sqlKim = mysqli_query($dbconn, "SELECT kimeno_id, bejovo_id, uzenet FROM uzenet WHERE kimeno_id = {$_SESSION['felh_id']} AND bejovo_id = {$fogadoAz}");
while($sorKim = mysqli_fetch_assoc($sqlKim)){
    $kimenoUz = "<div class=\"kimenoUz\">
        <p>{$sorKim['uzenet']}</p>
    </div>";
}
//Kimeno vége

//Bejövő

$sqlBej = mysqli_query($dbconn, "SELECT kimeno_id, bejovo_id, uzenet FROM uzenet WHERE bejovo_id = {$_SESSION['felh_id']} AND kimeno_id = {$fogadoAz}");
while ($sorBej = mysqli_fetch_assoc($sqlBej)) {
    $bejovoUz = "<div class=\"bejovoUz\">
                <p>{$sorBej['uzenet']}</p>
            </div>";
}
    }
}

?>