<?php
session_start();
if (!isset($_SESSION['felh_id'])) {
    header("Location: belepes.php");
    exit();
} else {
    define('eleres', true);
    require("kapcsolat.php");
    
    //Saját profil adatainak lekérése
    require("leker/sajatProfil.php");


    //Edző típusú profil esetén
    if($_SESSION['p_tipus'] == "edző"){

        $kifejezes = (isset($_POST['kifejezes'])) ? $_POST['kifejezes'] : "";
    
        $felulet = "
        <h1>Kliensek Edzéstervei</h1>
        <div class=\"sKliensekL scrollbar\">
        <form method=\"post\">
            <input type=\"search\" name=\"kifejezes\" id=\"kifejezes\" placeholder=\"Írjon be egy nevet a kereséshez\">
            <input class=\"kereses-gomb\" type=\"submit\" value=\"Keresés\">";
    
                $kifejezes != "" ? $felulet .= "<button id=\"kereses-vissza\" class=\"kereses-gomb\" onclick=\"$kifejezes = ''\"><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Vissza</button>" : "";
                $kifejezes != "" ? $felulet .= "<p>Találatok <span>\"{$kifejezes}\"</span> kifejezésre:</p>" : '';
    
        $felulet .= "</form>";
    
            $sql = "SELECT kuldo_az, fogado_az, elfogadva FROM edzoklienskapcs
                    WHERE elfogadva = 1 AND kuldo_az = {$_SESSION['felh_id']} OR fogado_az = {$_SESSION['felh_id']}";
            $eredmeny = mysqli_query($dbconn, $sql);
            if(mysqli_num_rows($eredmeny) != 0){
                while($sor = mysqli_fetch_assoc($eredmeny)){
                    $kuldoaz = $sor['kuldo_az'];
                    $fogadoaz = $sor['fogado_az'];
        
                    if($kuldoaz == $_SESSION['felh_id']){
                        $sql2 = "SELECT felhasznalo_id, vnev, knev, kep, fogado_az FROM edzoklienskapcs
                            INNER JOIN felhasznalok ON felhasznalo_id = fogado_az
                            WHERE CONCAT(vnev, ' ', knev) LIKE '%{$kifejezes}%'
                            AND kuldo_az = {$_SESSION['felh_id']} AND fogado_az = {$fogadoaz} AND elfogadva = 1";
                        
                        $kerdezendo = "fogado_az";
                    }
                    else if($_SESSION['felh_id'] == $fogadoaz){
                        $sql2 = "SELECT felhasznalo_id, vnev, knev, kep, kuldo_az FROM edzoklienskapcs
                        INNER JOIN felhasznalok ON felhasznalo_id = kuldo_az
                        WHERE CONCAT(vnev, ' ', knev) LIKE '%{$kifejezes}%'
                        AND fogado_az = {$_SESSION['felh_id']} AND kuldo_az = {$kuldoaz} AND elfogadva = 1";
        
                        $kerdezendo = "kuldo_az";
                    }
        
                    if(isset($sql2)){
                        $eredmeny2 = mysqli_query($dbconn, $sql2);
                        $sor2 = mysqli_fetch_assoc($eredmeny2);
                        if($sor2 != 0){
                            $kliens = "
                            <div class =\"kliens\">
                                <a href=\"profilAdatok.php?felhasznalo_id=" .$sor2['felhasznalo_id']. "\" title=\"Profil megtekintése\">
                                    <div class=\"felh\">
                                        <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$sor2['kep']. "\"></div>
                                        <p>{$sor2['vnev']} {$sor2['knev']}</p>\n
                                    </div>
                                </a>
                                    <div class=\"gombok\">
                                        <button onclick=\"location.href='edzesterv-felvitel.php?felvitel=". $sor2[$kerdezendo] ."'\">Új Edzésterv Felvétele</button>
                                        <button onclick=\"location.href='etervM.php?kliens=". $sor2[$kerdezendo] ."'\">Edzéstervek</button>
                                    </div>
                            </div>";
                            $felulet .= $kliens;
                        }
                    }
                }
            } else{
                $felulet .= "<p class=\"nincsKl\">Önnek még nincs egy kliense sem!</p>";
            }
            
        $felulet .= "</div>";
    }
    else{
        //Kliens típusú profil esetén
        $felulet = "<h1>{$vnev} {$knev} Edzéstervei</h1>";
    
        $kliensID = $_SESSION['felh_id'];
        
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
        
        $eredmeny = mysqli_query($dbconn, "SELECT terv.terv_id, terv.neve, terv.leiras, terv.kapcs_id, kuldo_az, fogado_az
                FROM terv INNER JOIN edzoklienskapcs ON edzoklienskapcs.kapcs_id = terv.kapcs_id
                WHERE kuldo_az = '{$kliensID}'
                OR fogado_az = '{$kliensID}'");
        
        $etervKi = "<div class=\"edzestervek\">";
        if(mysqli_num_rows($eredmeny) != 0){
            while($sor = mysqli_fetch_assoc($eredmeny)){
                $kuldoAz = $sor['kuldo_az'];
                $fogadoAz = $sor['fogado_az'];
                if($kuldoAz == $kliensID){
                    $edzoID = $fogadoAz;
                }
                else{
                    $edzoID = $kuldoAz;
                }
            
                $etID = $sor['terv_id'];
            
                $edzoneve = mysqli_query($dbconn, "SELECT vnev, knev FROM felhasznalok WHERE felhasznalo_id = {$edzoID}");
                $eneve = mysqli_fetch_assoc($edzoneve);
                $eVnev = $eneve['vnev'];
                $eKnev = $eneve['knev'];
            
                $etervKi .= "<a href=\"teljeset.php?edzesterv={$etID}\">
                <div class=\"edzesterv\">
                    <div class=\"etneve\">
                        <p>Edzésterv neve</p>
                        <h3>{$sor['neve']}</h3>
                    </div>
                    <div class=\"etleirasa\">
                        <p>Leírás<br>". shorter(strip_tags($sor['leiras']), 150)."</p>
                    </div>
                    <div class=\"etkitol\">
                        <p>Edző neve</p>
                        <h3>{$eVnev} {$eKnev}</h3>
                    </div>
                </div>
                </a>";
            }
        }
        else{
            $etervKi .= "
            <div class=\"etervKozep\">
            <div class=\"eTervSegitseg\">
                <p class=\"etSegitsegC\">Önnek még nincs egy edzésterve sem!</p>
                <p>Edzéstervet az Edző típusú profillal rendelkező felhasználóktól tud kérni.</p>
                <ol>
                    <li>Kérjen fel egy edzőt</li>
                    <li>Ha az edző elfogadta a felkérését, chat részben meg tudják beszélni a további részleteket (milyen edzéstervet / étrendet szeretne, korábbi sérülések, betegségek stb.)</li>
                    <li>Amikor mindezt megbeszélték, az edző megírja a személyre szabott edzéstervet/étrendet, amint készen van az edzéstervek menüpontban fogja tudni megtekinteni.</li>
                </ol>
            </div>
            </div>";
        }
        $etervKi .= "</div>";
        $felulet .= $etervKi;
    }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../pics/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/edzesterv.css">
    <title>Edzéstervek - <?php echo "{$vnev} {$knev}"; ?></title>
</head>
<body>
    <!-- Felső és oldalsó menü -->
    <?php require("leker/SidebarNavbar.php"); ?>

    <main id="edzestervMain">
        <?php print($felulet); ?>
    </main>
    

    <script src="../js/script.js"></script>
</body>
</html>