<?php
include 'koneksi.php';

$id = $_GET['id'];
$conn->query("DELETE FROM bayi WHERE id=$id");

header("Location: tambah_bayii.php");
exit;
?>