<?php
if (!isset($_SESSION['felh_id'])) {
    header("Location: ../belepes.php");
    exit();
} else {
    
    $felh_id = $_SESSION['felh_id'];

    //Saját profil adatainak lekérdezése
    $sql = "SELECT vnev, knev, email, profil_tipus, kep, nem, bemutatkozo, telefon
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

    if($profilTipus == 'edző'){
        $bemutatkozo = $sor['bemutatkozo'];
        $telefon = $sor['telefon'];
    }
    //------------------------

    //Saját profil felületének összeállítása a $kimenet változóba
    $kimenet = "
    <div class=\"felh-nev\">
        <button id=\"spBtnVissza\" onclick=\"location.href='kezdolap.php';\"; title=\"Vissza a kezdőlapra\"><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Vissza</button>
        <p class=\"nev\">{$sor['vnev']} {$sor['knev']}</p>
        <button id=\"btnAdatokSz\" onclick=\"location.href='muveletek/sAdatModosit.php'\" title=\"Adatok módosítása\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></button>
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
    
            
    //Profilkép összeállítása
    $profilkep = "<img src=\"../pics/profile/" . $kep . "\" alt=\"\">";
}
?>