<?php
    session_start();
    if(isset($_SESSION['felh_id'])){
        header("Location: app/kezdolap.php");
    }

    if(isset($_POST['rendben'])){
        require_once('app/kapcsolat.php');

        $email = mysqli_real_escape_string($dbconn, strip_tags(strtolower(trim($_POST['email']))));
        $jelszo = strip_tags($_POST['jelszo']);

        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $hiba = "<p style=\"color: red;\"><strong>Hibás E-mail címet vagy jelszót adott meg!</strong></p>";
        }
        else{
            $sql = "SELECT felhasznalo_id, profil_tipus
                    FROM felhasznalok
                    WHERE email = '{$email}'
                    AND jelszo = '{$jelszo}'";
            $eredmeny = mysqli_query($dbconn, $sql);
            $sor = mysqli_fetch_assoc($eredmeny);

            if(mysqli_num_rows($eredmeny) == 1){
                $_SESSION['felh_id'] = $sor['felhasznalo_id'];
                $_SESSION['p_tipus'] = $sor['profil_tipus'];
                header("Location: app/kezdolap.php");
            } else{
                $hiba = "<p style=\"color: red;\"><strong>Hibás E-mail címet vagy jelszót adott meg!</strong></p>";
            }
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
    <link rel="shortcut icon" href="pics/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reg.css">
    <title>Belépés</title>
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
        <h1>Belépés</h1>
        <form method="post">
            <?php
                if(isset($hiba)){
                    print($hiba);
                }
            ?>
            <div class="mezo">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="mezo">
                <label for="jelszo">Jelszó:</label>
                <input type="password" name="jelszo" id="jelszo" required>
            </div>
            <div class="mezo">
                <input type="submit" value="Belépés" id="rendben" name="rendben">
            </div>
        </form>
    </main>

    <script src="js/script.js"></script>
</body>
</html>