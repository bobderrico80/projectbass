<?php
    //MySQL connection variables
    $hostname = 'localhost';
    $user = ini_get('mysqli.default_user');
    $pw = ini_get('mysqli.default_pw');
    $database = 'rhytxfpd_projectbass_admin';
    
    //Connect to database
    try {
        $db = new PDO('mysql:host=' . $hostname . ';dbname=' . $database,$user,$pw);
    } catch(PDOException $e) {
        echo $e->getMessage();
        die();
    }

?>