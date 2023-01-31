<?php
    $dbconn = @mysqli_connect("localhost", "root", "", "edzes_app");

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