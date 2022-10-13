<?php
include '../Connection/koneksi.php';
$id = $_POST['idjenis'];
$jenis = $_POST['jenis'];
$query = "INSERT INTO jenis_buku (id_jenis_buku, nama_jenis_buku) VALUES ('$id', '$jenis')";
$result = mysqli_query($koneksi, $query);
if ($result) {
  header("location: index.php");
} else {
  echo "Gagal";
}
