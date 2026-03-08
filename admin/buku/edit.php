<?php
session_start();
include "../../config/koneksi.php";
include "../layout/header.php";
include "../layout/sidebar.php";

if(!isset($_SESSION['user_id'])){
header("location:../../login.php");
exit();
}

if(!isset($_GET['id'])){
header("location:index.php");
exit();
}

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM buku WHERE id_buku='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){

$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$tahun = $_POST['tahun'];
$stok = $_POST['stok'];
$deskripsi = $_POST['deskripsi'];

$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];

if($gambar != ""){

move_uploaded_file($tmp,"../../assets/img/".$gambar);

mysqli_query($conn,"UPDATE buku SET
judul='$judul',
penulis='$penulis',
tahun_terbit='$tahun',
stok='$stok',
gambar='$gambar',
deskripsi='$deskripsi'
WHERE id_buku='$id'");

}else{

mysqli_query($conn,"UPDATE buku SET
judul='$judul',
penulis='$penulis',
tahun_terbit='$tahun',
stok='$stok',
deskripsi='$deskripsi'
WHERE id_buku='$id'");

}

echo "<script>
alert('Data buku berhasil diupdate');
window.location='index.php';
</script>";

}
?>

<div class="content">

<div class="card">

<div class="card-header bg-warning text-dark">
<i class="fa fa-edit"></i> Edit Buku
</div>

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label class="form-label">Judul</label>
<input type="text" name="judul" class="form-control"
value="<?= $d['judul']; ?>" required>
</div>

<div class="mb-3">
<label class="form-label">Penulis</label>
<input type="text" name="penulis" class="form-control"
value="<?= $d['penulis']; ?>" required>
</div>

<div class="mb-3">
<label class="form-label">Tahun Terbit</label>
<input type="number" name="tahun" class="form-control"
value="<?= $d['tahun_terbit']; ?>" required>
</div>

<div class="mb-3">
<label class="form-label">Stok</label>
<input type="number" name="stok" class="form-control"
value="<?= $d['stok']; ?>" required>
</div>

<div class="mb-3">
<label class="form-label">Gambar</label><br>

<img src="../../assets/img/<?= $d['gambar']; ?>" width="100" class="mb-2">

<input type="file" name="gambar" class="form-control">
</div>

<div class="mb-3">
<label class="form-label">Deskripsi</label>
<textarea name="deskripsi" class="form-control" rows="4"><?= $d['deskripsi']; ?></textarea>
</div>

<button class="btn btn-success" name="update">
<i class="fa fa-save"></i> Update
</button>

<a href="index.php" class="btn btn-secondary">
<i class="fa fa-arrow-left"></i> Kembali
</a>

</form>

</div>

</div>

</div>

<?php include "../layout/footer.php"; ?>