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
    <link rel="stylesheet" href="../css/app.css">
    <title>Kezdőlap - <?php echo "{$vnev} {$knev}"; ?></title>
</head>
<body>
    <!-- Felső és oldalsó menü -->
    <?php require("leker/SidebarNavbar.php"); ?>
    
    <div class="wrapper">
        <div class="left_side_pannel">
            <div class="prof" onclick="location.href='sProfil.php';">
                <?php
                print "<p>{$vnev} {$knev}</p>
                    <div class=\"pkep\">{$profilkep}</div>";
                ?>
            </div>
            <div class="contact">
                <div class="prof" onclick="location.href='sProfil.php';">
                    <?php
                    print "<p>{$vnev} {$knev}</p>
                        <div class=\"pkep\">{$profilkep}</div>";
                    ?>
                </div>
                <div class="prof" onclick="location.href='sProfil.php';">
                    <?php
                    print "<p>{$vnev} {$knev}</p>
                        <div class=\"pkep\">{$profilkep}</div>";
                    ?>
                </div>
                <div class="prof" onclick="location.href='sProfil.php';">
                    <?php
                    print "<p>{$vnev} {$knev}</p>
                        <div class=\"pkep\">{$profilkep}</div>";
                    ?>
                </div>
            </div>
        </div>
        <div class="right_side_pannel">
            <div class="header">
            <div class="prof" onclick="location.href='sProfil.php';">
                <?php
                print "<p>{$vnev} {$knev}</p>
                    <div class=\"pkep\">{$profilkep}</div>";
                ?>
            </div>
            </div>
            <div class="container">
                <textarea type="text" name="szoveg" id="szoveg" placeholder="Ide írja a szöveget..." style="font-family: 'Nunito', sans-serif; color: var(--feher);"></textarea>
                <button>Küldés</button>
            </div>
        </div>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>