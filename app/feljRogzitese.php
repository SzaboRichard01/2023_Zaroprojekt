<?php
session_start();
if(!isset($_SESSION['felh_id'])){
    header("Location: ../belepes.php");
    exit();
} else{
    require("kapcsolat.php");
    define('eleres', true);
    //Saját profil adatainak lekérése
    require("leker/sajatProfil.php");

    if(isset($_POST['rogzites'])){
        if(empty($_POST['datum'])){
            $hibak[] = "<p>Nem választott ki dátumot!</p>";
        }
        if(empty($_POST['jegy'])){
            $hibak[] = "A jegyzet üres!";
        }

        if(isset($hibak)){
            $hibakKi = "<ul>";
            foreach($hibak as $hiba){
                $hibakKi .= "<li>{$hiba}</li>";
            }
            $hibakKi .= "</ul>";
        } else{
            $datum = $_POST['datum'];
            $leiras = $_POST['jegy'];

            $sql = mysqli_query($dbconn, "INSERT INTO feljegyzesek (felhasznalo_id, datum, leiras) VALUES ('{$_SESSION['felh_id']}', '{$datum}', '{$leiras}')");
            $_SESSION['tevrogz'] = "<p>Sikeres rögzítés!</p>";
            header("Location: kezdolap.php");
        }
    }
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

    <link rel="stylesheet" href="redactor/redactor.css">

    <script src="../js/jquery-1.9.0.min.js"></script>
    <script src="redactor/redactor.min.js"></script>
    <script>
        $(document).ready(
            function() {
                $('textarea#jegy').redactor({
                    minHeight: 300
                });
            }
        );
    </script>
    <title>Feljegyzés Rögzítése</title>
</head>
<body>
    <!-- Felső és oldalsó menü -->
    <?php require("leker/SidebarNavbar.php"); ?>
    <main>
        <h2>Feljegyzés rögzítése</h2>
        <button onclick="location.href='kezdolap.php'" id="tevRogzVissza"><i class="fa fa-arrow-left" aria-hidden="true"></i> Vissza</button>
        <form method="post">
            <div class="hibauzenet">
                <?php
                    if(isset($hibakKi)){
                        print($hibakKi);
                    }
                ?>
            </div>
            <div class="mezo">
                <label for="datum">Dátum (Melyik nap):</label>
                <input type="date" name="datum" id="datum">
            </div>
            <div class="mezo">
                <label for="jegy">Jegyzet:</label>
                <textarea name="jegy" id="jegy"></textarea>
            </div>
            <input type="submit" value="Rögzítés" name="rogzites" id="rogzites">
        </form>
    </main>
</body>
</html>