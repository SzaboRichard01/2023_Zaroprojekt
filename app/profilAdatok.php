<?php
    session_start();
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
                $sqlFelkeres = mysqli_query($dbconn, "SELECT edzo_az, kliens_az FROM `edzo-felhasznalo` WHERE edzo_az = {$felh_id} AND kliens_az = {$valasztott}");
                if(mysqli_num_rows($sqlFelkeres) > 0){
                    $FelkeresBtn = "<button disabled >Már felkérve</button>";
                }
                else{
                    $FelkeresBtn = "<button onclick=\"location.href='felkeres.php?felhasznalo_id=" .$sor['felhasznalo_id']."';\">Kliens felvétele</button>";
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
                                <th>Profil típusa:</th>
                                <td>{$sor['profil_tipus']}</td>
                            </tr>
                            <tr>
                                <th>E-mail:</th>
                                <td>{$sor['email']}</td>
                            </tr>";

                            //Csak akkor írja ki a Képzettséget, Tapasztalatot, Telefonszámot ha a profil típusa edző
                            if($sor['profil_tipus'] == "edző"){
                                $kimenet .= "<tr>
                                    <th>Képzettség:</th>
                                    <td>{$sor['kepzettseg']}</td>
                                </tr>
                                <tr>
                                    <th>Tapasztalat:</th>
                                    <td>{$sor['tapasztalat']}</td>
                                </tr>
                                <tr>
                                    <th>Telefon:</th>
                                    <td>{$telefon}</td>
                                </tr>";
                            }
                            //-----------------
                $kimenet .= "</table>
                    </div>
                </div>
                <div class=\"edzo-gombok\">
                    {$FelkeresBtn}
                    <button>Csevegés</button>
                    <button>Edző tiltása</button>
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
                    <button>Kliens edzéstervének megtekintése</button>
                </div>
                ";
            }
        ?>
    </main>

    <script src="../js/script.js"></script>
</body>
</html>