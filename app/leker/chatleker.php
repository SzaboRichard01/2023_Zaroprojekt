<?php
session_start();


    require("../kapcsolat.php");
    if (isset($_SESSION['chataz'])) {
        $fogadoAz = $_SESSION['chataz'];
        
        $sqlKim = mysqli_query($dbconn, "SELECT kimeno_id, bejovo_id, uzenet FROM uzenet WHERE kimeno_id = {$_SESSION['felh_id']} AND bejovo_id = {$fogadoAz}");
        $kiiras = "";
        while($sorKim = mysqli_fetch_assoc($sqlKim)){
            $kiiras .= "<div class=\"kimenoUz\">
                <p>{$sorKim['uzenet']}</p>
            </div>";
            
        }
        //Kimeno vége

        //Bejövő

        $sqlBej = mysqli_query($dbconn, "SELECT kimeno_id, bejovo_id, uzenet FROM uzenet WHERE bejovo_id = {$_SESSION['felh_id']} AND kimeno_id = {$fogadoAz}");
        while ($sorBej = mysqli_fetch_assoc($sqlBej)) {
            $kiiras .= "<div class=\"bejovoUz\">
                        <p>{$sorBej['uzenet']}</p>
                    </div>";
            
        }
        print $kiiras;
    }
    


?>