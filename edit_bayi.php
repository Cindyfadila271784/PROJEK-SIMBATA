<?php
include 'koneksi.php';

// ambil data berdasarkan ID
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM bayi WHERE id=$id")->fetch_assoc();

// ambil list orang tua
$ortuList = $conn->query("SELECT * FROM orang_tua");

// mengupdate data jika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_orang_tua = $_POST['id_orang_tua'];

    $conn->query("UPDATE bayi SET nama='$nama', tanggal_lahir='$tanggal_lahir', id_orang_tua='$id_orang_tua' WHERE id=$id");
    header("Location: tambah_bayi.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Bayi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h3>Edit Data Bayi</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Orang Tua</label>
            <select name="id_orang_tua" class="form-control" required>
                <?php while($ortu = $ortuList->fetch_assoc()): ?>
                    <option value="<?= $ortu['id'] ?>" <?= $ortu['id'] == $data['id_orang_tua'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($ortu['nama']) ?>
                    </option>
                <?php endwhile ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="tambah_bayi.php" class="btn btn-secondary">Batal</a>
    </form>
</body>
</html>