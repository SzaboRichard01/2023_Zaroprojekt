<?php
session_start();
define('eleres', true);
if(!isset($_GET['etid'])){
    header("Location: hiba.html");
} else{
    require("kapcsolat.php");

    $etID = $_GET['etid'];
    $tervEll = mysqli_query($dbconn, "SELECT terv_id FROM terv INNER JOIN edzoklienskapcs ON terv.kapcs_id = edzoklienskapcs.kapcs_id WHERE kuldo_az = {$_SESSION['felh_id']} AND terv_id = {$etID} OR fogado_az = {$_SESSION['felh_id']} AND terv_id = {$etID}");
    if(mysqli_num_rows($tervEll) != 0){
        $modForm = "<form method=\"post\">";

        //terv adatai
        $eredmeny = mysqli_query($dbconn, "SELECT neve, leiras FROM terv WHERE terv_id = {$etID}");
            $sor = mysqli_fetch_assoc($eredmeny);
            $etNeve = $sor['neve'];
            $etLeiras = $sor['leiras'];
        
            $modForm .="<div class=\"mezo\">
                <label for=\"etneve\">Terv neve:</label>
                <input type=\"text\" value=\"{$etNeve}\" name=\"etneve\" id=\"etneve\">
            </div>
            <div class=\"mezo\">
                <label for=\"etleiras\">Leírás:</label>
                <textarea name=\"etleiras\" id=\"etleiras\">{$etLeiras}</textarea>
            </div>";
        //-----

        $napok = array("Minden alkalomra", "Hétfő", "Kedd", "Szerda", "Csütörtök", "Péntek", "Szombat", "Vasárnap");

        //edzésterv
        $edzesterv = mysqli_query($dbconn, "SELECT nap, edzesterv FROM edzestervek WHERE terv_id = {$etID}");
        $dbEterv = mysqli_num_rows($edzesterv);
        if($dbEterv != 0){
            $i = 1;
            $modForm .= "<h2>Edzésterv</h2>";
            while($eterv = mysqli_fetch_assoc($edzesterv)){
                $modForm .= "<div class=\"mezo\">
                    <input type=\"hidden\" name=\"edznapdb\" id=\"edznapdb\" value=\"{$dbEterv}\">
                    <select name=\"edznap{$i}\" id=\"edznap{$i}\">";
                        foreach ($napok as $nap) {
                            if($nap == $eterv['nap']){
                                $modForm .= "<option value=\"{$nap}\" selected>{$nap}</option>";
                            }
                            else{
                                $modForm .= "<option value=\"{$nap}\">{$nap}</option>";
                            }
                        }
                    $modForm .= "</select>
                    <textarea name=\"edzterv{$i}\" id=\"edzterv{$i}\">{$eterv['edzesterv']}</textarea>
                </div>";
                $i++;
            }
        }
        //---

        //étrend
        $etrend = mysqli_query($dbconn, "SELECT nap, etrend FROM etrendek WHERE terv_id = {$etID}");
        $dbEtrend = mysqli_num_rows($etrend);
        if($dbEtrend != 0){
            $j = 1;
            $modForm .= "<h2>Étrend</h2>";
            while($etr = mysqli_fetch_assoc($etrend)){
                $modForm .= "<div class=\"mezo\">
                    <input type=\"hidden\" name=\"etrenddb\" id=\"etrenddb\" value=\"{$dbEtrend}\">
                    <select name=\"etrnap{$j}\" id=\"etrnap{$j}\">";
                        foreach ($napok as $nap) {
                            if($nap == $etr['nap']){
                                $modForm .= "<option value=\"{$nap}\" selected>{$nap}</option>";
                            } else{
                                $modForm .= "<option value=\"{$nap}\">{$nap}</option>";
                            }
                        }
                    $modForm .= "</select>
                    <textarea name=\"etrend{$j}\" id=\"etrend{$j}\">{$etr['etrend']}</textarea>
                </div>";
                $j++;
            }
        }
        //---
        
        $modForm .= "<input type=\"submit\" name=\"kuldes\" id=\"kuldes\" value=\"Mentés\">
        </form>";
        
        
        if(isset($_POST['kuldes'])){
            $Neve = $_POST['etneve'];
            $Leirasa = $_POST['etleiras'];

            if($Neve == ""){
                $nevhiba = "<p style=\"color: red; font-weight: bold; font-size: 18px\">A név mező nem lehet üres!</p>";
            } else{
                $update = mysqli_query($dbconn, "UPDATE terv SET neve = '{$Neve}', leiras = '{$Leirasa}' WHERE terv_id = {$etID}");
        
                //edzéstervek
                $edzDelete = mysqli_query($dbconn, "DELETE FROM edzestervek WHERE terv_id = {$etID}");
                
                isset($_POST['edznap1']) && isset($_POST['edzterv1']) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$_POST['edznap1']}', '{$_POST['edzterv1']}', '{$etID}')") : '';
                isset($_POST['edznap2']) && isset($_POST['edzterv2']) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$_POST['edznap2']}', '{$_POST['edzterv2']}', '{$etID}')") : '';
                isset($_POST['edznap3']) && isset($_POST['edzterv3']) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$_POST['edznap3']}', '{$_POST['edzterv3']}', '{$etID}')") : '';
                isset($_POST['edznap4']) && isset($_POST['edzterv4']) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$_POST['edznap4']}', '{$_POST['edzterv4']}', '{$etID}')") : '';
                isset($_POST['edznap5']) && isset($_POST['edzterv5']) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$_POST['edznap5']}', '{$_POST['edzterv5']}', '{$etID}')") : '';
                isset($_POST['edznap6']) && isset($_POST['edzterv6']) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$_POST['edznap6']}', '{$_POST['edzterv6']}', '{$etID}')") : '';
                isset($_POST['edznap7']) && isset($_POST['edzterv7']) ? mysqli_query($dbconn, "INSERT INTO edzestervek (nap, edzesterv, terv_id) VALUES ('{$_POST['edznap7']}', '{$_POST['edzterv7']}', '{$etID}')") : '';
                //----

                //étrendek
                $etrDelete = mysqli_query($dbconn, "DELETE FROM etrendek WHERE terv_id = {$etID}");

                isset($_POST['etrnap1']) && isset($_POST['etrend1']) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$_POST['etrnap1']}', '{$_POST['etrend1']}', '{$etID}')") : '';
                isset($_POST['etrnap2']) && isset($_POST['etrend2']) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$_POST['etrnap2']}', '{$_POST['etrend2']}', '{$etID}')") : '';
                isset($_POST['etrnap3']) && isset($_POST['etrend3']) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$_POST['etrnap3']}', '{$_POST['etrend3']}', '{$etID}')") : '';
                isset($_POST['etrnap4']) && isset($_POST['etrend4']) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$_POST['etrnap4']}', '{$_POST['etrend4']}', '{$etID}')") : '';
                isset($_POST['etrnap5']) && isset($_POST['etrend5']) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$_POST['etrnap5']}', '{$_POST['etrend5']}', '{$etID}')") : '';
                isset($_POST['etrnap6']) && isset($_POST['etrend6']) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$_POST['etrnap6']}', '{$_POST['etrend6']}', '{$etID}')") : '';
                isset($_POST['etrnap7']) && isset($_POST['etrend7']) ? mysqli_query($dbconn, "INSERT INTO etrendek (nap, etrend, terv_id) VALUES ('{$_POST['etrnap7']}', '{$_POST['etrend7']}', '{$etID}')") : '';
                //----

                $_SESSION['sikeresMod'] = "<p>Sikeres módosítás!</p>";
                header("Location: teljeset.php?edzesterv={$etID}");
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
                $('textarea#etleiras').redactor({
                    minHeight: 300
                });

                if(document.getElementById("edznapdb")){
                    let szam = document.getElementById("edznapdb").value;
                    for (let index = 1; index <= szam; index++) {
                        $('textarea#edzterv'+index).redactor({
                            minHeight: 300
                        });
                    }
                }

                if(document.getElementById("etrenddb")){
                    let szam2 = document.getElementById("etrenddb").value;
                    for (let index = 1; index <= szam2; index++) {
                        $('textarea#etrend'+index).redactor({
                            minHeight: 300
                        });
                    }
                }
            }
        );
    </script>

    <title>Szerkesztés</title>
</head>
<body>
    <?php
    require("leker/sajatProfil.php");
    require("leker/SidebarNavbar.php");
    ?>
    <main>
        <?php
            print("<button onclick=\"location.href='teljeset.php?edzesterv={$etID}'\"><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Vissza</button>");
            if(isset($nevhiba)){
                print $nevhiba;
            }
            print $modForm;
        ?>
    </main>
</body>
</html>