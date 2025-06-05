<?php
include 'koneksi.php';
$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $posyandu = $_POST['posyandu'];

    // Cek apakah email sudah digunakan
    $cek = $conn->query("SELECT * FROM pengguna WHERE email = '$email'");
    if ($cek->num_rows > 0) {
        $error = "Email sudah terdaftar.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO pengguna (nama, email, password, role, posyandu)
                VALUES ('$nama', '$email', '$hashed_password', 'ortu', '$posyandu')";
        if ($conn->query($sql) === TRUE) {
            $success = "Registrasi berhasil. Silakan login.";
        } else {
            $error = "Gagal registrasi: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Orang Tua</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h5>Registrasi Orang Tua</h5>
                </div>
                <div class="card-body">
                    <?php if ($success) echo "<div class='alert alert-success'>$success</div>"; ?>
                    <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Posyandu</label>
                            <input type="text" name="posyandu" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Daftar</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="login_ortu.php">Sudah punya akun? Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>