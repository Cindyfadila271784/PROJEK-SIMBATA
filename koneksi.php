<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "kader_db";
$port = 8111; 

$conn = new mysqli($host, $user, $pass, $db, $port);


if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>