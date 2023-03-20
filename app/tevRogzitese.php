<?php
session_start();
require("kapcsolat.php");

//Saját profil adatainak lekérése
require("leker/sajatProfil.php");

if(isset($_POST['rogzites'])){
    $datum = $_POST['datum'];
    $leiras = $_POST['tev'];

    $sql = mysqli_query($dbconn, "INSERT INTO tevekenysegek (felhasznalo_id, datum, leiras) VALUES ('{$_SESSION['felh_id']}', '{$datum}', '{$leiras}')");

    $_SESSION['tevrogz'] = "<p>Sikeres rögzítés!</p>";
    header("Location: kezdolap.php");
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
    <link rel="shortcut icon" href="../pics/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/reg.css">
    <link rel="stylesheet" href="../css/app.css">
    <title>Tevékenység Rögzítése</title>
</head>
<body>
    <!-- Felső és oldalsó menü -->
    <?php require("leker/SidebarNavbar.php"); ?>

    <main>
        <button onclick="location.href='kezdolap.php'" id="tevRogzVissza"><i class="fa fa-arrow-left" aria-hidden="true"></i> Vissza</button>
        <form method="post">
            <div class="mezo">
                <label for="datum">Dátum (Melyik nap):</label>
                <input type="date" name="datum" id="datum">
            </div>
            <div class="mezo">
                <label for="tev">Tevékenység leírása:</label>
                <textarea name="tev" id="tev"></textarea>
            </div>
            <input type="submit" value="Rögzítés" name="rogzites" id="rogzites">
        </form>
    </main>
</body>
</html>