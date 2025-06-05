<?php
$events = [
    [
        'title' => 'Pemberian imunisasi dasar sesuai jadwal',
        'image' => 'suntik.jpg'
    ],
    [
        'title' => 'Mengukur Tb dan Lk',
        'image' => 'tinggi.jpg'
    ],
    [
        'title' => 'Menimbang berat badan balita',
        'image' => 'menimbang.jpg'
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Beranda - Posyandu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #eaf7ef;
            color: #333;
        }

        /* Navbar */
        header {
            background-color: #e0f3e9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .logo span {
            font-weight: bold;
            color: #2e7d32;
            font-size: 1.5rem;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 1.5rem;
        }

        nav ul li a {
            text-decoration: none;
            color: #2e7d32;
            font-size: 1rem;
            font-weight: bold;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        .btn-logout {
            background-color: #43a047;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            color: white;
            text-decoration: none;
        }

        .btn-logout:hover {
            background-color: #B5C99A;
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 2.5rem auto 3rem;
            padding: 0 1rem;
        }

        .main-content h2 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.25rem;
            color: #B5C99A;
            font-weight: 700;
        }

        .events {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
        }

        .event-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.08);
            overflow: hidden;
            width: 270px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15);
        }

        .event-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }

        .event-card-content {
            padding: 1rem 1rem 1.5rem;
            text-align: center;
        }

        .event-card-content h3 {
            font-size: 1.15rem;
            margin-bottom: 0.75rem;
            color: #2e7d32;
            font-weight: 700;
            min-height: 3rem;
        }

        /* Footer Section */
        .footer-section {
            max-width: 800px;
            margin: 4rem auto 2rem;
            padding: 0 1rem;
            text-align: center;
        }

        .footer-section h3 {
            font-size: 1.8rem;
            color: #2e7d32;
            margin-bottom: 0.5rem;
        }

        .footer-section hr {
            width: 60px;
            height: 4px;
            background-color: #2e7d32;
            border: none;
            margin: 0 auto 1rem;
        }

        .footer-section p {
            font-size: 1rem;
            color: #444;
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        @media (max-width: 600px) {
            .events {
                flex-direction: column;
                align-items: center;
            }
            .event-card {
                width: 90%;
                max-width: 350px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="img/logo.png" alt="Logo Posyandu" />
        <span>Posyandu</span>
    </div>
    <nav>
        <ul>
            <li><a href="#">About</a></li>
            <li><a href="tambah_ortuu.php">Tambah Data</a></li>
            <li><a href="grafik.php">Grafik</a></li>
            <li><a href="faq.php">FAQs</a></li>
        </ul>
    </nav>
    <a href="logout.php" class="btn-logout">Logout</a>
</header>

<div class="main-content">
    <h2>Layanan Kami</h2>
    <div class="events">
        <?php foreach ($events as $event): ?>
            <div class="event-card">
                <img src="<?= htmlspecialchars($event['image']); ?>" alt="<?= htmlspecialchars($event['title']); ?>" />
                <div class="event-card-content">
                    <h3><?= htmlspecialchars($event['title']); ?></h3>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="footer-section">
        <h3>Tentang SIMBATA</h3>
        <hr />
        <p>
            <strong>SIMBATA</strong> (Sistem Informasi Bayi dan Balita) adalah sistem digital yang dirancang untuk membantu pencatatan, pemantauan, dan evaluasi tumbuh kembang bayi dan balita. Fokus utama sistem ini adalah kesehatan, gizi, dan imunisasi.
        </p>
        <p>
            Tujuan utama SIMBATA adalah mempermudah tenaga kesehatan dan orang tua dalam mengakses informasi penting tentang perkembangan anak secara <em>real-time</em>, akurat, dan efisien.
        </p>
    </div>
</div>

</body>
</html>