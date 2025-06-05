<?php
$koneksi = new mysqli("localhost", "root", "", "kader_db", 8111); 

$query = "SELECT MONTH(tp) AS bulan, COUNT(*) AS jumlah FROM data_bayi GROUP BY MONTH(tp)";
$result = $koneksi->query($query);

$bulanNama = [1=>'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
$labels = [];
$counts = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $bulanNama[(int)$row['bulan']];
    $counts[] = (int)$row['jumlah'];
}

echo json_encode([
    'labels' => $labels,
    'counts' => $counts
]);
?>