<?php 
// db_connect.php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "David.do";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Error de conexion: " . mysqli_connect_error());
}
