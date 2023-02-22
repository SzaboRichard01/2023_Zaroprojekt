<?php
session_start();
if (!isset($_SESSION['felh_id'])) {
    header("Location: belepes.php");
    exit();
} else {
    //Saját profil adatainak lekérése
    require("leker/sajatProfil.php");
}

?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/edzesterv.css">
    <title>Kezdőlap - <?php echo "{$vnev} {$knev}"; ?></title>
</head>

<body>
    <!-- Felső és oldalsó menü -->
    <?php require("leker/SidebarNavbar.php"); ?>

    <main>
        <h1><?php echo "{$vnev} {$knev}"; ?> edzésterve</h1>
    </main>
    <div class="container">
        <ul>
            <li class="edzesterv"><b>Ide jön az edzésterv</b></li>
        </ul>
    </div>
    <button onclick="location.href='edzesterv-felvitel.php';">Új edzésterv felvitele</button>

    <script src="../js/script.js"></script>
</body>

</html>