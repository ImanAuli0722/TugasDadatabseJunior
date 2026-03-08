<?php
session_start();
include "../../config/koneksi.php";
include "../layout/header.php";
include "../layout/sidebar.php";

if(!isset($_SESSION['user_id'])){
header("location:../../login.php");
exit();
}

if(isset($_POST['simpan'])){

$id_anggota = $_POST['id_anggota'];
$id_buku = $_POST['id_buku'];
$tanggal_pinjam = date("Y-m-d");

mysqli_query($conn,"INSERT INTO peminjaman
(id_anggota,id_buku,tanggal_pinjam)
VALUES
('$id_anggota','$id_buku','$tanggal_pinjam')
");

mysqli_query($conn,"UPDATE buku SET stok = stok - 1 WHERE id_buku='$id_buku'");

echo "<script>
alert('Peminjaman berhasil ditambahkan');
window.location='index.php';
</script>";

}
?>

<div class="content">

<div class="card">

<div class="card-header bg-success text-white">
<i class="fa fa-book"></i> Tambah Peminjaman Buku
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label class="form-label">Anggota</label>

<select name="id_anggota" class="form-control" required>

<option value="">-- Pilih Anggota --</option>

<?php
$anggota = mysqli_query($conn,"SELECT * FROM anggota");

while($a = mysqli_fetch_array($anggota)){
?>

<option value="<?= $a['id_anggota']; ?>">
<?= $a['nama']; ?>
</option>

<?php } ?>

</select>

</div>


<div class="mb-3">

<label class="form-label">Buku</label>

<select name="id_buku" class="form-control" required>

<option value="">-- Pilih Buku --</option>

<?php
$buku = mysqli_query($conn,"SELECT * FROM buku WHERE stok > 0");

while($b = mysqli_fetch_array($buku)){
?>

<option value="<?= $b['id_buku']; ?>">
<?= $b['judul']; ?> (Stok: <?= $b['stok']; ?>)
</option>

<?php } ?>

</select>

</div>


<button type="submit" name="simpan" class="btn btn-success">

<i class="fa fa-save"></i> Simpan

</button>

<a href="index.php" class="btn btn-secondary">

<i class="fa fa-arrow-left"></i> Kembali

</a>

</form>

</div>

</div>

</div>

<?php include "../layout/footer.php"; ?>