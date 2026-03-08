<?php
include "../../config/koneksi.php";

$id = $_GET['id'];

// tanggal kembali = hari ini
$tanggal_kembali = date("Y-m-d");

// update data peminjaman
mysqli_query($conn,"UPDATE peminjaman 
SET tanggal_kembali='$tanggal_kembali' 
WHERE id_peminjam='$id'");

// redirect kembali ke halaman peminjaman
header("location:index.php");
?>