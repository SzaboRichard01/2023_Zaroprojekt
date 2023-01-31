<?php
    session_start();

    if(isset($_POST['rendben'])){
        require_once('kapcsolat.php');

        $email = mysqli_real_escape_string($dbconn, strip_tags(strtolower(trim($_POST['email']))));
        $jelszo = strip_tags($_POST['jelszo']);

        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $hiba = "Hibás E-mail címet vagy jelszót adott meg!";
        }
        else{
            $sql = "SELECT felhasznalo_id
                    FROM felhasznalok
                    WHERE email = '{$email}'
                    AND jelszo = '{$jelszo}'";
            $eredmeny = mysqli_query($dbconn, $sql);

            if(mysqli_num_rows($eredmeny) == 1){
                $_SESSION['belepett'] = true;
                header("Location: kezdolap.php");
            } else{
                $hiba = "Hibás E-mail címet vagy jelszót adott meg!";
            }
        }
    }
?><!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <script src="script.js"></script>
</body>
</html>