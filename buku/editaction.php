<?php
include '../Connection/koneksi.php';

if (isset($_SESSION['nama']) && isset($_SESSION['role']) && $_SESSION['role'] == '1') {
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
} else if (isset($_SESSION['nama']) && isset($_SESSION['role']) && $_SESSION['role'] == '0') {
  echo "<script language=\"javascript\">document.location.href='../layout/access.php';</script>";
} else {
  echo "<script language=\"javascript\">alert(\"Silahkan Login\");document.location.href='../index.php';</script>";
}
