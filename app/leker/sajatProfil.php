<?php
if (!isset($_SESSION['felh_id'])) {
    header("Location: ../belepes.php");
    exit();
} else {
    require("kapcsolat.php");
    $felh_id = $_SESSION['felh_id'];

    //Saját profil adatainak lekérdezése
    $sql = "SELECT vnev, knev, email, profil_tipus, kep, nem, online, kepzettseg, tapasztalat, telefon
            FROM felhasznalok
            WHERE felhasznalo_id = {$felh_id}";
    $eredmeny = mysqli_query($dbconn, $sql);
    $sor = mysqli_fetch_assoc($eredmeny);

    $vnev = $sor['vnev'];
    $knev = $sor['knev'];
    $email = $sor['email'];
    $profilTipus = $sor['profil_tipus'];
    $kep = $sor['kep'];
    $nem = $sor['nem'];
    $online = $sor['online'];

    if($profilTipus == 'edző'){
        $kepzettseg = $sor['kepzettseg'];
        $tapasztalat = $sor['tapasztalat'];
        $telefon = $sor['telefon'];
    }
    //------------------------

    //Saját profil felületének összeállítása a $kimenet változóba
    $kimenet = "
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
    //------------
            
    //Profilkép összeállítása
    $profilkep = "<img src=\"../pics/profile/" . $kep . "\" alt=\"\">";

    //header("Location: ../sProfil.php");
}
?>