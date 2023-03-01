<?php
    //Kliens profillal edzőt
    require "../kapcsolat.php";
    session_start();

    $valasztott = mysqli_real_escape_string($dbconn, $_GET['felhasznalo_id']);
    $felh_id = $_SESSION['felh_id'];

    $sql = "SELECT profil_tipus FROM felhasznalok WHERE felhasznalo_id = {$valasztott}";
    $eredmeny = mysqli_query($dbconn, $sql);
    $sor = mysqli_fetch_assoc($eredmeny);
    $valPtipusa = $sor["profil_tipus"];

    //Ha a sajátunkal megegyező típusú profilt próbálunk felkérni
    //akkor ennek megfelelő hibaüzenetet kapunk
    if($valPtipusa == $_SESSION['p_tipus']){
        if($_SESSION['p_tipus'] == "edző"){
            $hiba = "<p>Csak kliens típusú profillal kérhető fel edző!</p>";
        }
        else{
            $hiba = "<p>Csak edző típusú profillal kérhető fel kliens!</p>";
        }
        print($hiba . "<a href=\"../kezdolap.php\">Vissza a kezdőlapra</a>");
    }
    //Egyébként eltároljuk a felkérést
    else{
        $datum = date('Y-m-d h:i:s');
        $sqlBeszuras = mysqli_query($dbconn, "INSERT INTO ekkapcs (kuldo_az, fogado_az, felkeres_datuma) VALUES ('{$felh_id}', '{$valasztott}', '{$datum}')");
        header("Location: ../kliens.php");
    }
?>