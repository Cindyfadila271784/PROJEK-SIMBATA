<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password
    $role = 'admin';
    $posyandu = $_POST['posyandu'];

    
    $cek = mysqli_query($conn, "SELECT * FROM pengguna WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Email sudah digunakan.";
    } else {
        $sql = "INSERT INTO pengguna (nama, email, password, role, posyandu) 
                VALUES ('$nama', '$email', '$password', '$role', '$posyandu')";
        if (mysqli_query($conn, $sql)) {
            $success = "Admin berhasil didaftarkan!";
        } else {
            $error = "Gagal menyimpan data.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h4>Register Admin Posyandu</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php elseif (isset($success)): ?>
                    <div class="alert alert-success"><?= $success ?></div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label>Nama Lengkap</label>
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
                    <button type="submit" class="btn btn-primary w-100">Daftarkan Admin</button>
                    <a href="login_admin.php" class="btn btn-link w-100 mt-2">Kembali ke Login</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>