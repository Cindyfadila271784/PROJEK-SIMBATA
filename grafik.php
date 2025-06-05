<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "kader_db", 8111);
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data jumlah bayi per bulan berdasarkan tanggal periksa
$sql = "SELECT MONTH(tp) AS bulan, COUNT(*) AS jumlah 
        FROM data_bayi 
        GROUP BY MONTH(tp)";
$result = $conn->query($sql);

$bulan = [];
$jumlah = [];

$namaBulan = [
  1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April",
  5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus",
  9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember"
];

while ($row = $result->fetch_assoc()) {
  $bulan[] = $namaBulan[(int)$row['bulan']];
  $jumlah[] = (int)$row['jumlah'];
}

$conn->close();

// Hitung rata-rata
$total = array_sum($jumlah);
$jumlahBulan = count($jumlah);
$rataRata = $jumlahBulan > 0 ? round($total / $jumlahBulan, 2) : 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Grafik Jumlah Bayi per Bulan</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f0fdf4;
      padding: 30px;
    }

    .container {
      max-width: 800px;
      margin: auto;
      background: #ffffff;
      padding: 25px 40px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    h2 {
      text-align: center;
      margin-bottom: 10px;
      color: #2e7d32;
    }

    .rata-rata {
      text-align: center;
      font-weight: 600;
      color: #2e7d32;
      margin-bottom: 20px;
    }

    canvas {
      margin-top: 20px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Grafik Jumlah Bayi per Bulan</h2>
  <p class="rata-rata">Rata-rata jumlah bayi per bulan: <?php echo $rataRata; ?></p>
  <canvas id="grafikBayi" height="100"></canvas>
</div>

<script>
  const bulan = <?php echo json_encode($bulan); ?>;
  const jumlah = <?php echo json_encode($jumlah); ?>;
  const rataRata = <?php echo $rataRata; ?>;

  const ctx = document.getElementById('grafikBayi').getContext('2d');
  const grafik = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: bulan,
      datasets: [
        {
          label: 'Jumlah Bayi',
          data: jumlah,
          backgroundColor: '#66bb6a',
          borderColor: '#388e3c',
          borderWidth: 1,
          borderRadius: 6
        },
        {
          type: 'line',
          label: 'Rata-rata',
          data: Array(jumlah.length).fill(rataRata),
          borderColor: '#ff7043',
          borderWidth: 2,
          borderDash: [5, 5],
          pointRadius: 0
        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1,
            precision: 0
          },
          title: {
            display: true,
            text: 'Jumlah Bayi',
            color: '#333',
            font: {
              size: 14,
              weight: 'bold'
            }
          }
        },
        x: {
          title: {
            display: true,
            text: 'Bulan',
            color: '#333',
            font: {
              size: 14,
              weight: 'bold'
            }
          }
        }
      },
      plugins: {
        legend: {
          display: true
        },
        tooltip: {
          backgroundColor: '#2e7d32',
          titleColor: '#fff',
          bodyColor: '#fff'
        }
      }
    }
  });
</script>

</body>
</html>