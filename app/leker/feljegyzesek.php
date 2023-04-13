<?php
if(!defined('eleres')){
    header("Location: ../hiba.html");
} else{
    //Lapozó
    if (isset($_GET['lap'])) {
        $lap = $_GET['lap'];
    } else {
        $lap = 1;
    }
    $no_of_records_per_page = 3;
    $offset = ($lap-1) * $no_of_records_per_page;
    $total_pages_sql = "SELECT COUNT(felj_id) FROM feljegyzesek WHERE felhasznalo_id = {$_SESSION['felh_id']}";
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
    $sql = "SELECT felj_id, datum, leiras
    FROM feljegyzesek
    WHERE felhasznalo_id = {$_SESSION['felh_id']}
    ORDER BY datum DESC
    LIMIT $offset, $no_of_records_per_page";
    $res_data = mysqli_query($dbconn,$sql);
    $feljKimenet = "<div class=\"felj\"><h2>Feljegyzések</h2>
    <button onclick=\"location.href='feljRogzitese.php'\">Új rögzítése</button>
    <div class=\"feljegyzesek\">";
    if(mysqli_num_rows($res_data) != 0){
        while($sorTev = mysqli_fetch_array($res_data)){
            $tDatum = $sorTev['datum'];
                $tLeiras = $sorTev['leiras'];
    
                isset($_GET['lap']) ? $link = "?lap={$lap}&felj={$sorTev['felj_id']}" : $link = "?felj={$sorTev['felj_id']}";
    
                $feljKimenet .= "<div class=\"fel\" onclick=\"location.href='{$link}'\">
                    <p class=\"fdatum\">{$tDatum}</p>
                    <div class=\"fleiras\">". shorter(strip_tags($tLeiras), 190) ."</div>
                </div>";
        }
    }
    else{
        $feljKimenet .= "<p id=\"nincsRtev\">Nincs rögzített feljegyzés!</p>";
    }
    $feljKimenet .= "</div>";
    //----
    //lapozó kimenet
    $feljKimenet .= "
    <div class=\"lapozo\">
        <button onclick=\"location.href='?lap=1'\"";
        if($lap <= 1){ $feljKimenet .= 'disabled'; }
        $feljKimenet .= ">Első</button>
        <button ";
        if($lap <= 1){ $feljKimenet .= 'disabled '; }
        $feljKimenet .= "onclick=\"location.href='";
        if($lap <= 1){ $feljKimenet .= '#'; } else { $feljKimenet .= "?lap=".($lap - 1); }
        $feljKimenet .= "'\">Előző</button>";
        $feljKimenet .= "<button ";
        if($lap >= $total_pages){ $feljKimenet .= 'disabled '; }
        $feljKimenet .= "onclick=\"location.href='";
        if($lap >= $total_pages){ $feljKimenet .= '#'; } else { $feljKimenet .= "?lap=".($lap + 1); }
        $feljKimenet .= "'\">Következő</button>";
        $feljKimenet .= "<button onclick=\"location.href='?lap={$total_pages}'\"";
        if($lap >= $total_pages){ $feljKimenet .= 'disabled'; }
        $feljKimenet .= ">Utolsó</button>
    </div></div>";
    //---------
    print $feljKimenet;
}
?>