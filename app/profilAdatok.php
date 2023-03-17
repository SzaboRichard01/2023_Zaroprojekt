<?php
    session_start();
    require("kapcsolat.php");
    if (!isset($_SESSION['felh_id'])) {
        header("Location: ../belepes.php");
        exit();
    } else {
        //Saját profil adatainak lekérése
        require("leker/sajatProfil.php");

        $valasztott = mysqli_real_escape_string($dbconn, $_GET['felhasznalo_id']);
        $sql = mysqli_query($dbconn, "SELECT * FROM felhasznalok WHERE felhasznalo_id = {$valasztott}");
        if(mysqli_num_rows($sql) > 0){
            $kimenet = "";
            while($sor = mysqli_fetch_assoc($sql)){
                $edzoVnev = $sor['vnev'];
                $edzoKnev = $sor['knev'];

                //Felkérés gomb - Ha már egyszer felkértük edzőnek, ne lehessen újra
                $sqlFelkeres = mysqli_query($dbconn, "SELECT kuldo_az, fogado_az FROM edzoklienskapcs WHERE kuldo_az = {$felh_id} AND fogado_az = {$valasztott}
                OR fogado_az = {$felh_id} AND kuldo_az = {$valasztott}");
                if(mysqli_num_rows($sqlFelkeres) > 0){
                    $FelkeresBtn = "<button disabled >Már felkérve</button>";
                }
                else{
                    $_SESSION['p_tipus'] == "edző" ? $tipus = "Kliens Felkérése" : $tipus = "Edző Felkérése";
                    $FelkeresBtn = "<button onclick=\"location.href='muveletek/ekFelkeres.php?felhasznalo_id=" .$sor['felhasznalo_id']."';\">". $tipus ."</button>";
                }
                //Felkérés gomb vége

                //Telefonszám
                $telefon = "";
                if($sor['telefon'] != 0){
                    $telefon = $sor['telefon'];
                }
                else{
                    $telefon = "Nincs megadva";
                }
                //----------

                $kimenet .= "
                <div class=\"felh-nev\">
                    <button onclick=\"location.href='kezdolap.php';\";><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Vissza</button>
                    <p class=\"nev\">{$sor['vnev']} {$sor['knev']}</p>
                </div>
                <div class=\"felh-adatok\">
                    <div class=\"fadatok-pkep\">
                        <p>Profilkép</p>
                        <div class=\"kep\"><img src=\"../pics/profile/" .$sor['kep']. "\"></div>
                    </div>
                    <div class=\"adatok-tabla\">
                        <table>
                        <tr>
                            <th>Vezetéknév:</th>
                            <td>{$sor['vnev']}</td>
                        </tr>
                        <tr>
                            <th>Keresztnév:</th>
                            <td>{$sor['knev']}</td>
                        </tr>
                        <tr>
                            <th>E-mail:</th>
                            <td>{$sor['email']}</td>
                        </tr>
                        <tr>
                            <th>Profil típusa:</th>
                            <td>{$sor['profil_tipus']}</td>
                        </tr>
                        <tr>
                            <th>Nem:</th>
                            <td>{$sor['nem']}</td>
                        </tr>";

                            //Csak akkor írja ki a Bemutatkozót, Telefonszámot ha a profil típusa edző
                            if($sor['profil_tipus'] == "edző"){
                                $kimenet .= "<tr>
                                    <th>Telefon:</th>";

                                    $sor['telefon'] == "" ? $kimenet .= "<td>Nincs megadva</td>" : $kimenet .= "<td>{$sor['telefon']}</td>";

                                $kimenet .= "</tr>
                                </table>
                                </div>
                                
                                <div class=\"bemutatkozo\">
                                <h2>Bemutatkozó:</h2>";

                                $sor['bemutatkozo'] == "" ? $kimenet .= "<p>Nincs megadva</p>" : $kimenet .= "<p>{$sor['bemutatkozo']}</p>";

                                $kimenet .= "</div>";
                            }
                            else{
                                $kimenet .= "</table>
                                </div>
                                </div>";
                            }
                            //-----------------
                $kimenet .= "
                <div class=\"edzo-gombok\">
                    {$FelkeresBtn}
                    <button onclick=\"location.href='chat.php?chat={$sor['felhasznalo_id']}'\">Csevegés</button>
                    <button id=\"etervBtn\" onclick=\"location.href='etervM.php?kliens=". $valasztott ."'\">Kliens edzésterveinek megtekintése</button>
                </div>";
            }
        }
    }
?><!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../pics/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/app.css">
    <title><?php print "{$edzoVnev} {$edzoKnev}"; ?> [Adatok]</title>
</head>
<body>
    <!-- Felső és oldalsó menü -->
    <?php require("leker/SidebarNavbar.php"); ?>

    <main>
        <h1>Profil adatai</h1>
        <div class="fadatok">
            <?php print($kimenet) ?>
        </div>

        <?php
            if($profilTipus == "edző"){
                print "<div class=\"funkciok\">
                    
                </div>
                ";
            }
        ?>
    </main>

    <script src="../js/script.js"></script>
</body>
</html>