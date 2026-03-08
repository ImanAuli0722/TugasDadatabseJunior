<?php
include "../config/koneksi.php";

$id = $_GET['id'];

$transaksi = mysqli_query($conn,"SELECT * FROM transaksi WHERE id='$id'");
$t = mysqli_fetch_assoc($transaksi);

$detail = mysqli_query($conn,"
SELECT detail_transaksi.*, produk.nama_produk 
FROM detail_transaksi
JOIN produk ON detail_transaksi.produk_id = produk.id
WHERE transaksi_id='$id'
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Invoice</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.invoice-box{
max-width:800px;
margin:auto;
padding:30px;
border:1px solid #eee;
}
</style>

</head>

<body>

<div class="invoice-box">

<h2>TOKO ONLINE</h2>
<hr>

<h4>Invoice #<?php echo $t['id']; ?></h4>

<p>
<b>Nama :</b> <?php echo $t['nama']; ?><br>
<b>Alamat :</b> <?php echo $t['alamat']; ?><br>
<b>Status :</b> <?php echo $t['status']; ?>
</p>

<table class="table table-bordered">

<tr>
<th>Produk</th>
<th>Harga</th>
<th>Qty</th>
<th>Subtotal</th>
</tr>

<?php while($d = mysqli_fetch_array($detail)){ ?>

<tr>

<td><?php echo $d['nama_produk']; ?></td>

<td>Rp <?php echo number_format($d['harga']); ?></td>

<td><?php echo $d['qty']; ?></td>

<td>Rp <?php echo number_format($d['subtotal']); ?></td>

</tr>

<?php } ?>

<tr>
<td colspan="3"><b>Total</b></td>
<td><b>Rp <?php echo number_format($t['total']); ?></b></td>
</tr>

</table>

<button onclick="window.print()" class="btn btn-primary">
Print Invoice
</button>

</div>

</body>
</html>