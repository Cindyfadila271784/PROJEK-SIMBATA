<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $bb   = $_POST['bb'];
    $tb   = $_POST['tb'];
    $lk   = $_POST['lk'];
    $jk   = $_POST['jk'];
    $tp   = $_POST['tp'];

    $sql = "INSERT INTO rekap_bayi (nama, umur, bb, tb, lk, jk, tp) VALUES ('$nama', '$umur', '$bb', '$tb', '$lk', '$jk', '$tp')";
    if ($conn->query($sql) === TRUE) {
        header("Location: rekap.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>