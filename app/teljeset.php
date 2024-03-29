<?php
session_start();
if(!isset($_GET['edzesterv'])){
    header("Location: hiba.html");
    exit();
} else{
    require("kapcsolat.php");
    define('eleres', true);
    $edzestervID =  mysqli_real_escape_string($dbconn, $_GET['edzesterv']);

    $tervEll = mysqli_query($dbconn, "SELECT terv_id FROM terv INNER JOIN edzoklienskapcs ON terv.kapcs_id = edzoklienskapcs.kapcs_id WHERE kuldo_az = {$_SESSION['felh_id']} AND terv_id = {$edzestervID} OR fogado_az = {$_SESSION['felh_id']} AND terv_id = {$edzestervID}");
    if(mysqli_num_rows($tervEll) != 0){
        //Edzésterv alap adatai
        $etSQL = mysqli_query($dbconn, "SELECT neve, leiras, kapcs_id FROM terv WHERE terv_id = {$edzestervID}");
        $etA = mysqli_fetch_assoc($etSQL);
        $etNeve = $etA['neve'];
        $etLeiras = $etA['leiras'];
        $ekkapcsID = $etA['kapcs_id'];

        //Melyik az edző
        $sqlKapcs = mysqli_query($dbconn, "SELECT kuldo_az, fogado_az FROM edzoklienskapcs WHERE kapcs_id = {$ekkapcsID}");
        $kapcsSor = mysqli_fetch_assoc($sqlKapcs);
        $kuldoAz = $kapcsSor['kuldo_az'];
        $fogadoAz = $kapcsSor['fogado_az'];
        if($kuldoAz == $_SESSION['felh_id']){
            $edzoID = $fogadoAz;

            //Edző profilnál
            $kliensID = $fogadoAz;
        }
        else{
            $edzoID = $kuldoAz;

            //Edző profilnál
            $kliensID = $kuldoAz;
        }
        //----

        $sqlEdzo = mysqli_query($dbconn, "SELECT vnev, knev FROM felhasznalok WHERE felhasznalo_id = {$edzoID}");
        $edzoEr = mysqli_fetch_assoc($sqlEdzo);
        $edzoNeve = "{$edzoEr['vnev']} {$edzoEr['knev']}";


        //----

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

        //Terv edzés része
        $edzSQL = mysqli_query($dbconn, "SELECT nap, edzesterv FROM edzestervek WHERE terv_id = {$edzestervID}");
        $etEdzes = "";
        $edzDb = mysqli_num_rows($edzSQL); //Hány darab edzésnap tartozik az adott edzéstervhez

        $szam = 1;
        while($edzSor = mysqli_fetch_assoc($edzSQL)){
            $etEdzes .= "<a href=\"teljeset.php?edzesterv={$edzestervID}&enap={$edzSor['nap']}\"><div class=\"etEdzes\">
                <h3>{$edzSor['nap']}</h3>
                <p>".shorter(strip_tags($edzSor['edzesterv']), 25)."</p>
            </div></a>";
            $szam++;
        }
        $edzNapazon =  mysqli_real_escape_string($dbconn, isset($_GET['enap']) ? $_GET['enap'] : '');
        if(isset($edzNapazon) && isset($_GET['enap'])){
            $mNapEr = mysqli_query($dbconn,"SELECT nap, edzesterv FROM edzestervek WHERE terv_id = {$edzestervID} AND nap = '{$_GET['enap']}'");
            $napS = mysqli_fetch_assoc($mNapEr);

            $teljesNap = "
            <div class=\"teljesNap\">
                <h3>{$napS['nap']}</h3>
                <div class=\"teljnapterv\">{$napS['edzesterv']}</div>
                <i class=\"fa fa-times tnapbezar\" aria-hidden=\"true\" onclick=\"TeljesnapBezar()\" title=\"Bezárás\"></i>
            </div>
            ";
        }
        //---

        //Edzésterv étrend része
        $etSQL = mysqli_query($dbconn, "SELECT nap, etrend FROM etrendek WHERE terv_id = {$edzestervID}");
        $etEtrend = "";
        $etDb = mysqli_num_rows($etSQL); // Hány darab értrend tartozik az adott edzéstervhez
        while($etSor = mysqli_fetch_assoc($etSQL)){
            $etEtrend .= "<a href=\"teljeset.php?edzesterv={$edzestervID}&etnap={$etSor['nap']}\">
            <div class=\"etEtrend\">
                <h3>{$etSor['nap']}</h3>
                <p>".shorter(strip_tags($etSor['etrend']), 25)."</p>
            </div></a>";
        }

        $etNapazon =  mysqli_real_escape_string($dbconn, isset($_GET['etnap']) ? $_GET['etnap'] : '');
        if(isset($etNapazon) && isset($_GET['etnap'])){
            $mNapEt = mysqli_query($dbconn,"SELECT nap, etrend FROM etrendek WHERE terv_id = {$edzestervID} AND nap = '{$_GET['etnap']}'");
            $EtnapS = mysqli_fetch_assoc($mNapEt);

            $teljesNap = "
            <div class=\"teljesNap\">
                <h3>{$EtnapS['nap']}</h3>
                <div class=\"teljnapterv\">{$EtnapS['etrend']}</div>
                <i class=\"fa fa-times tnapbezar\" aria-hidden=\"true\" onclick=\"TeljesnapBezar()\" title=\"Bezárás\"></i>
            </div>
            ";
        }
        //---
    } else{
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
    <title>Edzésterv</title>
</head>
<body>
    <?php
    //Sajnát profil adatai (Navbar részhez)
    require("leker/sajatProfil.php");

    //Felső és oldalsó menü
    require("leker/SidebarNavbar.php");
    ?>
    <main id="teljesMain">
        <div class="sikeres">
            <?php
                if(isset($_SESSION['sikeresMod'])){
                    print $_SESSION['sikeresMod'];
                    unset($_SESSION['sikeresMod']);
                }
            ?>
        </div>

        <?php
        if($_SESSION['p_tipus'] == "edző"){
            print "<div class=\"gombok\">
                <button onclick=\"location.href='etervM.php?kliens={$kliensID}'\" id=\"btnTeljesetV\"><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Vissza</button>
                <button onclick=\"location.href='etszerk.php?etid={$edzestervID}'\" class=\"btnEterv\" title=\"Név és leírás szerkesztése\">Szerkesztés</button>
                <button class=\"btnEterv\" title=\"Edzésterv törlése\" onclick=\"btnEtervTorles('{$edzoNeve}', '{$etNeve}', {$edzestervID})\">Törlés</button>
            </div>";
        }

        isset($teljesNap) ? print($teljesNap) : '';
        ?>

        <div class="tEdzesterv">
            <div class="etneve">
                <p>Edzésterv neve</p>
                <h3><?php print $etNeve; ?></h3>
            </div>
            <div class="etLeiras">
                <h3>Leírás</h3>
                <p><?php print $etLeiras; ?></p>
            </div>
            <div class="etTartalom">
                <div class="etEdzesek">
                    <h2>Edzés</h2>
                    <div class="etListak">
                        <?php print $etEdzes; ?>
                    </div>
                </div>
                <div class="etEtrendek">
                    <h2>Étrend</h2>
                    <div class="etListak">
                        <?php print $etEtrend; ?>
                    </div>
                </div>
            </div>
            <div class="etkitol">
                <p><?php $_SESSION['p_tipus'] == "edző" ? print("Kliens neve"): print("Edző neve"); ?></p>
                <h3><?php print $edzoNeve; ?></h3>
            </div>
        </div>
    </main>

    <script>
        function TeljesnapBezar(){
            let teljesNap = document.querySelector(".teljesNap");
            
                teljesNap.style.display = "none";
            
        }
    </script>
    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>