<?php

if (isset($_SESSION['nama']) && isset($_SESSION['role']) && $_SESSION['role'] == '1') {
  include '../Connection/koneksi.php';
  $idjenis = $_POST['idjenis'];
  $jenis = $_POST['jenis'];

  $update = "UPDATE jenis_buku SET nama_jenis_buku='$jenis' WHERE id_jenis_buku='$idjenis'";
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
