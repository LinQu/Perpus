<?php
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
