<?php
session_start();
if (!isset($_SESSION['felh_id'])) {
    header("Location: ../belepes.php");
    exit();
} else {
    require("kapcsolat.php");
    define('eleres', true);
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

            //hibák szűrése
            $etNeve == "" ? $hibak[] = "<p>Kötelező megadni a terv nevét!</p>" : '';

            if((!isset($_POST['mnap1']) && !isset($_POST['edzes1']) || empty($_POST['mnap1'])) && (!isset($_POST['etr-napra1']) && !isset($_POST['etr-etrend1']) || empty($_POST['etr-napra1']))){
                $hibak[] = "<p>Legalább egy edzéstervet vagy egy étrendet rögzítenie kell!</p>";
            }

            //van e két azonos edzésnap
            isset($_POST['mnap1']) ? $edzesN[] = $_POST['mnap1'] : '';
            isset($_POST['mnap2']) ? $edzesN[] = $_POST['mnap2'] : '';
            isset($_POST['mnap3']) ? $edzesN[] = $_POST['mnap3'] : '';
            isset($_POST['mnap4']) ? $edzesN[] = $_POST['mnap4'] : '';
            isset($_POST['mnap5']) ? $edzesN[] = $_POST['mnap5'] : '';
            isset($_POST['mnap6']) ? $edzesN[] = $_POST['mnap6'] : '';
            isset($_POST['mnap7']) ? $edzesN[] = $_POST['mnap7'] : '';

            if(isset($edzesN)){
                $edzesNsz = array_unique($edzesN);
                if(count($edzesN) != count($edzesNsz)){
                    $hibak[] = "<p>Az edzéstervben nem szerepelhet egy héten belül kétszer vagy többször egy adott nap!</p>";
                }
            }
            //----

            //van e két azonos nap az étrendben
            isset($_POST['etr-napra1']) ? $etrendN[] = $_POST['etr-napra1'] : '';
            isset($_POST['etr-napra2']) ? $etrendN[] = $_POST['etr-napra2'] : '';
            isset($_POST['etr-napra3']) ? $etrendN[] = $_POST['etr-napra3'] : '';
            isset($_POST['etr-napra4']) ? $etrendN[] = $_POST['etr-napra4'] : '';
            isset($_POST['etr-napra5']) ? $etrendN[] = $_POST['etr-napra5'] : '';
            isset($_POST['etr-napra6']) ? $etrendN[] = $_POST['etr-napra6'] : '';
            isset($_POST['etr-napra7']) ? $etrendN[] = $_POST['etr-napra7'] : '';

            if(isset($etrendN)){
                $etrendNsz = array_unique($etrendN);
                if(count($etrendN) != count($etrendNsz)){
                    $hibak[] = "<p>Az étrendben nem szerepelhet egy héten belül kétszer vagy többször egy adott nap!</p>";
                }
            }
            //----


            $sqlId = mysqli_query($dbconn, "SELECT kapcs_id FROM edzoklienskapcs
                WHERE kuldo_az = {$_SESSION['felh_id']} AND fogado_az = {$tKinek}
                OR kuldo_az = {$tKinek} AND fogado_az = {$_SESSION['felh_id']}");
                $IdEr = mysqli_fetch_assoc($sqlId);
                $edzoFelhId = $IdEr['kapcs_id'];
            
            //ha már van ilyen név
            $nevEll = mysqli_query($dbconn, "SELECT terv_id FROM terv WHERE neve = '{$etNeve}' AND kapcs_id = {$edzoFelhId}");
            if(mysqli_num_rows($nevEll) != 0){
                $hibak[] = "<p>Ön már létrehozott korábban egy ilyen nevű edzéstervet {$Kvnev} {$Kknev} kliensének! A könnyebb azonosíthatóság érdekében kérjük adjon meg egy másik nevet az edzéstervének, vagy töröje a régi azonos nevű edzéstervet ha már nincs rá szüksége a kliensének!</p>";
            }
            //----

            //hibák szűrése vége

            if(isset($hibak)){
                $hibakKi = "";
                foreach ($hibak as $hiba) {
                    $hibakKi .= $hiba;
                }
            } else{

                //terv tabla insert
                $sqlEterv = mysqli_query($dbconn, "INSERT INTO terv (neve, leiras, kapcs_id)
                    VALUES ('{$etNeve}', '{$etLeiras}', '{$edzoFelhId}')");

                $sqlEtervId = mysqli_query($dbconn, "SELECT terv_id FROM terv WHERE kapcs_id = {$edzoFelhId} AND neve = '{$etNeve}'");
                $EtervIdEr = mysqli_fetch_assoc($sqlEtervId);
                $edzestervID = $EtervIdEr['terv_id'];
            
                //edzestervek tabla insert
                isset($_POST['mnap1']) && isset($_POST['edzes1']) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$_POST['mnap1']}', '{$_POST['edzes1']}', '{$edzestervID}')") : '';
                isset($_POST['mnap2']) && isset($_POST['edzes2']) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$_POST['mnap2']}', '{$_POST['edzes2']}', '{$edzestervID}')") : '';
                isset($_POST['mnap3']) && isset($_POST['edzes3']) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$_POST['mnap3']}', '{$_POST['edzes3']}', '{$edzestervID}')") : '';
                isset($_POST['mnap4']) && isset($_POST['edzes4']) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$_POST['mnap4']}', '{$_POST['edzes4']}', '{$edzestervID}')") : '';
                isset($_POST['mnap5']) && isset($_POST['edzes5']) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$_POST['mnap5']}', '{$_POST['edzes5']}', '{$edzestervID}')") : '';
                isset($_POST['mnap6']) && isset($_POST['edzes6']) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$_POST['mnap6']}', '{$_POST['edzes6']}', '{$edzestervID}')") : '';
                isset($_POST['mnap7']) && isset($_POST['edzes7']) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$_POST['mnap7']}', '{$_POST['edzes7']}', '{$edzestervID}')") : '';

                //etrendek tabla insert
                isset($_POST['etr-napra1']) && isset($_POST['etr-etrend1']) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$_POST['etr-napra1']}', '{$_POST['etr-etrend1']}', '{$edzestervID}')") : '';
                isset($_POST['etr-napra2']) && isset($_POST['etr-etrend2']) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$_POST['etr-napra2']}', '{$_POST['etr-etrend2']}', '{$edzestervID}')") : '';
                isset($_POST['etr-napra3']) && isset($_POST['etr-etrend3']) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$_POST['etr-napra3']}', '{$_POST['etr-etrend3']}', '{$edzestervID}')") : '';
                isset($_POST['etr-napra4']) && isset($_POST['etr-etrend4']) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$_POST['etr-napra4']}', '{$_POST['etr-etrend4']}', '{$edzestervID}')") : '';
                isset($_POST['etr-napra5']) && isset($_POST['etr-etrend5']) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$_POST['etr-napra5']}', '{$_POST['etr-etrend5']}', '{$edzestervID}')") : '';
                isset($_POST['etr-napra6']) && isset($_POST['etr-etrend6']) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$_POST['etr-napra6']}', '{$_POST['etr-etrend6']}', '{$edzestervID}')") : '';
                isset($_POST['etr-napra7']) && isset($_POST['etr-etrend7']) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$_POST['etr-napra7']}', '{$_POST['etr-etrend7']}', '{$edzestervID}')") : '';

                $sikeres = "<p>Sikeres edzésterv felvitel!</p>";
            }
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
            <div class="hibauzenet">
                <?php
                    if(isset($hibakKi)){
                        print $hibakKi;
                    }
                ?>
            </div>
            <!-- Edzésterv -->
            <div class="mezo">
                <label for="et-neve">Terv neve:*</label>
                <input type="text" name="et-neve" id="et-neve" require>
            </div>          
            <div class="mezo">
                <label for="et-leiras">Leírás:*</label><br>
                <textarea name="et-leiras" id="et-leiras"></textarea>
            </div>
            <!-- ---------------------------------------------- -->
            <h2>Edzésterv</h2>
            <div class="mezo">
                <label for="hnap">Hány napra szeretné felbontani az edzéstervet?*</label>
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