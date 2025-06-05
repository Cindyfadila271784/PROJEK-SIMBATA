<?php
include 'koneksi.php';
session_start();

// Simpan dan update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $bb = $_POST['bb'];
    $tb = $_POST['tb'];
    $lk = $_POST['lk'];
    $jk = $_POST['jk'];
    $tp = $_POST['tp'];
    $posyandu = $_SESSION['posyandu'];
    
    

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "UPDATE data_bayi SET nama='$nama', umur='$umur', bb='$bb', tb='$tb', lk='$lk', jk='$jk', tp='$tp', posyandu='$posyandu' WHERE id=$id";
    } else {
        $sql = "INSERT INTO data_bayi (nama, umur, bb, tb, lk, jk, tp, posyandu) 
                VALUES ('$nama', '$umur', '$bb', '$tb', '$lk', '$jk', '$tp', '$posyandu')";
    }

    if ($conn->query($sql)) {
        echo "<script>alert('Data berhasil disimpan!');window.location='data_bayi.php';</script>";
    } else {
        echo "Error saat menyimpan data: " . $conn->error;
    }
}

// Edit data
$dataEdit = null;
if (isset($_GET['edit'])) {
    $id_edit = $_GET['edit'];
    $result = $conn->query("SELECT * FROM data_bayi WHERE id = $id_edit");
    if ($result->num_rows > 0) {
        $dataEdit = $result->fetch_assoc();
    }
}

// Hapus data
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    $conn->query("DELETE FROM data_bayi WHERE id = $id_hapus");
    header("Location: data_bayi.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Penimbangan Bayi</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">
</head>
<body class="bg-light">

<!-- Menu -->
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">Menu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="tambah_ortuu.php">Tambah Orang tua</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="tambah_bayii.php">Tambah Bayi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="data_bayi.php">Rekap Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="imunisasi.php">Data Imunisasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Home_admin.php">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 mb-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Form Penimbangan Bayi</h5>
        </div>
        <div class="card-body">
            <form method="post">
                <?php if ($dataEdit): ?>
                    <input type="hidden" name="id" value="<?= $dataEdit['id'] ?>">
                <?php endif; ?>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Nama Bayi</label>
                        <input type="text" name="nama" value="<?= $dataEdit['nama'] ?? '' ?>" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Umur (bulan)</label>
                        <input type="text" name="umur" value="<?= $dataEdit['umur'] ?? '' ?>" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Berat Badan (kg)</label>
                        <input type="text" name="bb" value="<?= $dataEdit['bb'] ?? '' ?>" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Tinggi Badan (cm)</label>
                        <input type="text" name="tb" value="<?= $dataEdit['tb'] ?? '' ?>" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Lingkar Kepala (cm)</label>
                        <input type="text" name="lk" value="<?= $dataEdit['lk'] ?? '' ?>" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jk" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" <?= ($dataEdit['jk'] ?? '') === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= ($dataEdit['jk'] ?? '') === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Tanggal Periksa</label>
                        <input type="date" name="tp" value="<?= $dataEdit['tp'] ?? '' ?>" class="form-control" required>
                    </div>
                </div>
                <div class="mt-3 text-end">
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mt-5">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Rekap Data Penimbangan</h5>
        </div>
        <div class="card-body">
            <table id="rekapTable" class="table table-bordered table-striped nowrap w-100">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>BB</th>
                        <th>TB</th>
                        <th>LK</th>
                        <th>JK</th>
                        <th>Tanggal Periksa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <!-- Data -->
                <?php
                $no = 1;
                $posyandu = $_SESSION['posyandu'] ?? '';
                $data = $conn->query("SELECT * FROM data_bayi WHERE posyandu = '$posyandu' ORDER BY id DESC");
                while ($row = $data->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['umur'] ?></td>
                    <td><?= $row['bb'] ?></td>
                    <td><?= $row['tb'] ?></td>
                    <td><?= $row['lk'] ?></td>
                    <td><?= $row['jk'] ?></td>
                    <td><?= $row['tp'] ?></td>
                    <td>
                        <a href="?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="?hapus=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#rekapTable').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });
    });
</script>
</body>
</html>