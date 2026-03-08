<?php
include "../../config/koneksi.php";
require('../../fpdf/fpdf.php');

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'LAPORAN DATA PEMINJAMAN BUKU',0,1,'C');

$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);

$pdf->Cell(10,10,'No',1,0,'C');
$pdf->Cell(60,10,'Nama Anggota',1,0,'C');
$pdf->Cell(120,10,'Judul Buku',1,0,'C');
$pdf->Cell(40,10,'Tanggal Pinjam',1,0,'C');
$pdf->Cell(40,10,'Tanggal Kembali',1,1,'C');

$pdf->SetFont('Arial','',10);

$no = 1;

$data = mysqli_query($conn,"
SELECT p.*, a.nama, b.judul
FROM peminjaman p
JOIN anggota a ON p.id_anggota = a.id_anggota
JOIN buku b ON p.id_buku = b.id_buku
ORDER BY p.id_peminjam DESC
");

while($d=mysqli_fetch_array($data)){

$pdf->Cell(10,10,$no++,1,0,'C');
$pdf->Cell(60,10,$d['nama'],1,0);
$pdf->Cell(120,10,$d['judul'],1,0);
$pdf->Cell(40,10,$d['tanggal_pinjam'],1,0);
$pdf->Cell(40,10,$d['tanggal_kembali'],1,1);

}

$pdf->Output();
?>