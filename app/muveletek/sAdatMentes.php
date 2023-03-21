<?php
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

        $sikeres = "<p>Az adatok módosítása sikeres volt! <a href=\"../kezdolap.php\">Vissza a kezdőlapra</a></p>";
    }
}
?>