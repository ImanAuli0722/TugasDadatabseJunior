<?php
include "../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM produk WHERE id='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){

$nama = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$deskripsi = $_POST['deskripsi'];

mysqli_query($conn,"UPDATE produk SET
nama_produk='$nama',
harga='$harga',
stok='$stok',
deskripsi='$deskripsi'
WHERE id='$id'");

header("location:dashboard.php");

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Produk</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<h3>Edit Produk</h3>

<form method="POST">

<div class="mb-3">
<label>Nama Produk</label>
<input type="text" name="nama_produk" class="form-control"
value="<?php echo $d['nama_produk']; ?>">
</div>

<div class="mb-3">
<label>Harga</label>
<input type="number" name="harga" class="form-control"
value="<?php echo $d['harga']; ?>">
</div>

<div class="mb-3">
<label>Stok</label>
<input type="number" name="stok" class="form-control"
value="<?php echo $d['stok']; ?>">
</div>

<div class="mb-3">
<label>Deskripsi</label>
<textarea name="deskripsi" class="form-control"><?php echo $d['deskripsi']; ?></textarea>
</div>

<button type="submit" name="update" class="btn btn-primary">
Update
</button>

<a href="produk.php" class="btn btn-secondary">
Kembali
</a>

</form>

</div>

</body>
</html>