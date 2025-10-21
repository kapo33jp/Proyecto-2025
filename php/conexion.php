<?php

$host = 'localhost';
$user = 'root';
$pass = ''; 
$db   = 'bdbarberia';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_errno) {
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    die("Error de conexión MySQL: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>
