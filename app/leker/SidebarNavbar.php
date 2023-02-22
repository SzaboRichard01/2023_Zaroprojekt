<!-- Felső navbar -->
<nav class="menu">
    <a class="mcim" href="../index.html">ShineGym&Fit</a>
    <a href="#" class="toggle-button">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </a>
    <div class="links">
        <div class="prof" onclick="location.href='sProfil.php';">
            <?php
            print "<p>{$vnev} {$knev}</p>
                <div class=\"pkep\">{$profilkep}</div>";
            ?>
        </div>
    </div>
</nav>
<!-- Felső navbar vége -->

<!-- Sidebar -->
<div class="sidebar">
    <ul>
        <li>
            <a href="kezdolap.php"><i class="fa fa-home"></i></a>
            <span class="tooltip">Kezdőlap</span>
        </li>
        <li>
            <a href="edzesterv.php"><i class="fa fa-book"></i></a>
            <span class="tooltip">Edzéstervek</span>
        </li>
        <li>
            <a href="chat.php"><i class="fa fa-comments"></i></a>
            <span class="tooltip">Chat</span>
        </li>

        <li>
            <a href="edzo.php"><i class="fa fa-male"></i></a>
            <span class="tooltip">Edzők kezelése</span>
        </li>
        <li>
            <a href="kliens.php"><i class="fa fa-users"></i></a>
            <span class="tooltip">Kliensek kezelése</span>
        </li>

        <li id="kilepes">
            <a href="kilepes.php"><i class="fa fa-sign-out"></i></a>
            <span class="tooltip">Kilépés</span>
        </li>
    </ul>
</div>
<!-- Sidebar vége -->