<?php include '../layout/header.php';

if (isset($_SESSION['nama']) && isset($_SESSION['role']) && $_SESSION['role'] == '1') {
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Vendor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create Vendor</li>
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
            <div class="card card-primary">
              <div class="card-header"></div>
              <!-- /.card-header -->

              <!-- form start -->
              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="idvendor" class="form-label">ID Vendor</label>
                    <input type="text" class="form-control" id="idvendor" name="idvendor" value="<?php echo idotomatis() ?>" readonly>
                  </div>

                  <div class="form-group">
                    <label for="nama" class="form-label">Name Vendor</label>
                    <input type="text" class="form-control" id="name" name="name">
                  </div>

                  <div class="form-group">
                    <label for="alamatvendor" class="form-label">Vendor Address</label>
                    <textarea class="form-control" id="addressvendor" name="address" rows="3"></textarea>
                  </div>

                  <div class="form-group">
                    <label for="notelp" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="notelp" name="notelp">
                  </div>

                  <div class="form-group">
                    <label for="email" class="form-label">Email Vendor</label>
                    <input type="text" class="form-control" id="email" name="email">
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

include '../Connection/koneksi.php';
if (isset($_POST['submit'])) {
  $idvendor = $_POST['idvendor'];
  $nama = $_POST['name'];
  $alamat = $_POST['address'];
  $notelp = $_POST['notelp'];
  $email = $_POST['email'];
  $status = 1;

  $query = "INSERT INTO vendor (id_vendor, nama_vendor, alamat_vendor, telp_vendor, email_vendor,status) VALUES ('$idvendor', '$nama', '$alamat', '$notelp', '$email','$status')";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    echo "<script>window.location.href='index.php'</script>";
  } else {
    echo "<script>alert('Data Gagal Dihapus');window.location.href='index.php'</script>";
  }
}

function idotomatis()
{
  include '../Connection/koneksi.php';
  $query = "SELECT max(id_vendor) as maxKode FROM vendor";
  $hasil = mysqli_query($koneksi, $query);
  $data = mysqli_fetch_array($hasil);
  $idvendor = $data['maxKode'];
  $noUrut = (int) substr($idvendor, 3, 3);
  $noUrut++;
  $char = "VDR";
  $idvendor = $char . sprintf("%03s", $noUrut);
  return $idvendor;
}
?>

<?php include '../layout/footer.php'; ?>