<?php
session_start();
include "../../config/koneksi.php";
include "../layout/header.php";
include "../layout/sidebar.php";

if(!isset($_SESSION['user_id'])){
header("location:../../login.php");
exit();
}

/* =====================
PROSES SIMPAN DATA
===================== */

if(isset($_POST['simpan'])){

$judul     = $_POST['judul'];
$penulis   = $_POST['penulis'];
$tahun     = $_POST['tahun'];
$stok      = $_POST['stok'];
$deskripsi = $_POST['deskripsi'];

$gambar = $_FILES['gambar']['name'];
$tmp    = $_FILES['gambar']['tmp_name'];

if($gambar != ""){

move_uploaded_file($tmp,"../../assets/img/".$gambar);

}

mysqli_query($conn,"INSERT INTO buku
(judul,penulis,tahun_terbit,stok,gambar,deskripsi)
VALUES
('$judul','$penulis','$tahun','$stok','$gambar','$deskripsi')
");

echo "<script>
alert('Buku berhasil ditambahkan');
window.location='index.php';
</script>";

}
?>

<div class="content">

<div class="card">

<div class="card-header bg-primary text-white">
<i class="fa fa-book"></i> Tambah Buku
</div>

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">

<label class="form-label">Judul Buku</label>

<input type="text" name="judul" class="form-control" required>

</div>

<div class="mb-3">

<label class="form-label">Penulis</label>

<input type="text" name="penulis" class="form-control" required>

</div>

<div class="mb-3">

<label class="form-label">Tahun Terbit</label>

<input type="number" name="tahun" class="form-control" required>

</div>

<div class="mb-3">

<label class="form-label">Stok</label>

<input type="number" name="stok" class="form-control" required>

</div>

<div class="mb-3">

<label class="form-label">Gambar Buku</label>

<input type="file" name="gambar" class="form-control" required>

</div>

<div class="mb-3">

<label class="form-label">Deskripsi</label>

<textarea name="deskripsi" class="form-control" rows="4"></textarea>

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