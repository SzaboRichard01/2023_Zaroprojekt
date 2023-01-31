<?php
    session_start();
    if(!isset( $_SESSION['felh_id'])){
        header("Location: belepes.php");
        exit();
    }
    else{
        require("kapcsolat.php");
        $felh_id = $_SESSION['felh_id'];

        $sql = "SELECT vnev, knev, email, profil_tipus, kep, nem, online
                FROM felhasznalok
                WHERE felhasznalo_id = {$felh_id}";
        $eredmeny = mysqli_query($dbconn, $sql);
        $sor = mysqli_fetch_assoc($eredmeny);

        $vnev = $sor['vnev'];
        $knev = $sor['knev'];

        $kep = $sor['kep'];



        $profilkep = "<img src=\"pics/profile/".$kep."\" alt=\"\">";
    }
    
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/klap.css">
    <title>Kezdőlap</title>
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
            <div class="prof" onclick="location.href='profile.html';">
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
    <!-- Menu vége -->
    <main>
        <h1>Üdvözöljük <?php echo "{$vnev} {$knev}!"; ?></h1>
        
    </main>

    <script src="js/script.js"></script>
</body>
</html>