<?php
session_start();

// Hapus semua session
session_unset();
session_destroy();

// Arahkan ke halaman login utama atau home
header("Location: Home.php");
exit;
?
