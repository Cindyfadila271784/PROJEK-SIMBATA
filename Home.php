<?php
session_start();

// Redirect ke halaman sesuai role jika sudah login
if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: home_admin.php");
        exit;
    } elseif ($_SESSION['role'] === 'ortu') {
        header("Location: home_ortu.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Posyandu Website</title>
  <link rel="stylesheet" href="css/style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Roboto', sans-serif;
    }

    body {
      background-color: #fdfeff;
      color: #ffffff;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 60px;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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

    .navbar nav ul {
      list-style: none;
      display: flex;
      gap: 30px;
    }

    .navbar nav ul li a {
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }

    .btn-login {
      padding: 10px 20px;
      background-color:rgb(42, 185, 118);
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      font-weight: 500;
    }

    .hero {
      position: relative;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 80px 60px;
      background: url('4.jpg') no-repeat center center/cover;
      background-attachment: fixed;
      height: 100vh;
      color: white;
    }

    .hero::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background-color: rgba(0, 0, 0, 0.4);
      z-index: 1;
    }

    .hero-text {
      max-width: 50%;
      position: relative;
      z-index: 2;
    }

    .hero-text h1 {
      font-size: 40px;
      line-height: 1.4;
      margin-bottom: 20px;
    }

    .hero-text .highlight {
      color:rgb(35, 243, 139);
    }

    .hero-text p {
      margin-bottom: 30px;
      color: #ddd;
    }

    .btn-appointment {
      padding: 12px 25px;
      background-color:#DCEBCA;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      font-weight: 500;
    }

    .hero-img {
      z-index: 2;
      position: relative;
    }

    .hero-img img {
      max-width: 450px;
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
      <li><a href="about-home.php" style="text-decoration: none; color: white; font-weight: 500;">Layanan Kami</a></li>
      <li><a href="index-FAQ.html" style="text-decoration: none; color: white; font-weight: 500;">FAQ</a></li>
    </ul>
  </nav>
  <a href="#" onclick="showLoginOptions()" style="padding: 10px 20px; background-color: #DCEBCA; color: white; text-decoration: none; border-radius: 5px; font-weight: 500;">Login</a>
</header>

<!-- Modal Login -->
<div id="loginModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5); z-index: 999;">
  <div style="background:white; padding:30px; border-radius:10px; width:300px; margin:100px auto; text-align:center; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
    <h4 style="margin-bottom: 20px;">Pilih Login</h4>
    <a href="login_admin.php" style="display:block; margin-bottom:10px; background-color:#2e2ab9; color:white; padding:10px; border-radius:5px; text-decoration:none;">Login Admin</a>
    <a href="login_ortu.php" style="display:block; margin-bottom:15px; background-color:#28a745; color:white; padding:10px; border-radius:5px; text-decoration:none;">Login Orang Tua</a>
    <button onclick="hideLoginOptions()" style="background-color: #ccc; padding: 8px 15px; border: none; border-radius: 5px;">Batal</button>
  </div>
</div>

<script>
  function showLoginOptions() {
    document.getElementById('loginModal').style.display = 'block';
  }

  function hideLoginOptions() {
    document.getElementById('loginModal').style.display = 'none';
  }
</script>

  <section class="hero">
    <div class="hero-text">
      <h1>ANAK SEHAT <span style="color: #B5C99A;">BANGSA KUAT</span><br>MULAI DARI <span style="color: #B5C99A;">DATA YANG AKURAT</span></h1>
      <p>Kesehatan Anak Adalah Investasi Masa Depan dan Data Yang Akurat Adalah Pondasi Untuk Membuat Keputusan Yang Tepat.</p>
      <a href="#" class="btn-appointment">Sehat Bersama Posyandu</a>
    </div>
  </section>

  <!-- Modal Pilihan Login -->
  <div id="loginModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5); z-index: 1000;">
    <div style="background:white; padding:30px; border-radius:8px; width:300px; margin:100px auto; text-align:center; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
      <h4>Pilih Login</h4>
      <a href="login_admin.php" class="btn-login" style="background-color:#2e2ab9; margin-top:15px; display:block;">Login Admin</a>
      <a href="login_ortu.php" class="btn-login" style="background-color:#28a745; margin-top:10px; display:block;">Login Orang Tua</a>
      <br>
      <button onclick="hideLoginOptions()" style="margin-top:15px;">Batal</button>
    </div>
  </div>

  <script>
    function showLoginOptions() {
      document.getElementById('loginModal').style.display = 'block';
    }

    function hideLoginOptions() {
      document.getElementById('loginModal').style.display = 'none';
    }
  </script>

</body>
</html>