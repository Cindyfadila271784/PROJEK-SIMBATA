<?php
$events = [
    ['title' => 'Pemberian imunisasi dasar sesuai jadwal', 'image' => 'suntik.jpg'],
    ['title' => 'Mengukur tinggi badan dan lingkar kepala', 'image' => 'tinggi.jpg'],
    ['title' => 'Menimbang berat badan balita', 'image' => 'menimbang.jpg']
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - SIMBATA</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0; padding: 0; box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    body {
      background-color: #f6f8f5;
      color: #333;
    }

    /* Navbar */
    header {
      background-color: #B5C99A;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .logo img {
      height: 40px;
      width: 40px;
      border-radius: 50%;
    }
    .logo span {
      font-size: 1.5rem;
      color: #fff;
      font-weight: 600;
    }

    nav ul {
      display: flex;
      gap: 20px;
      list-style: none;
    }
    nav ul li a {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
    }
    nav ul li a:hover {
      text-decoration: underline;
    }

    .btn-logout {
      background-color: #8DA878;
      color: white;
      padding: 8px 16px;
      border-radius: 5px;
      text-decoration: none;
      transition: background 0.3s ease;
    }
    .btn-logout:hover {
      background-color: #728f5e;
    }

    .main-content {
      max-width: 1100px;
      margin: 2rem auto;
      padding: 0 1rem;
    }

    .main-content h2 {
      text-align: center;
      color: #7a9450;
      font-size: 2.2rem;
      margin-bottom: 2rem;
    }

    .events {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
    }

    .event-card {
      background-color: #fff;
      width: 280px;
      border-radius: 12px;
      box-shadow: 0 6px 12px rgba(0,0,0,0.08);
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .event-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.12);
    }

    .event-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .event-card-content {
      padding: 1rem;
      text-align: center;
    }

    .event-card-content h3 {
      font-size: 1.1rem;
      color: #607e41;
      font-weight: 600;
    }

    .footer-section {
      text-align: center;
      margin-top: 4rem;
      padding: 2rem 1rem;
      background: #e8f1e2;
    }

    .footer-section h3 {
      color: #607e41;
      margin-bottom: 0.5rem;
      font-size: 1.7rem;
    }

    .footer-section hr {
      width: 60px;
      height: 4px;
      background-color: #87986A;
      border: none;
      margin: 0 auto 1rem;
    }

    .footer-section p {
      max-width: 800px;
      margin: 0.5rem auto;
      line-height: 1.7;
      font-size: 1rem;
      color: #555;
    }

    @media (max-width: 600px) {
      .events {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>

<header>
  <div class="logo">
    <img src="logo posyandu.jpg" alt="Logo Posyandu" />
    <span>SIMBATA</span>
  </div>
  <nav>
    <ul>
      <li><a href="Home_admin.php">Home</a></li>
      <li><a href="tambah_ortuu.php">Tambah Data</a></li>
      <li><a href="grafik.php">Grafik</a></li>
      <li><a href="faq-admin.html">FAQ</a></li>
       <li><a href="contact.html">Contack</a></li>

    </ul>
  </nav>
  <a href="logout.php" class="btn-logout">Logout</a>
</header>

<main class="main-content">
  <h2>Layanan Kami</h2>
  <div class="events">
    <?php foreach ($events as $event): ?>
      <div class="event-card">
        <img src="<?= htmlspecialchars($event['image']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" />
        <div class="event-card-content">
          <h3><?= htmlspecialchars($event['title']) ?></h3>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <section class="footer-section">
    <h3>Tentang SIMBATA</h3>
    <hr />
    <p><strong>SIMBATA</strong> (Sistem Informasi Bayi dan Balita) adalah sistem digital untuk mempermudah pencatatan dan pemantauan tumbuh kembang anak.</p>
    <p>Dengan SIMBATA, tenaga kesehatan dan orang tua bisa mengakses data penting anak secara <em>real-time</em>, akurat, dan efisien.</p>
  </section>
</main>

</body>
</html>