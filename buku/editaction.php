<?php
  include '../Connection/koneksi.php';
  $id = $_POST['idbuku'];
  $nama = $_POST['nama'];
  $jenis = $_POST['jenis'];
  $vendor = $_POST['vendor'];
  $stok = $_POST['stok'];
  $update = "UPDATE buku SET nama_buku='$nama', id_jenis_buku='$jenis', id_vendor='$vendor', jml_stok='$stok' WHERE id_buku='$id'";
  $result = mysqli_query($koneksi, $update);
  if ($result) {
    header("location: index.php");
  } else {
    echo "Gagal";
  }
