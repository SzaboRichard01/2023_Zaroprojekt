<?php
require("../kapcsolat.php");
$modID = mysqli_real_escape_string($dbconn, $_GET['tevid']);

$sql = mysqli_query($dbconn, "SELECT datum, leiras FROM tevekenysegek WHERE tev_id = {$modID}");
$sor = mysqli_fetch_assoc($sql);
$kDatum = $sor['datum'];
$kLeiras = $sor['leiras'];

if(isset($_POST['modosit'])){
    $pdatum = $_POST['dat'];
    $pleiras = $_POST['leir'];

    $sqlUpdate = mysqli_query($dbconn, "UPDATE tevekenysegek SET datum = '{$pdatum}', leiras = '{$pleiras}' WHERE tev_id = {$modID}");
    header("Location: ../kezdolap.php");
}

?><!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../../pics/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../css/reg.css">
    <link rel="stylesheet" href="../../css/app.css">
    <title>Tevékenység módosítása</title>
</head>
<body>
    <main>
        <h2>Tevékenység módosítása</h2>
        <button onclick="location.href='../kezdolap.php'"><i class="fa fa-arrow-left" aria-hidden="true"></i> Vissza</button>
        <form method="post">
            <div class="mezo">
                <label for="dat">Dátum:</label>
                <input type="date" name="dat" id="dat" <?php print("value={$kDatum}"); ?>>
            </div>
            <div class="mezo">
                <label for="leir">Leírás:</label>
                <textarea name="leir" id="leir"><?php print $kLeiras; ?></textarea>
            </div>
            <input type="submit" value="Mentés" name="modosit" id="modosit">
        </form>
    </main>
</body>
</html>