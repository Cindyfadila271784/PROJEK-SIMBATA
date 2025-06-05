<?php
session_start();

// Pastikan hanya admin yang bisa mengakses halaman ini
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: login_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Admin - Posyandu</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color:rgb(255, 255, 255);
    }

    /* Header / Navbar */
    header {
      background-color:rgb(239, 246, 239);
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
      color: white;
      font-size: 1.5rem;
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 1.5rem;
    }

    nav ul li {
      display: inline;
    }

    nav ul li a {
      text-decoration: none;
      color: black;
      font-size: 1rem;
      font-weight: bold;
    }

    nav ul li a:hover {
      text-decoration: underline;
    }

    .btn-logout {
      background-color: #f44336;
      padding: 0.5rem 1rem;
      border-radius: 5px;
      color: white;
      text-decoration: none;
    }

    .btn-logout:hover {
      background-color:rgb(234, 216, 216);
    }

    /* Hero Section */
    .hero {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 3rem 2rem;
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('4.jpg') no-repeat center center/cover;
      color: white;
      height: calc(100vh - 80px);
    }

    .hero-text {
      max-width: 50%;
    }

    .hero-text h1 {
      font-size: 2.5rem;
      margin-bottom: 1rem;
    }

    .hero-text p {
      margin-bottom: 1.5rem;
      color: #ddd;
    }

    .btn-appointment {
      padding: 12px 25px;
      background-color: #DCEBCA ;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }

    .btn-appointment:hover {
      background-color: #cfebfd;
    }

    .hero-img img {
      max-width: 400px;
      height: auto;
    }
  </style>
</head>
<body>

 <header class="navbar" style="display: flex; justify-content: space-between; align-items: center; padding: 10px 30px; background-color: #B5C99A; color: white;">
  <div class="logo" style="display: flex; align-items: center;">
    <img src="logo posyandu.jpg" alt="Logo" style="height: 40px; margin-right: 10px;">
    <span style="font-size: 22px; font-weight: bold;">SIMBATA</span>
  </div>
  <nav>
    <ul style="list-style: none; display: flex; gap: 30px; margin: 0; padding: 0;">
      <li><a href="about.php" style="text-decoration: none; color: white; font-weight: 500;">About</a></li>
      <li><a href="tambah_ortuu.php" style="text-decoration: none; color: white; font-weight: 500;">Tambah Data</a></li>
      <li><a href="grafik.php" style="text-decoration: none; color: white; font-weight: 500;">Grafik</a></li>
      <li><a href="faq-admin.html" style="text-decoration: none; color: white; font-weight: 500;">FAQ</a></li>
      <li><a href="contact.html" style="text-decoration: none; color: white; font-weight: 500;">Contact</a></li>
    </ul>
  </nav>
  <a href="logout.php" style="padding: 10px 20px; background-color: #DCEBCA; color: white; text-decoration: none; border-radius: 5px; font-weight: 500;">Logout</a>
</header>
  

  <section class="hero">
    <div class="hero-text">
      <h1>Selamat Datang, <span style="color: #B5C99A;">Admin</span><br>di Website <span style="color: #B5C99A;">Posyandu</span></h1>
      <p>Gunakan menu di atas untuk mengelola data orang tua, bayi, dan data posyandu.</p>
      <a href="tambah_ortu.php" class="btn-appointment">Kelola Data</a>
    </div>
  </section>

</body>
</html>