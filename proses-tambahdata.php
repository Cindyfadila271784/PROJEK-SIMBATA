<?php
include 'koneksi.php';

$nama = $_POST['nama'];
$umur = $_POST['umur'];
$bb = $_POST['bb'];
$tb = $_POST['tb'];
$lk = $_POST['lk'];
$jk = $_POST['jk'];
$tp = $_POST['tp'];

$sql = "INSERT INTO rekap_bayi (nama, umur, bb, tb, lk, jk, tp) 
        VALUES ('$nama', '$umur', '$bb', '$tb', '$lk', '$jk', '$tp')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data berhasil disimpan!'); window.location='tabeltambahdata.php';</script>";
} else {
    echo "<script>alert('Gagal menyimpan data: " . $conn->error . "'); window.history.back();</script>";
}

$conn->close();