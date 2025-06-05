<?php
include 'koneksi.php';

// Simpan data baru atau update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $nama = $conn->real_escape_string($_POST['nama']);
    $imunisasi = $conn->real_escape_string($_POST['imunisasi']);
    $bulan = $conn->real_escape_string($_POST['bulan']);
    $keterangan = $conn->real_escape_string($_POST['keterangan']);

    if ($id) {
        // Update data
        $conn->query("UPDATE imunisasi SET nama='$nama', imunisasi='$imunisasi', bulan='$bulan', keterangan='$keterangan' WHERE id='$id'");
    } else {
        // Insert data baru
        $conn->query("INSERT INTO imunisasi (nama, imunisasi, bulan, keterangan) VALUES ('$nama', '$imunisasi', '$bulan', '$keterangan')");
    }
    header("Location: imunisasi.php");
    exit;
}

// Hapus data
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $conn->query("DELETE FROM imunisasi WHERE id='$id'");
    header("Location: imunisasi.php");
    exit;
}

$data = $conn->query("SELECT * FROM imunisasi ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Imunisasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <style>
        .sidebar .btn {
            font-size: 14px;
            margin-bottom: 10px;
        }
        .form-card {
            background-color: #eaf6ea;
        }
    </style>
</head>
<body>
<div class="container-fluid mt-3">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <div class="card">
                <div class="card-header bg-dark text-white text-center">Menu</div>
                <div class="card-body">
                    <a href="tambah_ortuu.php" class="btn btn-outline-primary w-100">Tambah Ortu</a>
                    <a href="tambah_bayii.php" class="btn btn-outline-primary w-100">Tambah Bayi</a>
                    <a href="data_bayi.php" class="btn btn-outline-primary w-100">Rekap Data</a>
                    <a href="imunisasi.php" class="btn btn-outline-primary w-100">Imunisasi</a>
                    <a href="Home_admin.php" class="btn btn-outline-success w-100">Home</a>
                    <a href="logout.php" class="btn btn-outline-danger w-100">Logout</a>
                </div>
            </div>
        </div>

        <!-- Konten -->
        <div class="col-md-10">
            <!-- Form Input -->
            <div class="card mb-3 form-card">
                <div class="card-header bg-success text-white">Form Imunisasi</div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="id" id="formId">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" id="formNama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status Imunisasi</label>
                            <select name="imunisasi" id="formImunisasi" class="form-select" required>
                                <option value="">Pilih...</option>
                                <option value="SUDAH">SUDAH</option>
                                <option value="BELUM">BELUM</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bulan</label>
                            <input type="text" name="bulan" id="formBulan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="formKeterangan" class="form-control" rows="2"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>

            <!-- Tabel Imunisasi -->
            <div class="card">
                <div class="card-header bg-secondary text-white">Data Imunisasi</div>
                <div class="card-body">
                    <table id="tabelImunisasi" class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Bulan</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; while($row = $data->fetch_assoc()): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= htmlspecialchars($row['imunisasi']) ?></td>
                                <td><?= htmlspecialchars($row['bulan']) ?></td>
                                <td><?= htmlspecialchars($row['keterangan']) ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm editBtn" 
                                        data-id="<?= $row['id'] ?>" 
                                        data-nama="<?= htmlspecialchars($row['nama']) ?>" 
                                        data-imunisasi="<?= htmlspecialchars($row['imunisasi']) ?>" 
                                        data-bulan="<?= htmlspecialchars($row['bulan']) ?>" 
                                        data-keterangan="<?= htmlspecialchars($row['keterangan']) ?>">
                                        Edit
                                    </button>
                                    <a href="imunisasi.php?delete_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
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

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabelImunisasi').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan MENU data",
                zeroRecords: "Data tidak ditemukan",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "→",
                    previous: "←"
                }
            }
        });

        // Set data untuk form edit
        document.querySelectorAll('.editBtn').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('formId').value = this.dataset.id;
                document.getElementById('formNama').value = this.dataset.nama;
                document.getElementById('formImunisasi').value = this.dataset.imunisasi;
                document.getElementById('formBulan').value = this.dataset.bulan;
                document.getElementById('formKeterangan').value = this.dataset.keterangan;
            });
        });
    });
</script>
</body>
</html>