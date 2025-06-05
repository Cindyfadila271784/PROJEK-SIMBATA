<?php
include 'koneksi.php';

$nama = $_POST['nama'];
$umur = $_POST['umur'];
$bb   = $_POST['bb'];
$tb   = $_POST['tb'];
$lk   = $_POST['lk'];
$jk   = $_POST['jk'];
$tp   = $_POST['tp'];

$sql = "INSERT INTO rekap_bayi (nama, umur, bb, tb, lk, jk, tp) 
        VALUES ('$nama', '$umur', '$bb', '$tb', '$lk', '$jk', '$tp')";

if ($conn->query($sql) === TRUE) {
    echo "sukses";
} else {
    echo "gagal: " . $conn->error;
}
?>