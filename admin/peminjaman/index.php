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

<div class="card shadow">

<div class="card-header bg-primary text-white">
<h5 class="mb-0">📚 Data Peminjaman Buku</h5>
</div>

<div class="card-body">

<a href="create.php" class="btn btn-success mb-3">
<i class="fa fa-plus"></i> Tambah Peminjaman
</a>

<a href="laporanPdf.php" target="_blank" class="btn btn-danger mb-3">
Export PDF
</a>

<div class="table-responsive">

<table class="table table-bordered table-striped table-hover">

<thead class="table-dark">

<tr>
<th width="50">No</th>
<th>Nama Anggota</th>
<th>Judul Buku</th>
<th>Tanggal Pinjam</th>
<th>Status</th>
<th width="200">Aksi</th>
</tr>

</thead>

<tbody>

<?php
$no = 1;

$data = mysqli_query($conn,"
SELECT 
p.id_peminjam,
p.tanggal_pinjam,
p.tanggal_kembali,
a.nama,
b.judul
FROM peminjaman p
JOIN anggota a ON p.id_anggota = a.id_anggota
JOIN buku b ON p.id_buku = b.id_buku
ORDER BY p.id_peminjam DESC
");

while($d = mysqli_fetch_array($data)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['nama']; ?></td>

<td><?= $d['judul']; ?></td>

<td><?= $d['tanggal_pinjam']; ?></td>

<td>

<?php
if($d['tanggal_kembali'] == NULL){
?>

<span class="badge bg-warning text-dark">
Belum Kembali
</span>

<?php
}else{
?>

<span class="badge bg-success">
Sudah Kembali
</span>

<?php } ?>

</td>

<td>

<a href="kembali.php?id=<?php echo $d['id_peminjam']; ?>" 
class="btn btn-sm btn-primary">
Kembalikan
</a>

<a href="hapus.php?id=<?= $d['id_peminjam']; ?>" 
class="btn btn-sm btn-danger"
onclick="return confirm('Yakin hapus data?')">

<i class="fa fa-trash"></i> Hapus
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

<?php include "../layout/footer.php"; ?>