<?php
    $dbconn = @mysqli_connect("mysql.omega", "edzes_app", "Projektmunka123", "edzes_app");

    //ellenőrzés
    /*
    if(!$dbconn){
        die("hiba: ". mysqli_connect_error());
    } else{
        print "sikeres kapcsolat";
    }
    */

    @mysqli_query($dbconn, "SET NAMES utf8");
?>