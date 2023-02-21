<!DOCTYPE html>
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
    <title>Edzésterv felvitele</title>
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
        <h1>Edzésterv felvitele</h1>
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
        </form>
    </main>

    <script src="js/script.js"></script>
</body>
</html>