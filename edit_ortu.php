<?php
include 'koneksi.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM orang_tua WHERE id = $id");
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $conn->real_escape_string($_POST['nama']);
    $conn->query("UPDATE orang_tua SET nama='$nama' WHERE id=$id");
    header("Location: tambah_ortu.php");
}
?>

<h3>Edit Data Orang Tua</h3>
<form method="POST">
    <div class="mb-3">
        <label>Nama Orang Tua</label>
        <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
</form>