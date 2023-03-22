<?php
session_start();
require("../kapcsolat.php");

$sql = "SELECT vnev, knev, email, jelszo, kep, bemutatkozo, telefon
        FROM felhasznalok
        WHERE felhasznalo_id = {$_SESSION['felh_id']}";
$eredmeny = mysqli_query($dbconn, $sql);
$sor = mysqli_fetch_assoc($eredmeny);

$vnevK = $sor['vnev'];
$knevK = $sor['knev'];
$emailK = $sor['email'];
$kepK = $sor['kep'];
$bemutatkozoK = $sor['bemutatkozo'];
$telefonK = $sor['telefon'];

$form = "<form method=\"post\" enctype=\"multipart/form-data\">
    <div class=\"mezokep\">
        <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2000000\">
        <label for=\"foto\">Új Profilkép feltöltése:</label>
        <input type=\"file\" name=\"foto\" id=\"foto\">
    </div>
    <div class=\"mezo\">
        <label for=\"vnev\">Vezetéknév:</label>
        <input type=\"text\" id=\"vnev\" name=\"vnev\" value=\"{$vnevK}\">
    </div>
    <div class=\"mezo\">
        <label for=\"knev\">Keresztnév:</label>
        <input type=\"text\" id=\"knev\" name=\"knev\" value=\"{$knevK}\">
    </div>
    <div class=\"mezo\">
        <label for=\"email\">E-mail:</label>
        <input type=\"email\" id=\"email\" name=\"email\" value=\"{$emailK}\">
    </div>

    <div class=\"ujJelszoB\">
        <div class=\"tip\">
            <h2>Új jelszó beállítása</h2>
            <div class=\"tooltip\">
                <i class=\"fa fa-question-circle-o\" aria-hidden=\"true\"></i>
                <span class=\"tooltiptext\">Csak akkor kell kitöltenie ha új jelszót szeretne megadni!</span>
            </div>
        </div>

        <div class=\"mezo\">
            <label for=\"rjelszo\">Régi jelszó:</label>
            <input type=\"password\" id=\"rjelszo\" name=\"rjelszo\">
        </div>
        <div class=\"mezo\">
            <label for=\"jelszo\">Új jelszó:</label>
            <input type=\"password\" id=\"jelszo\" name=\"jelszo\">
        </div>
        <div class=\"mezo\">
            <label for=\"jelszom\">Új jelszó megerősítése:</label>
            <input type=\"password\" id=\"jelszom\" name=\"jelszom\">
        </div>
        <hr>
    </div>

    <div class=\"mezo\">
        <div class=\"tip\">
            <label for=\"bemutatkozo\">Bemutatkozó:</label>
            <div class=\"tooltip\">
                <i class=\"fa fa-question-circle-o\" aria-hidden=\"true\"></i>
                <span class=\"tooltiptext\">Edző profil esetén (kötelező) tartalmazhatja: végzettséget, szakmai tapasztalatot...<br>
                Kliens profil esetén (választható): Elérendő cél, jelenlegi állapot, sérülések, betegségek...</span>
            </div>
        </div>
        <textarea name=\"bemutatkozo\" id=\"bemutatkozo\">{$bemutatkozoK}</textarea>
    </div>
    <div class=\"mezo\">
        <div class=\"tip\">
            <label for=\"telefon\">Telefonszám:</label>
            <div class=\"tooltip\">
                <i class=\"fa fa-question-circle-o\" aria-hidden=\"true\"></i>
                <span class=\"tooltiptext\">Csak edző profil esetén kötelező!</span>
            </div>
        </div>
        <input type=\"tel\" name=\"telefon\" id=\"telefon\" value=\"{$telefonK}\">
    </div>
    <input type=\"submit\" value=\"Mentés\" name=\"mentes\" id=\"mentes\">
</form>";

