<?php
session_start();
if(!isset($_SESSION['felh_id'])){
    header("Location: ../belepes.php");
    exit();
} else{
    define('eleres', true);
    require("kapcsolat.php");

    require("leker/sajatProfil.php");

    function shorter($text, $chars_limit){
        if (mb_strlen($text) > $chars_limit){
            $new_text = mb_substr($text, 0, $chars_limit);
            $new_text = trim($new_text);
            return $new_text . "...";
        }
        else{
            return $text;
        }
    }

    //Lekérdezendő kliens adatai
    $kliensID = $_GET['kliens'];

    $sqlKaEll = mysqli_query($dbconn, "SELECT kapcs_id FROM edzoklienskapcs WHERE kuldo_az = '{$kliensID}' AND fogado_az = {$_SESSION['felh_id']} AND elfogadva = 1
    OR fogado_az = '{$kliensID}' AND kuldo_az = {$_SESSION['felh_id']} AND elfogadva = 1");
    if(mysqli_num_rows($sqlKaEll) != 0){
        $kliensneve = mysqli_query($dbconn, "SELECT vnev, knev FROM felhasznalok WHERE felhasznalo_id = {$kliensID}");
        $kneve = mysqli_fetch_assoc($kliensneve);
        $kVnev = $kneve['vnev'];
        $kKnev = $kneve['knev'];
        //--------


        $eredmeny = mysqli_query($dbconn, "SELECT terv.terv_id, terv.neve, terv.leiras, terv.kapcs_id, kuldo_az, fogado_az
        FROM terv INNER JOIN edzoklienskapcs ON edzoklienskapcs.kapcs_id = terv.kapcs_id
        WHERE kuldo_az = '{$kliensID}' AND fogado_az = {$_SESSION['felh_id']}
        OR fogado_az = '{$kliensID}' AND kuldo_az = {$_SESSION['felh_id']}");
        if(mysqli_num_rows($eredmeny) != 0){
            $etervKi = "<div class=\"edzestervek\">";
            while($sor = mysqli_fetch_assoc($eredmeny)){
                $etID = $sor['terv_id'];

                $etervKi .= "<a href=\"teljeset.php?edzesterv=". $etID ."\"><div class=\"edzesterv\">
                    <div class=\"etneve\">
                        <p>Edzésterv neve</p>
                        <h3>{$sor['neve']}</h3>
                    </div>
                    <div class=\"etleirasa\">
                        <p>Leírás<br>". shorter(strip_tags($sor['leiras']), 150)."</p>
                    </div>
                    <div class=\"etkitol\">
                        <p>Kliens neve</p>
                        <h3>{$kVnev} {$kKnev}</h3>
                    </div>
                </div></a>";
            }
            $etervKi .= "</div>";
        }
        else{
            $etervKi = "Ennek a kliensnek még nincs edzésterve!";
        }
    }
    else{
        header("Location: hiba.html");
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
    <link rel="stylesheet" href="../css/app.css">
    <title><?php print("{$kVnev} {$kKnev} Edzéstervei")?></title>
</head>
<body>
    <?php
    //Sajnát profil adatai (Navbar részhez)
    require("leker/sajatProfil.php");

    //Felső és oldalsó menü
    require("leker/SidebarNavbar.php");
    ?>
    <main id="edzestervMain">
        <?php
        print("<h2>{$kVnev} {$kKnev} Edzéstervei</h2>");
        print $etervKi;
        ?>
    </main>
</body>
</html>