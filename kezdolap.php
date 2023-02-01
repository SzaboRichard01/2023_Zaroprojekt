<?php
session_start();
if (!isset($_SESSION['felh_id'])) {
    header("Location: belepes.php");
    exit();
} else {
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



    $profilkep = "<img src=\"pics/profile/" . $kep . "\" alt=\"\">";
}

?>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/klap.css">
    <title>Kezdőlap - <?php echo "{$vnev} {$knev}"; ?></title>
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
    <!-- <div class="sidebar">
        <a href="#" title="Otthon"><i class="fa fa-home"></i></a>
        <a href="#" title="Végrehajtandó feladatok"><i class="fa fa-tasks"></i></a>
        <a href="#" title="Profil"><i class="fa fa-user-circle-o"></i></a>
        <a href="#" class="exit" title="Kilépés"><i class="fa fa-power-off"></i></a>
    </div> -->
    <div class="sidebar">
        <ul>
            <li>
                <a href="#"><i class="fa fa-home"></i></a>
                <span class="tooltip">Kezdőlap</span>
            </li>
            <li>
                <a href="#"><i class="fa fa-home"></i></a>
                <span class="tooltip">Kezdőlap</span>
            </li>
            <li>
                <a href="#"><i class="fa fa-home"></i></a>
                <span class="tooltip">Kezdőlap</span>
            </li>

            <li id="kilepes">
                <a href="#"><i class="fa fa-power-off"></i></a>
                <span class="tooltip">Kilépés</span>
            </li>
        </ul>
    </div>
    <!-- Menu vége -->
    <main>
        <h1>Üdvözöljük <?php echo "{$vnev} {$knev}!"; ?></h1>

    </main>

    <script src="js/script.js"></script>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });


        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
            }
        }
    </script>
</body>

</html>