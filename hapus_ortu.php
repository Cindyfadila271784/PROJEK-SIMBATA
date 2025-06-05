<?php
include 'koneksi.php';
$id = $_GET['id'];
$conn->query("DELETE FROM orang_tua WHERE id = $id");
header("Location: tambah_ortuu.php");
?>