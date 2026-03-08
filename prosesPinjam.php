<?php
include "config/koneksi.php";

$id_buku = $_POST['id_buku'];
$id_anggota = $_POST['id_anggota'];
$tanggal_pinjam = $_POST['tanggal_pinjam'];
$tanggal_kembali = $_POST['tanggal_kembali'];

mysqli_query($conn,"INSERT INTO peminjaman 
VALUES (NULL,'$id_anggota','$id_buku','$tanggal_pinjam','$tanggal_kembali')");

mysqli_query($conn,"UPDATE buku 
SET stok = stok - 1 
WHERE id_buku='$id_buku'");

header("location:index.php");
?>