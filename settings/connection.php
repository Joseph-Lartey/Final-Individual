<?php


$servername = "localhost";
$username = "root";
$password = "";
$databasename = "house_rental";


$conn = new mysqli($servername, $username, $password,$databasename) ;
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


