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

$nama   = trim($_POST['nama']);
$alamat = trim($_POST['alamat']);
$no_hp  = trim($_POST['no_hp']);

mysqli_query($conn,"INSERT INTO anggota (nama,alamat,no_hp) VALUES(
'$nama',
'$alamat',
'$no_hp'
)");

echo "<script>
alert('Anggota berhasil ditambahkan');
window.location='index.php';
</script>";

}
?>

<div class="content">

<div class="card">

<div class="card-header bg-primary text-white">
<i class="fa fa-user-plus"></i> Tambah Anggota
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label class="form-label">Nama</label>
<input type="text" name="nama" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Alamat</label>
<input type="text" name="alamat" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">No HP</label>
<input type="text" name="no_hp" class="form-control" pattern="[0-9]+" required>
</div>

<button class="btn btn-success" name="simpan">
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