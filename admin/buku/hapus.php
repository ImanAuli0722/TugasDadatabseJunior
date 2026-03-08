<?php

include "../../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM buku WHERE id_buku='$id'");
$d = mysqli_fetch_array($data);

unlink("../../assets/img/".$d['gambar']);

mysqli_query($conn,"DELETE FROM buku WHERE id_buku='$id'");

header("location:index.php");

?>