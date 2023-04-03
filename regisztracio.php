<?php
require("app/kapcsolat.php");

if(isset($_POST['reg'])){
    if(!empty($_POST['neme']) && !empty($_POST['vnev']) && !empty($_POST['knev']) && !empty($_POST['email']) && !empty($_POST['jelszo'])){
        $tipus = strip_tags($_POST['ptipus']);

        trim(strip_tags($_POST['neme'])) == "férfi" ? $nem = 1 : $nem = 0;

        $vnev = trim(strip_tags(ucfirst($_POST['vnev'])));
        $knev = trim(strip_tags(ucfirst($_POST['knev'])));
        $email = strip_tags(strtolower($_POST['email']));

        $jelszo = strip_tags($_POST['jelszo']);
        $hash = password_hash($jelszo, PASSWORD_DEFAULT); 

        $bemutatkozo = $_POST['bemutatkozo'];
        $telefon = trim(strip_tags($_POST['telefon']));
    }

    if(isset($_POST['email'])){
        $sqlVan = mysqli_query($dbconn, "SELECT email FROM felhasznalok WHERE email = '{$_POST['email']}'");
        if(mysqli_num_rows($sqlVan) != 0){
            $VanIlyen = true;
        }
    }

    if(isset($VanIlyen)){
        $hibak[] = "<p>Ehhez az E-mail címhez már tartozik egy felhasználó!</p>";
    }
    if(empty($_POST['ptipus'])){
        $hibak[] = "<p>Nem választotta ki, hogy milyen típusú profilt szeretne!</p>";
    }
    if(empty($_POST['neme'])){
        $hibak[] = "<p>Nem adta meg a nemét!</p>";
    }
    if(empty($_POST['vnev'])){
        $hibak[] = "<p>Nem adta meg a vezetéknevét!</p>";
    }
    if(empty($_POST['knev'])){
        $hibak[] = "<p>Nem adta meg a keresztnevét!</p>";
    }
    if(isset($email)){
        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $hibak[] = "<p>Hibás E-mail címet adott meg!</p>";
        }
    } else{
        $hibak[] = "<p>Nem adott meg E-mail címet!</p>";
    }
    
    if(empty($_POST['jelszo'])){
        $hibak[] = "<p>Jelszó megadása kötelező!</p>";
    }
    if($_POST['jelszo'] != $_POST['jelszo_megerosit'] && $_POST['jelszo_megerosit'] != ""){
        $hibak[] = "<p>A jelszavak nem egyeznek!</p>";
    }
    if(empty($_POST['jelszo_megerosit'])){
        $hibak[] = "<p>Nem erősítette meg a jelszót!</p>";
    }

    if(isset($_POST['ptipus'])){
        if($_POST['ptipus'] == "edző"){
            if($_POST['bemutatkozo'] == ""){
                $hibak[] = "<p>Edző profil esetén kötelező megadnia egy rövid bemutatkozót!</p>";
            }else if(strlen($_POST['bemutatkozo']) < 50){
                $hibak[] = "<p>A bemutatkozó túl rövid!</p>";
            }
            if($_POST['telefon'] == ""){
                $hibak[] = "<p>Edző profil esetén kötelező megadnia a telefonszámát!</p>";
            }
        }
    }

    $mime = array("image/jpeg", "image/gif", "image/png", "image/jpg");
    if($_FILES['foto']['error'] == 0 && $_FILES['foto']['size'] > 2000000){
        $hibak[] = "<p>A kép mérete nagyobb mint 2 MB!</p>";
    }
    if($_FILES['foto']['error'] == 0 && $_FILES['foto']['size'] > 2000000 && !in_array($_FILES['foto']['type'], $mime)){
        $hibak[] = "<p>A kép formulátuma nem megfelelő!</p>";
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
    if($_FILES['foto']['size'] == 0){
        $foto = "nincskep.png";
    }
    else{
        $foto = date("U").$kit;
    }

    if(isset($hibak)){
        $kimenet = "<ul\n>";
        foreach($hibak as $hiba){
            $kimenet .= "<li>{$hiba}</li>";
        }
        $kimenet .= "</ul>\n";
    } else{
        require("app/kapcsolat.php");
        $sql = "INSERT INTO felhasznalok
                (vnev, knev, email, jelszo, profil_tipus, kep, nem, bemutatkozo, telefon)
                VALUES
                ('{$vnev}', '{$knev}', '{$email}', '{$hash}', '{$tipus}', '{$foto}', '{$nem}', '$bemutatkozo', '$telefon')";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="pics/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reg.css">

    <link rel="stylesheet" href="app/redactor/redactor.css">

    <script src="js/jquery-1.9.0.min.js"></script>
    <script src="app/redactor/redactor.min.js"></script>
    <script>
        $(document).ready(
            function() {
                $('textarea#bemutatkozo').redactor({
                    minHeight: 300
                });
            }
        );
    </script>
    <title>Regisztráció</title>
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
                <li><a href="regisztracio.php">Regisztráció</a></li>
            </ul>
        </div>
    </nav>
    <!-- Menu vége -->
    <main>
        <h1>Regisztráció</h1>
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
            <div class="mezo">
                <label for="ptipus">Milyen típusú profilt szeretne?*</label>
                <select name="ptipus" id="ptipus">
                    <option disabled selected>Válasszon egy lehetőséget</option>
                    <option value="edző">Edző</option>
                    <option value="kliens">Kliens</option>
                </select>
            </div>
            <div class="mezokep">
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                <label for="foto">Profilkép feltöltése:</label>
                <input type="file" name="foto" id="foto">
            </div>
            <div class="mezo">
                <label for="neme">Neme:*</label>
                <select name="neme" id="neme">
                    <option disabled selected>Válasszon egy lehetőséget</option>
                    <option value="férfi">Férfi</option>
                    <option value="nő">Nő</option>
                </select>
            </div>
            <div class="mezo">
                <label for="vnev">Vezetéknév:*</label>
                <input type="text" name="vnev" id="vnev">
            </div>
            <div class="mezo">
                <label for="knev">Keresztnév:*</label>
                <input type="text" name="knev" id="knev">
            </div>
            <div class="mezo">
                <label for="email">E-mail:*</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="mezo">
                <label for="jelszo">Jelszó:*</label>
                <input type="password" name="jelszo" id="jelszo">
            </div>
            <div class="mezo">
                <label for="jelszo_megerosit">Jelszó megerősítése:*</label>
                <input type="password" name="jelszo_megerosit" id="jelszo_megerosit">
            </div>
            
            <div class="mezo">
                <div class="tip">
                    <label for="bemutatkozo">Rövid bemutatkozó:</label>
                    <div class="tooltip">
                        <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                        <span class="tooltiptext">Edző profil esetén (kötelező) tartalmazhatja: végzettséget, szakmai tapasztalatot...<br>
                        Kliens profil esetén (választható): Elérendő cél, jelenlegi állapot, sérülések, betegségek...</span>
                    </div>
                </div>
                <textarea name="bemutatkozo" id="bemutatkozo"></textarea>
            </div>
            <div class="mezo">
                <div class="tip">
                    <label for="telefon">Telefonszám:</label>
                    <div class="tooltip">
                        <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                        <span class="tooltiptext">Csak edző profil esetén kötelező!</span>
                    </div>
                </div>
                <input type="tel" name="telefon" id="telefon" placeholder="Minta: +36301234567">
            </div>
            <em>A csillaggal * jelölt mezők kitöltése kötelező!</em>
            <input type="submit" value="Regisztráció" name="reg" id="reg">
            <p>Már van fiókja? <a href="belepes.php">Jelentkezzen be!</a></p>
        </form>
    </main>

    <script src="js/script.js"></script>
</body>
</html>