<?php
session_start();
include "../../config/koneksi.php";
include "../layout/header.php";
include "../layout/sidebar.php";

if(!isset($_SESSION['user_id'])){
header("location:../../login.php");
exit();
}
?>

<div class="content">

<div class="d-flex justify-content-between mb-3">

<h4>Data Buku</h4>

<a href="create.php" class="btn btn-primary">
<i class="fa fa-plus"></i> Tambah Buku
</a>

</div>

<div class="card">

<div class="card-body">

<table class="table table-hover table-bordered align-middle">

<thead class="table-dark">

<tr>
<th width="50">No</th>
<th width="90">Gambar</th>
<th>Judul</th>
<th>Penulis</th>
<th width="120">Tahun</th>
<th width="100">Stok</th>
<th width="130">Aksi</th>
</tr>

</thead>

<tbody>

<?php

$no = 1;
$data = mysqli_query($conn,"SELECT * FROM buku ORDER BY id_buku DESC");

while($d = mysqli_fetch_array($data)){

?>

<tr>

<td><?= $no++; ?></td>

<td>
<img src="../../assets/img/<?= $d['gambar']; ?>" width="60">
</td>

<td><?= $d['judul']; ?></td>

<td><?= $d['penulis']; ?></td>

<td><?= $d['tahun_terbit']; ?></td>

<td>

<?php if($d['stok'] > 0){ ?>

<span class="badge bg-success">
<?= $d['stok']; ?>
</span>

<?php }else{ ?>

<span class="badge bg-danger">
Habis
</span>

<?php } ?>

</td>

<td>

<a href="edit.php?id=<?= $d['id_buku']; ?>" 
class="btn btn-warning btn-sm">

<i class="fa fa-edit"></i>

</a>

<a href="hapus.php?id=<?= $d['id_buku']; ?>" 
onclick="return confirm('Yakin hapus buku?')" 
class="btn btn-danger btn-sm">

<i class="fa fa-trash"></i>

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

<?php include "../layout/footer.php"; ?>