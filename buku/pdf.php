<?php
session_start();
//kalai session nya username dan role nya admin maka file ini bisa diakses
if (isset($_SESSION['nama']) && isset($_SESSION['role']) && $_SESSION['role'] == '1') {
  $data = $_GET['search'];
  require('../fpdf184/fpdf.php');
  include '../Connection/koneksi.php';
  ob_start();
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 16);
  $pdf->Cell(190, 7, 'LAPORAN DATA BUKU', 0, 1, 'C');
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(190, 7, 'PT. KARYA HIDUP SENTOSA', 0, 1, 'C');
  $pdf->Cell(10, 7, '', 0, 1);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(10, 6, 'No', 1, 0);
  $pdf->Cell(40, 6, 'Nama Buku', 1, 0);
  $pdf->Cell(40, 6, 'Jenis Buku', 1, 0);
  $pdf->Cell(40, 6, 'Vendor', 1, 0);
  $pdf->Cell(40, 6, 'Jumlah Buku', 1, 1);
  $pdf->SetFont('Arial', '', 10);

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
  while ($row = mysqli_fetch_array($query)) {
    $pdf->Cell(10, 6, $no, 1, 0);
    $pdf->Cell(40, 6, $row['nama_buku'], 1, 0);
    $pdf->Cell(40, 6, $row['nama_jenis_buku'], 1, 0);
    $pdf->Cell(40, 6, $row['nama_vendor'], 1, 0);
    $pdf->Cell(40, 6, $row['jml_stok'], 1, 1);
    $no++;
  }
  $pdf->Output('Laporan Data Buku.pdf', 'I');
} else if (isset($_SESSION['nama']) && isset($_SESSION['role']) && $_SESSION['role'] == '0') {
  echo "<script language=\"javascript\">alert(\"Tidak Memiliki Akses\");document.location.href='../index.php';</script>";
} else {
  echo "<script language=\"javascript\">alert(\"Silahkan Login\");document.location.href='../index.php';</script>";
}
