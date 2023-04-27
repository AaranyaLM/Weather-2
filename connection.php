<?php
    $hostname="localhost";
    $username="root";
    $password="";
    $dbname="weather app 2";
    $con = mysqli_connect($hostname, $username, $password, $dbname);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
      }

?>