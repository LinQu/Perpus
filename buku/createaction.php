<?php
include '../Connection/koneksi.php';
$id = $_POST['idbuku'];
$nama = $_POST['nama'];
$jenis = $_POST['jenis'];
$vendor = $_POST['vendor'];
$stok = $_POST['stok'];

$insert = "INSERT INTO buku (id_buku, nama_buku, id_jenis_buku, id_vendor, jml_stok) VALUES ('$id', '$nama', '$jenis', '$vendor', '$stok')";
$result = mysqli_query($koneksi, $insert);

if ($result) {
  header("location: index.php");
} else {
  echo "Gagal";
}
