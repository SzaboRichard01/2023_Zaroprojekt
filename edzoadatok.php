<?php
    session_start();
    if (!isset($_SESSION['felh_id'])) {
        header("Location: belepes.php");
        exit();
    } else {
        require("kapcsolat.php");

        //Saját profil adatai
        $felh_id = $_SESSION['felh_id'];

        $sqlp = "SELECT vnev, knev, email, profil_tipus, kep, nem, online
                    FROM felhasznalok
                    WHERE felhasznalo_id = {$felh_id}";
        $eredmeny = mysqli_query($dbconn, $sqlp);
        $prof = mysqli_fetch_assoc($eredmeny);

        $vnev = $prof['vnev'];
        $knev = $prof['knev'];
        $kep = $prof['kep'];
        $pTipus = $prof['profil_tipus'];
        $nem = $prof['nem'];

        $profilkep = "<img src=\"pics/profile/" . $kep . "\" alt=\"profile\">";
        //Saját profil adatai vége


        $valasztott = mysqli_real_escape_string($dbconn, $_GET['felhasznalo_id']);
        $sql = mysqli_query($dbconn, "SELECT * FROM felhasznalok WHERE felhasznalo_id = {$valasztott}");
        if(mysqli_num_rows($sql) > 0){
            $kimenet = "";
            while($sor = mysqli_fetch_assoc($sql)){
                $edzoVnev = $sor['vnev'];
                $edzoKnev = $sor['knev'];

                //Felkérés gomb - Ha már egyszer felkértük edzőnek, ne lehessen újra
                $sqlFelkeres = mysqli_query($dbconn, "SELECT edzo_az, kliens_az FROM `edzo-felhasznalo` WHERE edzo_az = {$valasztott} AND kliens_az = {$felh_id}");
                if(mysqli_num_rows($sqlFelkeres) > 0){
                    $FelkeresBtn = "<button disabled >Már felkérve</button>";
                }
                else{
                    $FelkeresBtn = "<button onclick=\"location.href='felkeres.php?felhasznalo_id=" .$sor['felhasznalo_id']."';\">Edző felkérése</button>";
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
                <div class=\"edzo-nev\">
                    <button onclick=\"location.href='kezdolap.php';\";><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Vissza</button>
                    <p class=\"nev\">{$sor['vnev']} {$sor['knev']}</p>
                </div>
                <div class=\"edzo-adatok\">
                    <div class=\"eadatok-pkep\">
                        <p>Profilkép</p>
                        <div class=\"kep\"><img src=\"pics/profile/" .$sor['kep']. "\"></div>
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
    <link rel="stylesheet" href="css/klap.css">
    <title><?php print "{$edzoVnev} {$edzoKnev}"; ?> [Adatok]</title>
</head>
<body>
    <!-- Menu -->
    <nav class="menu">
        <a class="mcim" href="index.html">ShineGym&Fit</a>
        <a href="#" class="toggle-button">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="links">
            <div class="prof" onclick="location.href='profile.php';">
                <?php
                print "<p>{$vnev} {$knev}</p>
                    <div class=\"pkep\">{$profilkep}</div>";
                ?>
            </div>
            <ul>
                <li><a href="kilepes.php">Kilépés</a></li>
            </ul>
        </div>
    </nav>
    <div class="sidebar">
        <ul>
            <li>
                <a href="kezdolap.php"><i class="fa fa-home"></i></a>
                <span class="tooltip">Kezdőlap</span>
            </li>
            <li>
                <a href="#"><i class="fa fa-book"></i></a>
                <span class="tooltip">Edzéstervek</span>
            </li>
            <li>
                <a href="#"><i class="fa fa-comments"></i></a>
                <span class="tooltip">Chat</span>
            </li>
            <li>
                <a href="edzo.php"><i class="fa fa-male"></i></a>
                <span class="tooltip">Edzők kezelése</span>
            </li>
            <li>
                <a href="#"><i class="fa fa-users"></i></a>
                <span class="tooltip">Kliensek kezelése</span>
            </li>

            <li id="kilepes">
                <a href="kilepes.php"><i class="fa fa-sign-out"></i></a>
                <span class="tooltip">Kilépés</span>
            </li>
        </ul>
    </div>
    <!-- Menu vége -->
    <main>
        <h1>Profil adatai</h1>
        <div class="eadatok">
            <?php print($kimenet) ?>
        </div>

        <?php
            if($pTipus == "edző"){
                print "<div class=\"funkciok\">
                    <button>Kliens edzéstervének megtekintése</button>
                </div>
                ";
            }
        ?>
    </main>

    <script src="js/script.js"></script>
</body>
</html>