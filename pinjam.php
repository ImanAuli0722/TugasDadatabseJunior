<?php
include "config/koneksi.php";

$id_buku = $_GET['id'];

$buku = mysqli_query($conn,"SELECT * FROM buku WHERE id_buku='$id_buku'");
$b = mysqli_fetch_array($buku);

$anggota = mysqli_query($conn,"SELECT * FROM anggota");

?>
<!DOCTYPE html>
<html>
<head>

<title>Pinjam Buku</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h3>Form Peminjaman Buku</h3>

<hr>

<form method="POST" action="prosesPinjam.php">

<input type="hidden" name="id_buku" value="<?php echo $b['id_buku']; ?>">

<div class="mb-3">

<label>Judul Buku</label>

<input type="text" class="form-control" 
value="<?php echo $b['judul']; ?>" readonly>

</div>

<div class="mb-3">

<label>Pilih Anggota</label>

<select name="id_anggota" class="form-control" required>

<option value="">-- Pilih Anggota --</option>

<?php while($a = mysqli_fetch_array($anggota)){ ?>

<option value="<?php echo $a['id_anggota']; ?>">
<?php echo $a['nama']; ?>
</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Tanggal Pinjam</label>

<input type="date" name="tanggal_pinjam" class="form-control" required>

</div>

<div class="mb-3">

<label>Tanggal Kembali</label>

<input type="date" name="tanggal_kembali" class="form-control" required>

</div>

<button class="btn btn-success">
Simpan Peminjaman
</button>

<a href="index.php" class="btn btn-danger">
Kembali
</a>

</form>

</div>

</body>
</html>