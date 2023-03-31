<?php
    session_start();
    if (!isset($_SESSION['felh_id'])) {
        header("Location: ../belepes.php");
        exit();
    } else {
        require("kapcsolat.php");
        define('eleres', true);
        if(!isset($_GET['felhasznalo_id'])){
            header("Location: hiba.html");
        } else{
            //Saját profil adatainak lekérése
            require("leker/sajatProfil.php");
            //-----

            $valasztott = mysqli_real_escape_string($dbconn, $_GET['felhasznalo_id']);
            $sql = mysqli_query($dbconn, "SELECT * FROM felhasznalok WHERE felhasznalo_id = {$valasztott}");
            if(mysqli_num_rows($sql) > 0){
                $kimenet = "";
                while($sor = mysqli_fetch_assoc($sql)){
                    $edzoVnev = $sor['vnev'];
                    $edzoKnev = $sor['knev'];
                    $sor['nem'] == 1 ? $nem = "férfi" : $nem = "nő";

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
                                <td>{$nem}</td>
                            </tr>";

                                //Ha a profil típusa kliens ellenőrizzük hogy van e megadva bemutatkozó szövege és telefonszáma
                                if($sor['profil_tipus'] == "kliens"){
                                    $kimenet .= "<tr>
                                        <th>Telefon:</th>";

                                        $sor['telefon'] == "" ? $kimenet .= "<td>Nincs megadva</td>" : $kimenet .= "<td>{$sor['telefon']}</td>";

                                    $kimenet .= "</tr>
                                    </table>
                                    </div>
                                    
                                    <div class=\"bemutatkozo\">
                                    <h2>Bemutatkozó:</h2>";

                                    strlen($sor['bemutatkozo']) < 50 ? $kimenet .= "<p>Nincs megadva</p>" : $kimenet .= "<p>{$sor['bemutatkozo']}</p>";

                                    $kimenet .= "</div>";
                                }
                                else{
                                    $kimenet .= "<tr>
                                        <th>Telefon:</th>
                                        <td>{$sor['telefon']}</td>
                                    </tr></table>
                                    </div>

                                    <div class=\"bemutatkozo\">
                                    <h2>Bemutatkozó:</h2>
                                    <p>{$sor['bemutatkozo']}</p>
                                    </div>";
                                }
                                //-----------------

                        $sqlKapcs = mysqli_query($dbconn, "SELECT elfogadva, felkeres_datuma, kapcs_kezdete FROM edzoklienskapcs WHERE kuldo_az = {$_SESSION['felh_id']} AND fogado_az = {$valasztott}
                        OR fogado_az = {$_SESSION['felh_id']} AND kuldo_az = {$valasztott}");
                        $sorK = mysqli_fetch_assoc($sqlKapcs);

                        $kimenet .= "
                        <div class=\"edzo-gombok\">
                            {$FelkeresBtn}
                            <button onclick=\"location.href='chat.php?chat={$sor['felhasznalo_id']}'\">Csevegés</button>";

                            //Csak akkor tudjuk megnézni a kliens edzésterveit ha már van edző-kliens kapcsolat
                            if(mysqli_num_rows($sqlKapcs) != 0){
                                $elfogadva = $sorK['elfogadva'];
                                if($_SESSION['p_tipus'] == "edző" && $elfogadva == 1){
                                    $kimenet .= "<button id=\"etervBtn\" onclick=\"location.href='etervM.php?kliens=". $valasztott ."'\">Kliens edzésterveinek megtekintése</button>";
                                }
                            }
                            //--------
                        
                        $kimenet .= "</div>";

                        //Datumok
                        if(mysqli_num_rows($sqlKapcs) != 0){
                            $felkeresDat = $sorK['felkeres_datuma'];
                            $kapcsDat = $sorK['kapcs_kezdete'];

                            $kimenet .= "<div class=\"datum\">";
                            
                            if($elfogadva == 1){
                                $kimenet .= "<p>Kapcsolat kezdete: {$kapcsDat}</p>";
                            }
                            else{
                                $kimenet .= "<p>Felkérés dátuma: {$felkeresDat}</p>";
                            }

                            $kimenet .= "</div>";
                        }
                        //--------
                }
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
        <h1 class="sprofh">Profil adatai</h1>
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