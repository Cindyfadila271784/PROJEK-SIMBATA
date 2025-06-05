<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'ortu') {
    header("Location: login_ortu.php");
    exit;
}

$posyandu_ortu = $_SESSION['posyandu'];
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
<body>
<div class="container">
    <div class="card shadow mt-5">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Rekap Data Penimbangan - : <?= htmlspecialchars($posyandu_ortu) ?></h5>
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
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $query = "SELECT * FROM data_bayi WHERE posyandu = ? ORDER BY id DESC";
                $stmt = $conn->prepare($query);
                if (!$stmt) {
                    die("Query error: " . $conn->error);
                }
                $stmt->bind_param("s", $posyandu_ortu);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()):
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= $row['umur'] ?></td>
                        <td><?= $row['bb'] ?></td>
                        <td><?= $row['tb'] ?></td>
                        <td><?= $row['lk'] ?></td>
                        <td><?= $row['jk'] ?></td>
                        <td><?= $row['tp'] ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>