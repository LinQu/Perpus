<?php include '../layout/header.php'; ?>
<?php include '../Connection/koneksi.php'; ?>


<?php
$idvendor = $_GET['id'];
$query = "SELECT * FROM vendor WHERE id_vendor = '$idvendor'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
$idvendor = $row['id_vendor'];
$nama = $row['nama_vendor'];
$alamat = $row['alamat_vendor'];
$notelp = $row['telp_vendor'];
$email = $row['email_vendor'];

if (isset($_POST['submit'])) {
  $idvendor = $_POST['idvendor'];
  $nama = $_POST['name'];
  $alamat = $_POST['address'];
  $notelp = $_POST['notelp'];
  $email = $_POST['email'];

  $update = "UPDATE vendor SET nama_vendor='$nama', alamat_vendor='$alamat', telp_vendor='$notelp', email_vendor='$email' WHERE id_vendor='$idvendor'";
  $result = mysqli_query($koneksi, $update);
  if ($result) {
    echo "<script>window.location.href='index.php'</script>";
  } else {
    echo "<script>alert('Data Gagal Diupdate');window.location.href='index.php'</script>";
  }
}


if (isset($_SESSION['nama']) && isset($_SESSION['role']) && $_SESSION['role'] == '1') {
?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Vendor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Vendor</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-warning">
              <div class="card-header"></div>
              <!-- /.card-header -->

              <!-- form start -->
              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="idvendor" class="form-label">ID Vendor</label>
                    <input type="text" class="form-control" id="idvendor" name="idvendor" value="<?php echo $idvendor ?>" readonly>
                  </div>

                  <div class="form-group">
                    <label for="nama" class="form-label">Nama Vendor</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $nama ?>">
                  </div>

                  <div class="form-group">
                    <label for="alamatvendor" class="form-label">Alamat Vendor</label>
                    <textarea class="form-control" id="addressvendor" name="address" rows="3"><?php echo $alamat ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="notelp" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" id="notelp" name="notelp" value="<?php echo $notelp ?>">
                  </div>

                  <div class="form-group">
                    <label for="email" class="form-label">Email Vendor</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php
} else if (isset($_SESSION['nama']) && isset($_SESSION['role']) && $_SESSION['role'] == '0') {
  echo "<script language=\"javascript\">document.location.href='../layout/access.php';</script>";
} else {
  echo "<script language=\"javascript\">alert(\"Silahkan Login\");document.location.href='../index.php';</script>";
}

include '../layout/footer.php'; ?>