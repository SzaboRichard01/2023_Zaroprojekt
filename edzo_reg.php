<?php
    if(isset($_POST['reg'])){
        if(!empty($_POST['neme']) && !empty($_POST['vnev']) && !empty($_POST['knev']) && !empty($_POST['email']) && !empty($_POST['jelszo']) && !empty($_POST['kepzettseg'] && !empty($_POST['tapasztalat']))){
            $nem = $_POST['neme'];
            $vnev = $_POST['vnev'];
            $knev = $_POST['knev'];
            $email = $_POST['email'];
            $jelszo = $_POST['jelszo'];

            $kepzettseg = $_POST['kepzettseg'];
            $tapasztalat = $_POST['tapasztalat'];
            $telefon = $_POST['telefon'];
        }

        if(empty($_POST['neme'])){
            $hibak[] = "<p style=\"color: red;\"><strong>Nem adta meg a nemét!</strong></p>";
        } else if(empty($_POST['vnev'])){
            $hibak[] = "<p style=\"color: red;\"><strong>Nem adta meg a vezetéknevét!</strong></p>";
        } else if(empty($_POST['knev'])){
            $hibak[] = "<p style=\"color: red;\"><strong>Nem adta meg a keresztnevét!</strong></p>";
        } else if(empty($_POST['email'])){
            $hibak[] = "<p style=\"color: red;\"><strong>E-mail cím megadása kötelező!</strong></p>";
        } else if(empty($_POST['jelszo'])){
            $hibak[] = "<p style=\"color: red;\"><strong>Jelszó megadása kötelező!</strong></p>";
        }

        $mime = array("image/jpeg", "image/gif", "image/png", "image/jpg");
        if($_FILES['foto']['error'] == 0 && $_FILES['foto']['size'] > 2000000){
            $hibak[] = "<p style=\"color: red;\"><strong>A kép mérete nagyobb mint 2 MB!</strong></p>";
        }
        if($_FILES['foto']['error'] == 0 && $_FILES['foto']['size'] > 2000000 && !in_array($_FILES['foto']['type'], $mime)){
            $hibak[] = "<p style=\"color: red;\"><strong>A kép formulátuma nem megfelelő!</strong></p>";
        }

        switch ($_FILES['foto']['type']) {
            case 'image/png':
                $kit = ".png";
                break;
            case 'image/gif':
                $kit = ".gif";
                break;
            case 'image/jpeg':
                $kit = ".jpeg";
                break;
            default:
                $kit = ".jpg";
                break;
        }
        $foto = date("U").$kit;

        if(isset($hibak)){
            $kimenet = "<ul\n>";
            foreach($hibak as $hiba){
                $kimenet .= "<li>{$hiba}</li>";
            }
            $kimenet .= "</ul>\n";
        } else{
            require("kapcsolat.php");
            $online = 0;
            $tipus = "edző";
            $sql = "INSERT INTO felhasznalok
                    (vnev, knev, email, jelszo, profil_tipus, kep, nem, online, kepzettseg, tapasztalat, telefon)
                    VALUES
                    ('{$vnev}', '{$knev}', '{$email}', '{$jelszo}', '{$tipus}', '{$foto}', '{$nem}', '{$online}', '$kepzettseg', '$tapasztalat', '$telefon')";
            mysqli_query($dbconn, $sql);

            move_uploaded_file($_FILES['foto']['tmp_name'], "pics/profile/{$foto}");

            $sikeres = "<p>Sikeres Regisztráció! <a href=\"belepes.php\">Jelentkezzen be itt!</a></p>";
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reg.css">
    <title>Edző Regisztráció</title>
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
            <ul>
                <li><a href="index.html">Főoldal</a></li>
                <li><a href="belepes.php">Bejelentkezés</a></li>
                <li><a href="reg.html">Regisztráció</a></li>
            </ul>
        </div>
    </nav>
    <!-- Menu vége -->
    <main>
        <h1>Edző Regisztráció</h1>
        <div class="sikeres">
            <?php
                if(isset($sikeres)){
                    print $sikeres;
                }
            ?>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="hibauzenet">
                <?php
                    if (isset($kimenet)) {
                        print($kimenet);
                    }
                ?>
            </div>
            <div class="mezokep">
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                <label for="foto">Profilkép feltöltése:</label>
                <input type="file" name="foto" id="foto">
            </div>
            <div class="mezo">
                <label for="neme">Neme:</label>
                <select name="neme" id="neme">
                    <option disabled selected>Válasszon egy lehetőséget</option>
                    <option value="férfi">Férfi</option>
                    <option value="nő">Nő</option>
                </select>
            </div>
            <div class="mezo">
                <label for="vnev">Vezetéknév:</label>
                <input type="text" name="vnev" id="vnev">
            </div>
            <div class="mezo">
                <label for="knev">Keresztnév:</label>
                <input type="text" name="knev" id="knev">
            </div>
            <div class="mezo">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="mezo">
                <label for="jelszo">Jelszó:</label>
                <input type="password" name="jelszo" id="jelszo">
            </div>
            
            <div class="mezo">
                <label for="kepzettseg">Képzettség:</label>
                <input type="text" name="kepzettseg" id="kepzettseg">
            </div>
            <div class="mezo">
                <label for="tapasztalat">Tapasztalat:</label>
                <input type="number" name="tapasztalat" id="tapasztalat">
            </div>
            <div class="mezo">
                <label for="telefon">Telefonszám:</label>
                <input type="tel" name="telefon" id="telefon">
            </div>

            <input type="submit" value="Regisztráció" name="reg" id="reg">
            <p>Már van fiókja? <a href="belepes.php">Jelentkezzen be!</a></p>
        </form>
    </main>

    <script src="js/script.js"></script>
</body>
</html>