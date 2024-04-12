<?php


$servername = "127.0.0.1";
$username = "root";
$password = "LPXZhN.=IVD8";
$databasename = "house_rental";


$conn = new mysqli($servername, $username, $password,$databasename) ;
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


