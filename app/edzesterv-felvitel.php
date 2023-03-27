<?php
session_start();
if (!isset($_SESSION['felh_id'])) {
    header("Location: ../belepes.php");
    exit();
} else {
    define('eleres', true);
    require("kapcsolat.php");
    //Saját profil adatainak lekérése
    require("leker/sajatProfil.php");

    //Kiválasztott kliens adatainak lekérdezése
    $tKinek = mysqli_real_escape_string($dbconn, $_GET['felvitel']); //felhasznalo_id

    $sqlKEll = mysqli_query($dbconn, "SELECT kapcs_id FROM edzoklienskapcs WHERE kuldo_az = '{$tKinek}' AND fogado_az = {$_SESSION['felh_id']} AND elfogadva = 1
    OR fogado_az = '{$tKinek}' AND kuldo_az = {$_SESSION['felh_id']} AND elfogadva = 1");
    if(mysqli_num_rows($sqlKEll) != 0){
        $sqlKinek = mysqli_query($dbconn, "SELECT vnev, knev, kep FROM felhasznalok WHERE felhasznalo_id = '{$tKinek}'");
        $sorKinek = mysqli_fetch_assoc($sqlKinek);

        $Kvnev = $sorKinek['vnev'];
        $Kknev = $sorKinek['knev'];
        $Kkep = $sorKinek['kep'];
        //--------

        //Ha rányomtunk a küldés gombra
        if(isset($_POST['kuldes'])){
            $etNeve = $_POST['et-neve'];
            $etLeiras = $_POST['et-leiras'];

            //Edzés - melyik nap
            isset($_POST['mnap1']) ? $mNap1 = $_POST['mnap1'] : '';
            isset($_POST['mnap2']) ? $mNap2 = $_POST['mnap2'] : '';
            isset($_POST['mnap3']) ? $mNap3 = $_POST['mnap3'] : '';
            isset($_POST['mnap4']) ? $mNap4 = $_POST['mnap4'] : '';
            isset($_POST['mnap5']) ? $mNap5 = $_POST['mnap5'] : '';
            isset($_POST['mnap6']) ? $mNap6 = $_POST['mnap6'] : '';
            isset($_POST['mnap7']) ? $mNap7 = $_POST['mnap7'] : '';
            //----

            //Edzés - edzés leírása
            isset($_POST['edzes1']) ? $edzes1 = $_POST['edzes1'] : '';
            isset($_POST['edzes2']) ? $edzes2 = $_POST['edzes2'] : '';
            isset($_POST['edzes3']) ? $edzes3 = $_POST['edzes3'] : '';
            isset($_POST['edzes4']) ? $edzes4 = $_POST['edzes4'] : '';
            isset($_POST['edzes5']) ? $edzes5 = $_POST['edzes5'] : '';
            isset($_POST['edzes6']) ? $edzes6 = $_POST['edzes6'] : '';
            isset($_POST['edzes7']) ? $edzes7 = $_POST['edzes7'] : '';
            //----

            
            //Étrend - melyik napra
            isset($_POST['etr-napra1']) ? $etrNap1 = $_POST['etr-napra1'] : '';
            isset($_POST['etr-napra2']) ? $etrNap2 = $_POST['etr-napra2'] : '';
            isset($_POST['etr-napra3']) ? $etrNap3 = $_POST['etr-napra3'] : '';
            isset($_POST['etr-napra4']) ? $etrNap4 = $_POST['etr-napra4'] : '';
            isset($_POST['etr-napra5']) ? $etrNap5 = $_POST['etr-napra5'] : '';
            isset($_POST['etr-napra6']) ? $etrNap6 = $_POST['etr-napra6'] : '';
            isset($_POST['etr-napra7']) ? $etrNap7 = $_POST['etr-napra7'] : '';
            //----

            //Étrend - étrend leírása
            isset($_POST['etr-etrend1']) ? $etrEtrend1 = $_POST['etr-etrend1'] : '';
            isset($_POST['etr-etrend2']) ? $etrEtrend2 = $_POST['etr-etrend2'] : '';
            isset($_POST['etr-etrend3']) ? $etrEtrend3 = $_POST['etr-etrend3'] : '';
            isset($_POST['etr-etrend4']) ? $etrEtrend4 = $_POST['etr-etrend4'] : '';
            isset($_POST['etr-etrend5']) ? $etrEtrend5 = $_POST['etr-etrend5'] : '';
            isset($_POST['etr-etrend6']) ? $etrEtrend6 = $_POST['etr-etrend6'] : '';
            isset($_POST['etr-etrend7']) ? $etrEtrend7 = $_POST['etr-etrend7'] : '';
            //---


            $sqlId = mysqli_query($dbconn, "SELECT kapcs_id FROM edzoklienskapcs
                WHERE kuldo_az = {$_SESSION['felh_id']} AND fogado_az = {$tKinek}
                OR kuldo_az = {$tKinek} AND fogado_az = {$_SESSION['felh_id']}");
            $IdEr = mysqli_fetch_assoc($sqlId);
            $edzoFelhId = $IdEr['kapcs_id'];


            //terv tabla insert
            $sqlEterv = mysqli_query($dbconn, "INSERT INTO terv (neve, leiras, kapcs_id)
                VALUES ('{$etNeve}', '{$etLeiras}', '{$edzoFelhId}')");

            $sqlEtervId = mysqli_query($dbconn, "SELECT terv_id FROM terv WHERE kapcs_id = {$edzoFelhId} AND neve = '{$etNeve}'");
            $EtervIdEr = mysqli_fetch_assoc($sqlEtervId);
            $edzestervID = $EtervIdEr['terv_id'];
            
            //edzestervek tabla insert
            isset($mNap1) && isset($edzes1) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$mNap1}', '{$edzes1}', '{$edzestervID}')") : '';
            isset($mNap2) && isset($edzes2) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$mNap2}', '{$edzes2}', '{$edzestervID}')") : '';
            isset($mNap3) && isset($edzes3) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$mNap3}', '{$edzes3}', '{$edzestervID}')") : '';
            isset($mNap4) && isset($edzes4) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$mNap4}', '{$edzes4}', '{$edzestervID}')") : '';
            isset($mNap5) && isset($edzes5) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$mNap5}', '{$edzes5}', '{$edzestervID}')") : '';
            isset($mNap6) && isset($edzes6) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$mNap6}', '{$edzes6}', '{$edzestervID}')") : '';
            isset($mNap7) && isset($edzes7) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$mNap7}', '{$edzes7}', '{$edzestervID}')") : '';

            //etrendek tabla insert
            isset($etrNap1) && isset($etrEtrend1) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$etrNap1}', '{$etrEtrend1}', '{$edzestervID}')") : '';
            isset($etrNap2) && isset($etrEtrend2) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$etrNap2}', '{$etrEtrend2}', '{$edzestervID}')") : '';
            isset($etrNap3) && isset($etrEtrend3) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$etrNap3}', '{$etrEtrend3}', '{$edzestervID}')") : '';
            isset($etrNap4) && isset($etrEtrend4) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$etrNap4}', '{$etrEtrend4}', '{$edzestervID}')") : '';
            isset($etrNap5) && isset($etrEtrend5) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$etrNap5}', '{$etrEtrend5}', '{$edzestervID}')") : '';
            isset($etrNap6) && isset($etrEtrend6) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$etrNap6}', '{$etrEtrend6}', '{$edzestervID}')") : '';
            isset($etrNap7) && isset($etrEtrend7) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$etrNap7}', '{$etrEtrend7}', '{$edzestervID}')") : '';

            $sikeres = "<p>Sikeres edzésterv felvitel!</p>";
        }
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
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
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
                $('textarea#et-leiras').redactor({
                    minHeight: 300
                });
            }
        );

        function redactorEdz(){
            let szam = document.getElementById("hnap").value;
            for (let index = 1; index <= szam; index++) {
                $('textarea#edzes'+index).redactor({
                minHeight: 300
            });
            }
        }

        function redactorEtrend() {
            let szam = document.getElementById("etrendnap").value;
            for (let index = 1; index <= szam; index++) {
                $('textarea#etr-etrend'+index).redactor({
                minHeight: 300
            });
            }
        }
    </script>

    <title>Edzésterv felvitele</title>
