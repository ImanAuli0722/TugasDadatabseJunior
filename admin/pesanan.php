<?php
include "../config/koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Pesanan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<h3>Data Pesanan</h3>

<table class="table table-bordered">

<tr>
<th>No</th>
<th>Nama</th>
<th>Alamat</th>
<th>Total</th>
<th>Status</th>
<th>Aksi</th>
</tr>

<?php

$no = 1;
$data = mysqli_query($conn,"SELECT * FROM transaksi");

while($d = mysqli_fetch_array($data)){
?>

<tr>

<td><?php echo $no++; ?></td>
<td><?php echo $d['nama']; ?></td>
<td><?php echo $d['alamat']; ?></td>
<td>Rp <?php echo number_format($d['total']); ?></td>
<td><?php echo $d['status']; ?></td>

<td>

<a href="approve.php?id=<?php echo $d['id']; ?>" class="btn btn-success btn-sm">
Approve
</a>

<a href="invoice.php?id=<?php echo $d['id']; ?>" class="btn btn-primary btn-sm">
Invoice
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>