<?php
session_start();
include "../config/koneksi.php";

if(!isset($_SESSION['user_id'])){
    header("location:../login.php");
    exit();
}

/* =========================
   STATISTIK
========================= */

$total_buku = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM buku"));
$total_anggota = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM anggota"));
$total_peminjaman = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM peminjaman"));

$buku_dipinjam = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as total 
FROM peminjaman
"));

/* =========================
   DATA GRAFIK PEMINJAMAN
========================= */

$grafik = mysqli_query($conn,"
SELECT MONTH(tanggal_pinjam) as bulan, COUNT(*) as total
FROM peminjaman
GROUP BY MONTH(tanggal_pinjam)
");

$bulan = [];
$total = [];

while($g = mysqli_fetch_assoc($grafik)){
    $bulan[] = $g['bulan'];
    $total[] = $g['total'];
}

/* =========================
   PEMINJAMAN TERBARU
========================= */

$peminjaman = mysqli_query($conn,"
SELECT p.id_peminjam,p.id_anggota,p.id_buku,p.tanggal_pinjam,p.tanggal_kembali,   a.nama, b.judul
FROM peminjaman p
JOIN anggota a ON p.id_anggota = a.id_anggota
JOIN buku b ON p.id_buku = b.id_buku
ORDER BY p.id_peminjam DESC
LIMIT 5
");

?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
background:#f4f6f9;
}

.sidebar{
height:100vh;
background:#2f3640;
color:white;
position:fixed;
width:230px;
}

.sidebar h4{
text-align:center;
padding:20px;
border-bottom:1px solid #444;
}

.sidebar a{
display:block;
color:white;
padding:14px 20px;
text-decoration:none;
}

.sidebar a:hover{
background:#353b48;
}

.content{
margin-left:230px;
padding:25px;
}

.topbar{
background:white;
padding:15px 25px;
border-radius:10px;
box-shadow:0 3px 10px rgba(0,0,0,0.05);
margin-bottom:25px;
}

.stat-card{
border:none;
border-radius:12px;
box-shadow:0 5px 15px rgba(0,0,0,0.08);
transition:0.3s;
}

.stat-card:hover{
transform:translateY(-3px);
}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

<h4>ADMIN PANEL</h4>

<a href="dashboard.php">
<i class="fa fa-home"></i> Dashboard
</a>

<a href="buku/">
<i class="fa fa-book"></i> Buku
</a>

<a href="anggota/">
<i class="fa fa-users"></i> Data Anggota
</a>

<a href="peminjaman/">
<i class="fa fa-book-open"></i> Peminjaman
</a>

<a href="../logout.php">
<i class="fa fa-sign-out-alt"></i> Logout
</a>

</div>

<!-- CONTENT -->

<div class="content">

<!-- TOPBAR -->

<div class="topbar d-flex justify-content-between">

<h4>Dashboard</h4>

<span>
<i class="fa fa-user"></i>
<?php echo $_SESSION['nama']; ?>
</span>

</div>

<!-- STATISTIK -->

<div class="row g-4">

<div class="col-md-3">

<div class="card stat-card text-center p-3">

<i class="fa fa-book fa-2x text-primary mb-2"></i>

<h6>Total Buku</h6>

<h3><?php echo $total_buku; ?></h3>

</div>

</div>


<div class="col-md-3">

<div class="card stat-card text-center p-3">

<i class="fa fa-users fa-2x text-success mb-2"></i>

<h6>Total Anggota</h6>

<h3><?php echo $total_anggota; ?></h3>

</div>

</div>


<div class="col-md-3">

<div class="card stat-card text-center p-3">

<i class="fa fa-book-open fa-2x text-warning mb-2"></i>

<h6>Total Peminjaman</h6>

<h3><?php echo $total_peminjaman; ?></h3>

</div>

</div>


<div class="col-md-3">

<div class="card stat-card text-center p-3">

<i class="fa fa-exchange-alt fa-2x text-danger mb-2"></i>

<h6>Buku Dipinjam</h6>

<h3><?php echo $buku_dipinjam['total']; ?></h3>

</div>

</div>

</div>


<!-- GRAFIK PENJUALAN -->

<div class="card mt-4 shadow-sm">

<div class="card-header bg-white">

<h5>Grafik Peminjaman Buku</h5>

</div>

<div class="card-body">

<canvas id="grafikPenjualan"></canvas>

</div>

</div>


<!-- PESANAN TERBARU -->

<div class="card mt-4 shadow-sm">

<div class="card-header bg-white">

<h5>Pesanan Terbaru</h5>

</div>

<div class="card-body">

<table class="table">

<tr>

<th>ID</th>
<th>Anggota</th>
<th>Buku</th>
<th>Tanggal Pinjam</th>
<th>Tanggal Kembali</th>

</tr>

<?php while($p = mysqli_fetch_array($peminjaman)){ ?>

<tr>

<td>#<?php echo $p['id_peminjam']; ?></td>

<td><?php echo $p['nama']; ?></td>

<td><?php echo $p['judul']; ?></td>

<td><?php echo $p['tanggal_pinjam']; ?></td>

<td><?php echo $p['tanggal_kembali']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

 

<script>

const ctx = document.getElementById('grafikPenjualan');

new Chart(ctx,{
type:'line',
data:{
labels: <?php echo json_encode($bulan); ?>,
datasets:[{
label:'Peminjaman',
data: <?php echo json_encode($total); ?>,
borderWidth:3,
tension:0.3
}]
}
});

</script>

</body>
</html>