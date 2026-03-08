<?php
include "config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM produk WHERE id='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html>
<head>
<title>Detail Produk</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<div class="row">

<div class="col-md-5">
<img src="assets/img/<?php echo $d['gambar']; ?>" class="img-fluid">
</div>

<div class="col-md-7">

<h3><?php echo $d['nama_produk']; ?></h3>

<h4 class="text-danger">
Rp <?php echo number_format($d['harga']); ?>
</h4>

<p>
<?php echo $d['deskripsi']; ?>
</p>

<a href="keranjang.php?id=<?php echo $d['id']; ?>" class="btn btn-success">
Tambah ke Keranjang
</a>

<a href="produk.php" class="btn btn-secondary">
Kembali
</a>

</div>

</div>

</div>

</body>
</html>