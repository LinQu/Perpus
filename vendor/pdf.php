<?php
$data = $_GET['search'];
require('../fpdf184/fpdf.php');
include '../Connection/koneksi.php';
ob_start();
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 7, 'LAPORAN DATA VENDOR', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 7, 'PT. KARYA HIDUP SENTOSA', 0, 1, 'C');
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 6, 'No', 1, 0);
$pdf->Cell(40, 6, 'Nama Vendor', 1, 0);
$pdf->Cell(40, 6, 'Alamat', 1, 0);
$pdf->Cell(40, 6, 'No. Telp', 1, 0);
$pdf->Cell(40, 6, 'Email', 1, 1);
$pdf->SetFont('Arial', '', 10);


$query = mysqli_query($koneksi, "SELECT * FROM vendor WHERE nama_vendor LIKE '%" . $data . "%' and status = 1");

if (mysqli_num_rows($query) == 0) {
  $query = mysqli_query($koneksi, "SELECT * FROM vendor WHERE alamat_vendor LIKE '%" . $data . "%' and status = 1");
}
if (mysqli_num_rows($query) == 0) {
  $query = mysqli_query($koneksi, "SELECT * FROM vendor WHERE telp_vendor LIKE '%" . $data . "%' and status = 1");
}
if (mysqli_num_rows($query) == 0) {
  $query = mysqli_query($koneksi, "SELECT * FROM vendor WHERE email_vendor LIKE '%" . $data . "%' and status = 1");
}
// if (mysqli_num_rows($query) == 0) {
//   $query = mysqli_query($koneksi, "SELECT * FROM vendor WHERE status = 1");
// }
$no = 1;
while ($row = mysqli_fetch_array($query)) {
  $pdf->Cell(10, 6, $no, 1, 0);
  $pdf->Cell(40, 6, $row['nama_vendor'], 1, 0);
  $pdf->Cell(40, 6, $row['alamat_vendor'], 1, 0);
  $pdf->Cell(40, 6, $row['telp_vendor'], 1, 0);
  $pdf->Cell(40, 6, $row['email_vendor'], 1, 1);
  $no++;
}

//$pdf->Output();

$pdf->Output('Laporan Data Vendor.pdf', 'I');
