

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Data Bayi</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <h3 class="mb-4 text-white bg-primary p-3 rounded">Form Tambah Data Rekap Bayi</h3>

  <form action="proses-tambahdata.php" method="POST">
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" class="form-control" name="nama" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Umur</label>
      <input type="number" class="form-control" name="umur" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Berat Badan (kg)</label>
      <input type="number" step="0.1" class="form-control" name="bb" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Tinggi Badan (cm)</label>
      <input type="number" step="0.1" class="form-control" name="tb" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Lingkar Kepala (cm)</label>
      <input type="number" step="0.1" class="form-control" name="lk" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Jenis Kelamin</label>
      <select class="form-select" name="jk" required>
        <option value="">-- Pilih Jenis Kelamin --</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Tanggal Periksa</label>
      <input type="date" class="form-control" name="tp" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan Data</button>
    <a href="tabeltambahdata.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>