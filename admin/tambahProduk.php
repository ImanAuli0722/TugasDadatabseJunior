<?php
include "../config/koneksi.php";

if(isset($_POST['simpan'])){

$nama = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$deskripsi = $_POST['deskripsi'];
$gambar = $_FILES['gambar']['name'];

move_uploaded_file($_FILES['gambar']['tmp_name'],"../assets/img/".$gambar);

mysqli_query($conn,"INSERT INTO produk
VALUES(NULL,'$nama','$harga','$stok','$gambar','$deskripsi')");

header("location:dashboard.php");

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Produk</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<h3>Tambah Produk</h3>

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label>Nama Produk</label>
<input type="text" name="nama_produk" class="form-control">
</div>

<div class="mb-3">
<label>Harga</label>
<input type="number" name="harga" class="form-control">
</div>

<div class="mb-3">
<label>Stok</label>
<input type="number" name="stok" class="form-control">
</div>

<div class="mb-3">
<label>Deskripsi</label>
<textarea name="deskripsi" class="form-control"></textarea>
</div>

<div class="mb-3">
<label>Gambar</label>
<input type="file" name="gambar" class="form-control">
</div>

<button type="submit" name="simpan" class="btn btn-success">
Simpan
</button>

<a href="dashboard.php" class="btn btn-secondary">
Kembali
</a>

</form>

</div>

</body>
</html>