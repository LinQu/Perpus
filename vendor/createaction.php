<?php
include '../Connection/koneksi.php';

$idvendor = $_POST['idvendor'];
$nama = $_POST['name'];
$alamat = $_POST['address'];
$notelp = $_POST['notelp'];
$email = $_POST['email'] . "\n";

$query = "INSERT INTO vendor (id_vendor, nama_vendor, alamat_vendor, telp_vendor, email_vendor) VALUES ('$idvendor', '$nama', '$alamat', '$notelp', '$email')";
$result = mysqli_query($koneksi, $query);

if ($result) {
  header("location: index.php");
} else {
  echo "Gagal";
}
