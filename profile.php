<?php
    session_start();
    if (!isset($_SESSION['felh_id'])) {
        header("Location: belepes.php");
        exit();
    } else {
        require("kapcsolat.php");

        //Saját profil adatai
        $felh_id = $_SESSION['felh_id'];

        $sql = "SELECT vnev, knev, email, profil_tipus, kep, nem, online
                    FROM felhasznalok
                    WHERE felhasznalo_id = {$felh_id}";
        $eredmeny = mysqli_query($dbconn, $sql);
        $prof = mysqli_fetch_assoc($eredmeny);

        $vnev = $prof['vnev'];
        $knev = $prof['knev'];
        $kep = $prof['kep'];
        $profilkep = "<img src=\"pics/profile/" . $kep . "\" alt=\"profile\">";
        //Saját profil adatai vége

        $sql = mysqli_query($dbconn, "SELECT * FROM felhasznalok WHERE felhasznalo_id = {$felh_id}");
        if(mysqli_num_rows($sql) > 0){
            $kimenet = "";
            while($sor = mysqli_fetch_assoc($sql)){
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
                                <td>{$sor['tapasztalat']} év</td>
                            </tr>
                            <tr>
                                <th>Telefon:</th>
                                <td>{$sor['telefon']}</td>
                            </tr>";
                            }
                            //---------------------
                $kimenet .= "</table>
                </div>
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
    <title><?php echo("{$vnev} {$knev}") ?> - Saját profil</title>
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
        <h1>Saját profil adatai</h1>
        <div class="eadatok">
            <?php print($kimenet) ?>
        </div>
    </main>

    <script src="lekerdezes/edzoadatok.js"></script>
    <script src="js/script.js"></script>
</body>
</html>