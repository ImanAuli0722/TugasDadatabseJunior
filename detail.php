<?php
include "config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM buku WHERE id_buku='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html>
<head>

<title>Detail Buku</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

body{
background:#f5f6fa;
}

.book-img{
height:300px;
object-fit:cover;
}

</style>

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-dark bg-dark">

<div class="container">

<a class="navbar-brand" href="index.php">
<i class="fa fa-book"></i> PERPUSTAKAAN
</a>

</div>

</nav>

<!-- DETAIL BUKU -->

<div class="container mt-5">

<div class="row">

<div class="col-md-4">

<img src="assets/img/buku.png" class="img-fluid book-img">

</div>

<div class="col-md-8">

<h3><?php echo $d['judul']; ?></h3>

<hr>

<p><b>Penulis :</b> <?php echo $d['penulis']; ?></p>

<p><b>Tahun Terbit :</b> <?php echo $d['tahun_terbit']; ?></p>

<p><b>Stok Buku :</b> <?php echo $d['stok']; ?></p>

<hr>

<?php if($d['stok'] > 0){ ?>

<a href="pinjam.php?id=<?php echo $d['id_buku']; ?>" class="btn btn-success">
<i class="fa fa-book"></i> Pinjam Buku
</a>

<?php }else{ ?>

<button class="btn btn-secondary" disabled>
Stok Habis
</button>

<?php } ?>

<a href="index.php" class="btn btn-danger">
<i class="fa fa-arrow-left"></i> Kembali
</a>

</div>

</div>

</div>

<!-- FOOTER -->

<footer class="bg-dark text-white text-center p-3 mt-5">

<p class="mb-0">
© <?php echo date("Y"); ?> Perpustakaan Online
</p>

</footer>

</body>
</html>