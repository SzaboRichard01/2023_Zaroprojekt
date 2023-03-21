<?php
    //Lapozó
    if (isset($_GET['lap'])) {
        $lap = $_GET['lap'];
    } else {
        $lap = 1;
    }
    $no_of_records_per_page = 3;
    $offset = ($lap-1) * $no_of_records_per_page;

    $total_pages_sql = "SELECT COUNT(tev_id) FROM tevekenysegek WHERE felhasznalo_id = {$_SESSION['felh_id']}";
    $result = mysqli_query($dbconn,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    //------

    function shorter($text, $chars_limit){
        if (mb_strlen($text) > $chars_limit){
            $new_text = mb_substr($text, 0, $chars_limit);
            $new_text = trim($new_text);
            return $new_text . "...";
        }
        else{
            return $text;
        }
    }

    //Lekérdezés
    $sql = "SELECT tev_id, datum, leiras
    FROM tevekenysegek
    WHERE felhasznalo_id = {$_SESSION['felh_id']}
    ORDER BY datum DESC
    LIMIT $offset, $no_of_records_per_page";
    $res_data = mysqli_query($dbconn,$sql);

    $tevKimenet = "<div class=\"tevk\"><h2>Tevékenységek</h2>
    <button onclick=\"location.href='tevRogzitese.php'\">Új rögzítése</button>
    <div class=\"tevekenysegek\">";
    if(mysqli_num_rows($res_data) != 0){
        while($sorTev = mysqli_fetch_array($res_data)){
            $tDatum = $sorTev['datum'];
                $tLeiras = $sorTev['leiras'];
    
                isset($_GET['lap']) ? $link = "?lap={$lap}&tev={$sorTev['tev_id']}" : $link = "?tev={$sorTev['tev_id']}";
    
                $tevKimenet .= "<div class=\"tev\" onclick=\"location.href='{$link}'\">
                    <p class=\"tdatum\">{$tDatum}</p>
                    <div class=\"tleiras\">". shorter(strip_tags($tLeiras), 190) ."</div>
                </div>";
        }
    }
    else{
        $tevKimenet .= "<p id=\"nincsRtev\">Nincs rögzített tevékenység!</p>";
    }
    $tevKimenet .= "</div>";
    //----

    //lapozó kimenet
    $tevKimenet .= "
    <div class=\"lapozo\">
        <button onclick=\"location.href='?lap=1'\"";
        if($lap <= 1){ $tevKimenet .= 'disabled'; }
        $tevKimenet .= ">Első</button>

        <button ";
        if($lap <= 1){ $tevKimenet .= 'disabled '; }
        $tevKimenet .= "onclick=\"location.href='";
        if($lap <= 1){ $tevKimenet .= '#'; } else { $tevKimenet .= "?lap=".($lap - 1); }
        $tevKimenet .= "'\">Előző</button>";

        $tevKimenet .= "<button ";
        if($lap >= $total_pages){ $tevKimenet .= 'disabled '; }
        $tevKimenet .= "onclick=\"location.href='";
        if($lap >= $total_pages){ $tevKimenet .= '#'; } else { $tevKimenet .= "?lap=".($lap + 1); }
        $tevKimenet .= "'\">Következő</button>";


        $tevKimenet .= "<button onclick=\"location.href='?lap={$total_pages}'\"";
        if($lap >= $total_pages){ $tevKimenet .= 'disabled'; }
        $tevKimenet .= ">Utolsó</button>
    </div></div>";
    //---------

    print $tevKimenet;
?>