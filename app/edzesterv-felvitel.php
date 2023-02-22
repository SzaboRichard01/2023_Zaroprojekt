<?php
session_start();
if (!isset($_SESSION['felh_id'])) {
    header("Location: ../belepes.php");
    exit();
} else {
    //Saját profil adatainak lekérése
    require("leker/sajatProfil.php");
}
?><!DOCTYPE html>
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/reg.css">
    <link rel="stylesheet" href="../css/app.css">
    <title>Edzésterv felvitele</title>
</head>
<body>
    <!-- Felső és oldalsó menü -->
    <?php require("leker/SidebarNavbar.php"); ?>

    <main>
        <h1>Edzésterv felvitele</h1>
        <div class="sikeres">
            <?php
                if(isset($sikeres)){
                    print $sikeres;
                }
            ?>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="mezo">
                <label for="edzestipus">Edzéstípus</label>
                <select name="tipus" id="tipus">
                    <option disabled selected>Válasszon egy edzéstípust!</option>
                    <option value="kardio">Kardió</option>
                    <option value="sulyos">Súlyos edzés</option>
                    <option value="crossfit">Crossfit</option>
                </select>
            </div>
            <div class="mezo">
                <label for="edz_terv">Edzésterv</label>
                <textarea class="edzesterv" name="edzesterv" rows="20" cols="132"></textarea>
            </div>
            <div class="mezo">
                <label for="nap">Nap</label>
                <select name="nap" id="nap">
                    <option disabled selected>Válasszon ki egy napot!</option>
                    <option value="h">Hétfő</option>
                    <option value="k">Kedd</option>
                    <option value="sze">Szerda</option>
                    <option value="csu">Csütörtök</option>
                    <option value="pe">Péntek</option>
                    <option value="szo">Szombat</option>
                    <option value="va">Vasárnap</option>
                </select>
            </div>
            <h1 style="margin-top: 5px; margin-bottom: 5px;">Étrendösszeállítás</h1>
            <div class="mezo">
                <label for="edz_terv">Étrend</label>
                <textarea class="etrend" name="edzesterv" rows="20" cols="132"></textarea>
            </div>
            <div class="mezo">
                <label for="nap">Nap</label>
                <select name="nap" id="nap">
                    <option disabled selected>Válasszon ki egy napot!</option>
                    <option value="h">Hétfő</option>
                    <option value="k">Kedd</option>
                    <option value="sze">Szerda</option>
                    <option value="csu">Csütörtök</option>
                    <option value="pe">Péntek</option>
                    <option value="szo">Szombat</option>
                    <option value="va">Vasárnap</option>
                </select>
            </div>
            <input type="submit" name="kuldes" id="kuldes" value="Küldés">
        </form>
    </main>

    <script src="../js/script.js"></script>
</body>
</html>