</head>
<body>
    <!-- Felső és oldalsó menü -->
    <?php require("leker/SidebarNavbar.php"); ?>

    <main>
        <h2>Edzésterv felvitele <span><?php print("{$Kvnev} {$Kknev}"); ?></span> felhasználónak</h2>

        <div class="sikeres">
            <?php
                if(isset($sikeres)){
                    print $sikeres;
                }
            ?>
        </div>

        <?php
        print("<div class=\"felh\">
        <div class=\"pkep pkep-meret\"><img src=\"../pics/profile/" .$Kkep. "\"></div>
        <p>{$Kvnev} {$Kknev}</p>
        </div>");
        ?>

        <form method="post" enctype="multipart/form-data" id="felvitelForm">
            <!-- Edzésterv -->
            <h2>Edzésterv</h2>
            <div class="mezo">
                <label for="et-neve">Edzésterv neve:*</label>
                <input type="text" name="et-neve" id="et-neve" require>
            </div>
            <!-- <div class="mezo">
                <label for="et-leiras">Leírás:</label>
                <textarea name="et-leiras" id="et-leiras"></textarea>
            </div> -->            
            <div class="mezo">
                <label for="et-leiras">Leírás:*</label><br>
                <textarea name="et-leiras" id="et-leiras" style="min-height: 300px;"></textarea>
            </div>
            <!-- ---------------------------------------------- -->
            <div class="mezo">
                <label for="hnap">Hány edzésnap legyen egy héten?*</label>
                <select name="hnap" id="hnap" onchange="hanyNap(this), redactorEdz()">
                    <option disabled selected>Válasszon egy számot!</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                </select>
            </div>
            <div id="mezonapok"></div>
            <!-- ------------ -->

            <!-- Értrend -->
            <h2>Étrend</h2>
            <div class="mezo">
                <label for="etrendnap">Hány napra szeretne értendet rögzíteni?*</label>
                <select name="etrendnap" id="etrendnap" onchange="etrendNap(this), redactorEtrend()">
                    <option disabled selected>Válasszon egy számot!</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                </select>
            </div>

            <div id="etrendnapok"></div>
            <!-- ------ -->

            <em>A csillaggal * jelölt mezők kitöltése kötelező!</em>
            <input type="submit" name="kuldes" id="kuldes" value="Küldés">
        </form>
    </main>

    <script src="../js/script.js"></script>
</body>
</html>