<?php
include "config/koneksi.php";

if(isset($_POST['register'])){

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cek = mysqli_query($conn,"SELECT * FROM user WHERE email='$email'");

    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Email sudah terdaftar');</script>";
    }else{

        mysqli_query($conn,"INSERT INTO user(nama,email,password)
        VALUES('$nama','$email','$password')");

        echo "<script>
        alert('Registrasi berhasil');
        window.location='login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-4">

<div class="card">

<div class="card-header text-center">
<h4>Register User</h4>
</div>

<div class="card-body">

<form method="POST">

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

<button type="submit" name="register" class="btn btn-success w-100">
Register
</button>

</form>

</div>

<div class="card-footer text-center">
Sudah punya akun? <a href="login.php">Login</a>
</div>

</div>

</div>

</div>

</div>

</body>
</html>