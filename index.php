<?php
// Koneksi DB
$conn = new mysqli("localhost", "root", "", "kader_db");

// Fungsi Hitung IMT dan Status Gizi
function hitungIMT($berat, $tinggi) {
    $tinggi_m = $tinggi / 100;
    return round($berat / ($tinggi_m * $tinggi_m), 2);
}

function statusGizi($imt) {
    if ($imt < 14) return "Gizi Buruk";
    elseif ($imt < 17) return "Gizi Kurang";
    elseif ($imt < 19) return "Gizi Baik";
    elseif ($imt < 21) return "Gizi Lebih";
    else return "Obesitas";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $tgl = $_POST['tgl_lahir'];
    $berat = $_POST['berat'];
    $tinggi = $_POST['tinggi'];
    $imt = hitungIMT($berat, $tinggi);
    $status = statusGizi($imt);

    $conn->query("INSERT INTO anak (nama, tgl_lahir, berat, tinggi, imt, status_gizi)
                  VALUES ('$nama', '$tgl', $berat, $tinggi, $imt, '$status')");
    header("Location: index.php");
    exit();
}


$kategori = ['Gizi Buruk', 'Gizi Kurang', 'Gizi Baik', 'Gizi Lebih', 'Obesitas'];
$data_gizi = [];

foreach ($kategori as $k) {
    $q = $conn->query("SELECT COUNT(*) as jml FROM anak WHERE status_gizi = '$k'");
    $r = $q->fetch_assoc();
    $data_gizi[] = $r['jml'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>SIMBATA - Sistem Informasi Bayi dan Balita</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Arial; padding: 30px; }
        input, label { display: block; margin: 10px 0; }
        .form-box, .chart-box { margin-bottom: 40px; }
    </style>
</head>
<body>

<h2>Input Data Balita</h2>
<div class="form-box">
    <form method="POST">
        <label>Nama:</label>
        <input type="text" name="nama" required>

        <label>Tanggal Lahir:</label>
        <input type="date" name="tgl_lahir" required>

        <label>Berat Badan (kg):</label>
        <input type="number" step="0.1" name="berat" required>

        <label>Tinggi Badan (cm):</label>
        <input type="number" step="0.1" name="tinggi" required>

        <input type="submit" value="Simpan Data">
    </form>
</div>

<h2>Grafik Status Gizi Balita</h2>
<div class="chart-box">
    <canvas id="grafikGizi" width="600" height="400"></canvas>
</div>

<script>
const ctx = document.getElementById('grafikGizi').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Gizi Buruk', 'Gizi Kurang', 'Gizi Baik', 'Gizi Lebih', 'Obesitas'],
        datasets: [{
            label: 'Jumlah Anak',
            data: <?= json_encode($data_gizi) ?>,
            backgroundColor: ['#e74c3c', '#f39c12', '#2ecc71', '#3498db', '#9b59b6'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 },
                title: { display: true, text: 'Jumlah' }
            },
            x: {
                title: { display: true, text: 'Status Gizi' }
            }
        }
    }
});
</script>

</body>
</html>