<?php
include '../Connection/koneksi.php';


$idvendor = $_POST['idvendor'];
$nama = $_POST['name'];
$alamat = $_POST['address'];
$notelp = $_POST['notelp'];
$email = $_POST['email'];

$update = "UPDATE vendor SET nama_vendor='$nama', alamat_vendor='$alamat', telp_vendor='$notelp', email_vendor='$email' WHERE id_vendor='$idvendor'";
$result = mysqli_query($koneksi, $update);

if ($update) {
  header("location: index.php");
} else {
  echo "Gagal";
}
