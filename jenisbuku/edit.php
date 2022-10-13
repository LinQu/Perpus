<?php include '../layout/header.php'; ?>
<?php include '../Connection/koneksi.php'; ?>
<?php
$idjenis = $_GET['id'];
$query = "SELECT * FROM jenis_buku WHERE id_jenis_buku = '$idjenis'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
$idjenis = $row['id_jenis_buku'];
$jenis = $row['nama_jenis_buku'];

?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Jenis Buku</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Jenis Buku</li>
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
            <form action="editaction.php" method="post">
              <div class="card-body">
                <div class="form-group">
                  <label for="idjenis" class="form-label">ID Jenis Buku</label>
                  <input type="text" class="form-control" id="idjenis" name="idjenis" value="<?php echo $idjenis ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="jenis" class="form-label">Jenis Buku</label>
                  <input type="text" class="form-control" id="jenis" name="jenis" value="<?php echo $jenis ?>">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include '../layout/footer.php'; ?>