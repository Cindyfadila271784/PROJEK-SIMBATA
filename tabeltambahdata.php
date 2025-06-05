<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Login dulu sebagai admin!'); window.location='login-admin.html';</script>";
    exit;
}

include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Rekap Bayi</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>

<div class="container mt-4">
  <h3 class="mb-4 text-white bg-success p-3 rounded">Data Rekap Bayi</h3>

  <a href="tambahdata-admin.php" class="btn btn-primary mb-3">Tambah Data</a>

  <table id="rekapTable" class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Umur</th>
        <th>Berat Badan</th>
        <th>Tinggi Badan</th>
        <th>Lingkar Kepala</th>
        <th>Jenis Kelamin</th>
        <th>Tanggal Periksa</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM rekap_bayi";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>{$row['id']}</td>
                  <td>{$row['nama']}</td>
                  <td>{$row['umur']}</td>
                  <td>{$row['bb']}</td>
                  <td>{$row['tb']}</td>
                  <td>{$row['lk']}</td>
                  <td>{$row['jk']}</td>
                  <td>{$row['tp']}</td>
                </tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
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