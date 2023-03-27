<?php
session_start();
require("kapcsolat.php");

$etID = $_GET['etid'];
$tervEll = mysqli_query($dbconn, "SELECT terv_id FROM terv INNER JOIN edzoklienskapcs ON terv.kapcs_id = edzoklienskapcs.kapcs_id WHERE kuldo_az = {$_SESSION['felh_id']} AND terv_id = {$etID} OR fogado_az = {$_SESSION['felh_id']} AND terv_id = {$etID}");
if(mysqli_num_rows($tervEll) != 0){
    $modForm = "<form method=\"post\">";

    //Edzésterv adatai
    $eredmeny = mysqli_query($dbconn, "SELECT neve, leiras FROM terv WHERE terv_id = {$etID}");
        $sor = mysqli_fetch_assoc($eredmeny);
        $etNeve = $sor['neve'];
        $etLeiras = $sor['leiras'];
    
        $modForm .="<div class=\"mezo\">
            <label for=\"etneve\">Edzésterv neve:</label>
            <input type=\"text\" value=\"{$etNeve}\" name=\"etneve\" id=\"etneve\">
        </div>
        <div class=\"mezo\">
            <label for=\"etleiras\">Leírás:</label>
            <textarea name=\"etleiras\" id=\"etleiras\">{$etLeiras}</textarea>
        </div>";
    //-----
    
    
    $modForm .= "<input type=\"submit\" name=\"kuldes\" id=\"kuldes\" value=\"Mentés\">
    </form>";
    
    
    if(isset($_POST['kuldes'])){
        $Neve = $_POST['etneve'];
        $Leirasa = $_POST['etleiras'];
        $update = mysqli_query($dbconn, "UPDATE terv SET neve = '{$Neve}', leiras = '{$Leirasa}' WHERE terv_id = {$etID}");
    
        $_SESSION['sikeresMod'] = "<p>Sikeres módosítás!</p>";
        header("Location: teljeset.php?edzesterv={$etID}");
    }
} else{
    header("Location: hiba.html");
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
        <button onclick="location.href='edzesterv.php'"><i class="fa fa-arrow-left" aria-hidden="true"></i> Vissza</button>
        <?php print $modForm; ?>
    </main>
</body>
</html>