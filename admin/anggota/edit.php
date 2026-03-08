<?php
session_start();
include "../../config/koneksi.php";
include "../layout/header.php";
include "../layout/sidebar.php";

if(!isset($_SESSION['user_id'])){
header("location:../../login.php");
exit();
}

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM anggota WHERE id_anggota='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){

$nama   = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_hp  = $_POST['no_hp'];

mysqli_query($conn,"UPDATE anggota SET
nama='$nama',
alamat='$alamat',
no_hp='$no_hp'
WHERE id_anggota='$id'
");

echo "<script>
alert('Data anggota berhasil diupdate');
window.location='index.php';
</script>";

}
?>

<div class="card">

<div class="card-header bg-warning text-dark">
Edit Data Anggota
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label class="form-label">Nama</label>

<input type="text"
name="nama"
class="form-control"
value="<?= $d['nama']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">Alamat</label>

<input type="text"
name="alamat"
class="form-control"
value="<?= $d['alamat']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">No HP</label>

<input type="text"
name="no_hp"
class="form-control"
value="<?= $d['no_hp']; ?>"
pattern="[0-9]+"
required>

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

<?php include "../layout/footer.php"; ?>