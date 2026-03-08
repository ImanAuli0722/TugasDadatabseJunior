<?php
session_start();
include "../../config/koneksi.php";
include "../layout/sidebar.php";

if(!isset($_SESSION['user_id'])){
header("location:../../login.php");
exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Data Anggota</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
}

.sidebar{
height:100vh;
background:#2f3640;
position:fixed;
width:230px;
color:white;
}

.sidebar h4{
text-align:center;
padding:20px;
border-bottom:1px solid #444;
}

.sidebar a{
display:block;
padding:14px 20px;
color:white;
text-decoration:none;
}

.sidebar a:hover{
background:#353b48;
}

.content{
margin-left:230px;
padding:25px;
}

.card{
border:none;
border-radius:10px;
box-shadow:0 3px 10px rgba(0,0,0,0.08);
}

</style>

</head>

<body>



<!-- CONTENT -->

<div class="content">

<div class="d-flex justify-content-between mb-3">

<h4>Data Anggota</h4>

<a href="create.php" class="btn btn-primary">
<i class="fa fa-plus"></i> Tambah Anggota
</a>

</div>

<div class="card">

<div class="card-body">

<table class="table table-hover">

<tr>

<th>No</th>
<th>Nama</th>
<th>Alamat</th>
<th>No HP</th>
<th>Aksi</th>

</tr>

<?php

$no = 1;

$data = mysqli_query($conn,"SELECT * FROM anggota");

while($d = mysqli_fetch_array($data)){

?>

<tr>

<td><?php echo $no++; ?></td>

<td><?php echo $d['nama']; ?></td>

<td><?php echo $d['alamat']; ?></td>

<td><?php echo $d['no_hp']; ?></td>

<td>

<a href="edit.php?id=<?php echo $d['id_anggota']; ?>" 
class="btn btn-warning btn-sm">

<i class="fa fa-edit"></i>

</a>

<a href="hapus.php?id=<?php echo $d['id_anggota']; ?>"
onclick="return confirm('Yakin hapus anggota?')" 
class="btn btn-danger btn-sm">

<i class="fa fa-trash"></i>

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

</body>
</html>