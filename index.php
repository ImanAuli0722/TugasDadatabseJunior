<?php
session_start();
include "config/koneksi.php";

$keyword = "";

if(isset($_GET['search'])){
    $keyword = $_GET['search'];
    $data = mysqli_query($conn,"SELECT * FROM buku 
    WHERE judul LIKE '%$keyword%' 
    OR penulis LIKE '%$keyword%'");
}else{
    $data = mysqli_query($conn,"SELECT * FROM buku");
}

$total_buku = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM buku"));
?>

<!DOCTYPE html>
<html>
<head>

<title>Perpustakaan Online</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
font-family: 'Segoe UI', sans-serif;
}

.navbar-brand{
font-weight:bold;
}

.hero{
background:linear-gradient(135deg,#2c3e50,#34495e);
color:white;
padding:60px 20px;
}

.hero h2{
font-weight:bold;
}

.book-card{
border:none;
border-radius:12px;
overflow:hidden;
transition:0.3s;
}

.book-card:hover{
transform:translateY(-5px);
box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

.book-img{
height:200px;
object-fit:cover;
}

.card-title{
font-weight:600;
}

.footer{
background:#2c3e50;
}

</style>

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

<div class="container">

<a class="navbar-brand" href="index.php">
<i class="fa fa-book"></i> Perpustakaan
</a>

<form class="d-flex" method="GET">

<input class="form-control me-2" type="search" name="search"
placeholder="Cari buku..." value="<?php echo $keyword; ?>">

<button class="btn btn-warning">
<i class="fa fa-search"></i>
</button>

</form>

<a href="login.php" class="btn btn-light">
<i class="fa fa-user"></i> Login
</a>

</div>

</nav>


<!-- HERO -->

<div class="hero text-center">

<div class="container">

<h2>📚 Sistem Perpustakaan Online</h2>

<p class="mt-3">
Temukan berbagai koleksi buku terbaik dan tingkatkan pengetahuan Anda
</p>

<p class="mt-3">
Total Buku Tersedia : 
<b><?php echo $total_buku; ?></b>
</p>

</div>

</div>


<!-- DAFTAR BUKU -->

<div class="container mt-5">

<h4 class="mb-4">
<i class="fa fa-book"></i> Daftar Buku
</h4>

<div class="row">

<?php while($d = mysqli_fetch_array($data)){ ?>

<div class="col-md-3">

<div class="card book-card mb-4">

<img src="assets/img/<?php echo $d['gambar']; ?>" 
class="card-img-top book-img">

<div class="card-body text-center">

<h6 class="card-title">
<?php echo $d['judul']; ?>
</h6>

<p class="text-muted mb-1">
Penulis : <?php echo $d['penulis']; ?>
</p>

<p class="text-muted">
Tahun : <?php echo $d['tahun_terbit']; ?>
</p>

<?php if($d['stok'] > 0){ ?>
<span class="badge bg-success">
Stok : <?php echo $d['stok']; ?>
</span>
<?php }else{ ?>
<span class="badge bg-danger">
Stok Habis
</span>
<?php } ?>

<div class="mt-3">

<a href="detail.php?id=<?php echo $d['id_buku']; ?>" 
class="btn btn-primary btn-sm">

<i class="fa fa-book"></i> Detail

</a>

</div>

</div>

</div>

</div>

<?php } ?>

</div>

</div>


<!-- FOOTER -->

<footer class="footer text-white text-center p-4 mt-5">

<div class="container">

<p class="mb-1">
© <?php echo date("Y"); ?> Sistem Perpustakaan Online
</p>

<p class="small">
Dibuat dengan PHP & MySQL
</p>

</div>

</footer>

</body>
</html>