if(isset($_POST['mentes'])){
    if(!empty($_POST['vnev']) && !empty($_POST['knev']) && !empty($_POST['email']) && !empty($_POST['bemutatkozo']) && !empty($_POST['telefon'])){
        $vezeteknev = $_POST['vnev'];
        $keresztnev = $_POST['knev'];
        $emailM = $_POST['email'];
        $bemutatkozoM = $_POST['bemutatkozo'];
        $telefonM = $_POST['telefon'];
    }

    if(empty($_POST['vnev'])){
        $hibak[] = "<p>A vezetéknév mező nem lehet üresen!</p>";
    }
    if(empty($_POST['knev'])){
        $hibak[] = "<p>A keresztnév mező nem lehet üresen!</p>";
    }
    if(empty($_POST['email'])){
        $hibak[] = "<p>Az E-mail cím mező nem lehet üresen!</p>";
    }
    if(empty($_POST['bemutatkozo']) && $_SESSION['p_tipus'] == "edző"){
        $hibak[] = "<p>A bemutatkozó mező nem lehet üresen!</p>";
    }
    if(strlen($_POST['bemutatkozo']) < 50 && $_SESSION['p_tipus'] == "edző"){
        $hibak[] = "<p>A bemutatkozó túl rövid!</p>";
    }
    if(empty($_POST['telefon']) && $_SESSION['p_tipus'] == "edző"){
        $hibak[] = "<p>A telefon mező nem lehet üresen!</p>";
    }

    //jelszó
    if(!empty($_POST['rjelszo']) && !empty($_POST['jelszo']) && !empty($_POST['jelszom'])){
        if($_POST['rjelszo'] == $sor['jelszo']){
            if($_POST['jelszo'] == $_POST['jelszom']){
                $mjelszo = $_POST['jelszo'];
            }
            else{
                $hibak[] = "<p>A jelszavak nem egyeznek!</p>";
            }
        }
        else{
            $hibak[] = "<p>A jelszavak nem egyeznek!</p>";
        }
    }
    //-------

    //kép
    if(isset($_FILES['foto'])){
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
        if($_FILES['foto']['size'] != 0){
            $ujkep = date("U").$kit;
        }
    }
    //-------

    if(isset($hibak)){
        $kimenet = "<ul\n>";
        foreach($hibak as $hiba){
            $kimenet .= "<li>{$hiba}</li>";
        }
        $kimenet .= "</ul>\n";
    }
    else{
        if(isset($mjelszo)){
            mysqli_query($dbconn, "UPDATE felhasznalok SET jelszo = '{$mjelszo}' WHERE felhasznalo_id = {$_SESSION['felh_id']}");
        }
        if(isset($ujkep)){
            move_uploaded_file($_FILES['foto']['tmp_name'], "../../pics/profile/{$ujkep}");

            mysqli_query($dbconn, "UPDATE felhasznalok SET kep = '{$ujkep}' WHERE felhasznalo_id = {$_SESSION['felh_id']}");
        }
        mysqli_query($dbconn, "UPDATE felhasznalok SET vnev = '{$vezeteknev}', knev = '{$keresztnev}', email = '{$emailM}', bemutatkozo = '{$bemutatkozoM}', telefon = '{$telefonM}' WHERE felhasznalo_id = {$_SESSION['felh_id']}");

        $_SESSION['sikAdatMod'] = "<p>Az adatok módosítása sikeres volt!</p>";
        header("Location: ../sProfil.php");
    }
}

?><!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../pics/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/app.css">
    <link rel="stylesheet" href="../../css/reg.css">

    <link rel="stylesheet" href="../redactor/redactor.css">

    <script src="../../js/jquery-1.9.0.min.js"></script>
    <script src="../redactor/redactor.min.js"></script>
    <script>
        $(document).ready(
            function() {
                $('textarea#bemutatkozo').redactor({
                    minHeight: 300
                });
            }
        );
    </script>
    <title>Adatok módosítása</title>
</head>
<body>
    <main>
        <button id="SaModVissza" onclick="location.href='../sProfil.php'"><i class="fa fa-arrow-left" aria-hidden="true"></i> Vissza</button>
        <div class="hibauzenet">
            <?php
                if (isset($kimenet)) {
                    print($kimenet);
                }
            ?>
        </div>
        <?php print $form; ?>
    </main>
</body>
</html>