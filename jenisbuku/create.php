<?php include '../layout/header.php'; ?>
<?php include '../Connection/koneksi.php'; ?>


<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Create Jenis Buku</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Create Jenis Buku</li>
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
                  <label for="idjenis" class="form-label">ID Jenis</label>
                  <input type="text" class="form-control" id="idjenis" name="idjenis" value="<?php echo idotomatis() ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="jenis" class="form-label">Jenis Buku</label>
                  <input type="text" class="form-control" id="jenis" name="jenis">
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
include '../Connection/koneksi.php';
if (isset($_POST['submit'])) {
  $idjenis = $_POST['idjenis'];
  $jenis = $_POST['jenis'];
  $status = '1';

  $sql = "INSERT INTO jenis_buku (id_jenis_buku, nama_jenis_buku,status) VALUES ('$idjenis', '$jenis', '$status')";
  $query = mysqli_query($koneksi, $sql);

  if ($query) {
    echo "<script>window.location.href='index.php'</script>";
  } else {
    echo "<script>alert('Data gagal ditambahkan!'); window.location.href='create.php'</script>";
  }
}

function idotomatis()
{
  include '../Connection/koneksi.php';
  $query = mysqli_query($koneksi, "SELECT max(id_jenis_buku) as maxKode FROM jenis_buku");
  $data = mysqli_fetch_array($query);
  $idjenis = $data['maxKode'];
  $noUrut = (int) substr($idjenis, 3, 3);
  $noUrut++;
  $char = "JEN";
  $idjenis = $char . sprintf("%03s", $noUrut);
  return $idjenis;
}
?>

<?php include '../layout/footer.php'; ?>