<?php
$data = $_GET['search'];
require '../vendor/autoload.php';
include '../Connection/koneksi.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

//sheet pertama
$sheet->setTitle('Sheet1');
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nama Buku');
$sheet->setCellValue('C1', 'Jenis Buku');
$sheet->setCellValue('D1', 'Vendor');
$sheet->setCellValue('E1', 'Jumlah Buku');

//membaca dari data base
$query = mysqli_query($koneksi, "SELECT id_buku,nama_buku,jenis_buku.nama_jenis_buku,vendor.nama_vendor,jml_stok FROM buku inner join jenis_buku on buku.id_jenis_buku = jenis_buku.id_jenis_buku inner join vendor on buku.id_vendor = vendor.id_vendor WHERE nama_buku LIKE '%" . $data . "%'");

if (mysqli_num_rows($query) == 0) {
  $query = mysqli_query($koneksi, "SELECT id_buku,nama_buku,jenis_buku.nama_jenis_buku,vendor.nama_vendor,jml_stok FROM buku inner join jenis_buku on buku.id_jenis_buku = jenis_buku.id_jenis_buku inner join vendor on buku.id_vendor = vendor.id_vendor WHERE jenis_buku.nama_jenis_buku LIKE '%" . $data . "%'");
}
if (mysqli_num_rows($query) == 0) {
  $query = mysqli_query($koneksi, "SELECT id_buku,nama_buku,jenis_buku.nama_jenis_buku,vendor.nama_vendor,jml_stok FROM buku inner join jenis_buku on buku.id_jenis_buku = jenis_buku.id_jenis_buku inner join vendor on buku.id_vendor = vendor.id_vendor WHERE vendor.nama_vendor LIKE '%" . $data . "%'");
}
if (mysqli_num_rows($query) == 0) {
  $query = mysqli_query($koneksi, "SELECT id_buku,nama_buku,jenis_buku.nama_jenis_buku,vendor.nama_vendor,jml_stok FROM buku inner join jenis_buku on buku.id_jenis_buku = jenis_buku.id_jenis_buku inner join vendor on buku.id_vendor = vendor.id_vendor");
}
$no = 1;
$baris = 2;
while ($row = mysqli_fetch_array($query)) {
  $sheet->setCellValue('A' . $baris, $no);
  $sheet->setCellValue('B' . $baris, $row['nama_buku']);
  $sheet->setCellValue('C' . $baris, $row['nama_jenis_buku']);
  $sheet->setCellValue('D' . $baris, $row['nama_vendor']);
  $sheet->setCellValue('E' . $baris, $row['jml_stok']);
  $no++;
  $baris++;
}

$writer = new Xlsx($spreadsheet);
ob_clean();
$filename = 'Data Buku';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
