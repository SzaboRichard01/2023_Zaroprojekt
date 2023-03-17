<?php
session_start();


    require("../kapcsolat.php");
    if (isset($_SESSION['chataz'])) {
        $fogadoAz = $_SESSION['chataz'];
        
        $sqlKim = mysqli_query($dbconn, "SELECT kimeno_id, bejovo_id, uzenet FROM uzenetek WHERE kimeno_id = {$_SESSION['felh_id']} AND bejovo_id = {$fogadoAz}
        OR bejovo_id = {$_SESSION['felh_id']} AND kimeno_id = {$fogadoAz}");
        $kiiras = "";
        while($sorKim = mysqli_fetch_assoc($sqlKim)){
            if($sorKim['kimeno_id'] == $_SESSION['felh_id']){
                $kiiras .= "<div class=\"kimenoUz\">
                <p>{$sorKim['uzenet']}</p>
                </div>";
            }
            else{
                $kiiras .= "<div class=\"bejovoUz\">
                        <p>{$sorKim['uzenet']}</p>
                    </div>";
            }

            
            
        }
        print $kiiras;
    }
    


?>