<?php
include 'koneksi.php';

// Proses Tambah / Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $conn->real_escape_string($_POST['nama']);
    $tanggal_lahir = $conn->real_escape_string($_POST['tgl_lahir']);
    $id_ortu = (int) $_POST['id_ortu'];

    if (isset($_POST['id'])) {
        $id = (int) $_POST['id'];
        $conn->query("UPDATE bayii SET nama='$nama', tanggal_lahir='$tanggal_lahir', id_orang_tuaa=$id_ortu WHERE id=$id");
    } else {
        $conn->query("INSERT INTO bayii (nama, tanggal_lahir, id_orang_tuaa) VALUES ('$nama', '$tanggal_lahir', $id_ortu)");
    }

    header("Location: tambah_bayi.php");
    exit;
}

// Ambil data untuk form edit
$editData = null;
if (isset($_GET['id_edit'])) {
    $id_edit = (int) $_GET['id_edit'];
    $result = $conn->query("SELECT * FROM bayii WHERE id = $id_edit");
    if ($result && $result->num_rows > 0) {
        $editData = $result->fetch_assoc();
    }
}

// Hapus data
if (isset($_GET['id_hapus'])) {
    $id_hapus = (int) $_GET['id_hapus'];
    $conn->query("DELETE FROM bayii WHERE id = $id_hapus");
    header("Location: tambah_bayi.php");
    exit;
}

// Ambil semua data
$data_bayi = $conn->query("SELECT bayii.id, bayii.nama, bayii.tanggal_lahir, orang_tuaa.nama AS nama_ortu 
                           FROM bayii 
                           JOIN orang_tuaa ON bayii.id_orang_tuaa = orang_tuaa.id 
                           ORDER BY bayii.id DESC");
$data_ortu = $conn->query("SELECT * FROM orang_tuaa");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Bayi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">Form Bayi</div>
        <div class="card-body">
            <form method="POST">
                <?php if ($editData): ?>
                    <input type="hidden" name="id" value="<?= $editData['id'] ?>">
                <?php endif; ?>
                <div class="mb-3">
                    <label class="form-label">Nama Bayi</label>
                    <input type="text" name="nama" class="form-control" value="<?= $editData['nama'] ?? '' ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" value="<?= $editData['tanggal_lahir'] ?? '' ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Orang Tua</label>
                    <select name="id_ortu" class="form-control" required>
                        <option value="">-- Pilih Orang Tua --</option>
                        <?php while ($ortu = $data_ortu->fetch_assoc()): ?>
                            <option value="<?= $ortu['id'] ?>" 
                                <?= isset($editData['id_orang_tuaa']) && $editData['id_orang_tuaa'] == $ortu['id'] ? 'selected' : '' ?>>
                                <?= $ortu['nama'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success"><?= $editData ? 'Update' : 'Simpan' ?></button>
            </form>
        </div>
    </div>

    <div class="card mt-4 mb-5">
        <div class="card-header bg-secondary text-white">Data Bayi</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Bayi</th>
                        <th>Tanggal Lahir</th>
                        <th>Orang Tua</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    if ($data_bayi && $data_bayi->num_rows > 0):
                        while ($row = $data_bayi->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['tanggal_lahir']) ?></td>
                            <td><?= htmlspecialchars($row['nama_ortu']) ?></td>
                            <td>
                                <a href="?id_edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?id_hapus=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile;
                    else: ?>
                        <tr><td colspan="5" class="text-center">Data bayi belum tersedia atau terjadi error query.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>