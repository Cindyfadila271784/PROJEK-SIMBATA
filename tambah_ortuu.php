<?php
include 'koneksi.php';

// Tambah data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $conn->real_escape_string($_POST['nama']);
    $alamat = $conn->real_escape_string($_POST['alamat']);
    $no_hp = $conn->real_escape_string($_POST['no_hp']);

    if (isset($_POST['id'])) {
        $id = (int) $_POST['id'];
        $conn->query("UPDATE orang_tuaa SET nama='$nama', alamat='$alamat', no_hp='$no_hp' WHERE id=$id");
    } else {
        $conn->query("INSERT INTO orang_tuaa (nama, alamat, no_hp) VALUES ('$nama', '$alamat', '$no_hp')");
    }

    header("Location: tambah_ortuu.php");
    exit;
}

// Ambil data untuk diedit
$editData = null;
if (isset($_GET['id_edit'])) {
    $id_edit = (int) $_GET['id_edit'];
    $result = $conn->query("SELECT * FROM orang_tuaa WHERE id = $id_edit");
    if ($result->num_rows > 0) {
        $editData = $result->fetch_assoc();
    }
}

// Hapus data
if (isset($_GET['id_hapus'])) {
    $id_hapus = (int) $_GET['id_hapus'];
    $conn->query("DELETE FROM orang_tuaa WHERE id = $id_hapus");
    header("Location: tambah_ortuu.php");
    exit;
}

// Ambil semua data orang tua
$data = $conn->query("SELECT * FROM orang_tuaa ORDER BY id DESC");
if (!$data) {
    die("Query gagal: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Orang Tua</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar .btn {
            font-size: 14px;
            margin-bottom: 10px;
        }
        .form-card {
            background-color:rgb(186, 255, 193); 
        }
    </style>
</head>
<body>
<div class="container mt-3">
    <div class="row">
        <!-- Sidebar Kiri -->
        <div class="col-md-2 sidebar">
            <div class="card">
                <div class="card-header bg-dark text-white text-center">Menu</div>
                <div class="card-body">
                    <a href="tambah_ortuu.php" class="btn btn-outline-primary w-100">Tambah Ortu</a>
                    <a href="tambah_bayii.php" class="btn btn-outline-primary w-100">Tambah Bayi</a>
                    <a href="data_bayi.php" class="btn btn-outline-primary w-100">Rekap Data</a>
                    <a href="imunisasi.php" class="btn btn-outline-primary w-100">Data Imunisasi</a>
                    <a href="Home_admin.php" class="btn btn-outline-success w-100">Home</a>
                    <a href="logout.php" class="btn btn-outline-danger w-100">Logout</a>
                </div>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="col-md-10">
            <!-- FORM ORTU -->
            <div class="card mb-2 form-card">
                <div class="card-header bg-success text-white">Form Tambah Orang Tua</div>
                <div class="card-body">
                    <form method="POST">
                        <?php if ($editData): ?>
                            <input type="hidden" name="id" value="<?= $editData['id'] ?>">
                        <?php endif; ?>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?= $editData['nama'] ?? '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="<?= $editData['alamat'] ?? '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No. HP</label>
                            <input type="text" name="no_hp" class="form-control" value="<?= $editData['no_hp'] ?? '' ?>" required>
                        </div>
                        <button type="submit" class="btn btn-success"><?= $editData ? 'Update' : 'Simpan' ?></button>
                    </form>
                </div>
            </div>

            <!-- TABEL DATA -->
            <div class="card">
                <div class="card-header bg-success text-white">Data Orang Tua</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No. HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; while ($row = $data->fetch_assoc()): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= htmlspecialchars($row['alamat']) ?></td>
                                <td><?= htmlspecialchars($row['no_hp']) ?></td>
                                <td>
                                    <a href="?id_edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="?id_hapus=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>