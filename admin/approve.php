<?php
include "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn,"UPDATE transaksi SET status='Diproses' WHERE id='$id'");

header("location:pesanan.php");