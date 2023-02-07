<?php
include("kapcsolat.php");
    $valasztott = mysqli_real_escape_string($dbconn, $_GET['felhasznalo_id']);
    $sql = mysqli_query($dbconn, "SELECT * FROM felhasznalok WHERE felhasznalo_id = {$valasztott}");
    if(mysqli_num_rows($sql) > 0){
        $kimenet = "";
        while($sor = mysqli_fetch_assoc($sql)){
            $kimenet .= "<div class=\"edzo\">
            <div class=\"pkep\"><img src=\"pics/profile/" .$sor['kep']. "\"></div>
            <p>{$sor['vnev']} {$sor['knev']}</p>\n
            </div>
            <table>
                <tr>
                    <th>E-mail:</th>
                    <td>{$sor['email']}</td>
                </tr>
                <tr>
                    <th>Képzettség:</th>
                    <td>{$sor['kepzettseg']}</td>
                </tr>
                <tr>
                    <th>Tapasztalat:</th>
                    <td>{$sor['tapasztalat']}</td>
                </tr>
                <tr>
                    <th>Telefon:</th>
                    <td>{$sor['telefon']}</td>
                </tr>
            </table>";
        }

    }
    
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/klap.css">
    <title>Document</title>
</head>
<body>
    <div class="eadatok">
        <?php print($kimenet) ?>
    </div>

    <script src="lekerdezes/edzoadatok.js"></script>
</body>
</html>