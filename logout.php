<?php
session_start();
session_unset();  // Menghapus semua variabel sesi
session_destroy(); // Mengakhiri sesi

header("Location: login_ortu.php"); // Arahkan ke halaman login ortu (bisa diganti ke halaman home jika perlu)
exit;
?>