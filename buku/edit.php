<?php include '../layout/header.php';
include '../Connection/koneksi.php';
?>

<?php
$idbuku = $_GET['id'];
//view data jenis and vendor with id
$query = "SELECT * FROM buku WHERE id_buku='$idbuku'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
$idbuku = $row['id_buku'];
$nama = $row['nama_buku'];
$jenis = $row['id_jenis_buku'];
$vendor = $row['id_vendor'];

$sql2 = "SELECT * FROM jenis_buku WHERE id_jenis_buku = '$jenis'";
$result2 = mysqli_query($koneksi, $sql2);
if (mysqli_num_rows($result2) > 0) {
  while ($row2 = mysqli_fetch_assoc($result2)) {
    $idjenis = $row2['id_jenis_buku'];
    $jenis = $row2['nama_jenis_buku'];
  }
}
$sql3 = "SELECT * FROM vendor WHERE id_vendor = '$vendor'";
$result3 = mysqli_query($koneksi, $sql3);
if (mysqli_num_rows($result3) > 0) {
  while ($row3 = mysqli_fetch_assoc($result3)) {
    $idvendor = $row3['id_vendor'];
    $vendor = $row3['nama_vendor'];
  }
}
$jenis1 = $jenis;
$vendor1 = $vendor;
$stok = $row['jml_stok'];


?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit ATK</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit ATK</li>
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
                  <label for="idatk" class="form-label">ID Buku</label>
                  <input type="text" class="form-control" id="idbuku" name="idbuku" value="<?php echo $idbuku ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="nama" class="form-label">Nama Buku</label>
                  <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                </div>

                <div class="form-group">
                  <label for="jenis" class="form-label">Jenis</label>
                  <select id="jenis" class="form-select" name="jenis">
                    <option selected value="<?php echo $idjenis ?>"><?php echo $jenis1 ?></option>
                    <?php
                    $sql = "SELECT * FROM jenis_buku";
                    $result = mysqli_query($koneksi, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<option value='" . $row['id_jenis_buku'] . "'>" . $row['nama_jenis_buku'] . "</option>";
                    }

                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="vendor" class="form-label">Vendor</label>
                  <select id="vendor" class="form-select" name="vendor">
                    <option selected value="<?php echo $idvendor ?>"><?php echo $vendor1 ?></option>
                    <?php
                    $sql = "SELECT * FROM vendor";
                    $result = mysqli_query($koneksi, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<option value='" . $row['id_vendor'] . "'>" . $row['nama_vendor'] . "</option>";
                    }

                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="stok" class="form-label">Jumlah Stok</label>
                  <input type="text" class="form-control" id="stok" name="stok" value="<?php echo $stok ?>">
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