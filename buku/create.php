<?php include '../layout/header.php';
include '../Connection/koneksi.php';

if (isset($_POST['submit'])) {
  $id = $_POST['idbuku'];
  $nama = $_POST['nama'];
  $jenis = $_POST['jenis'];
  $vendor = $_POST['vendor'];
  $stok = $_POST['stok'];

  $insert = "INSERT INTO buku (id_buku, nama_buku, id_jenis_buku, id_vendor, jml_stok) VALUES ('$id', '$nama', '$jenis', '$vendor', '$stok')";
  $result = mysqli_query($koneksi, $insert);


  if ($result) {
    echo "<script>window.location.href='index.php'</script>";
  } else {
    echo "<script>alert('Data gagal ditambahkan!'); window.location.href='create.php'</script>";
  }
}
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Create Buku</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Create Buku</li>
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
                  <label for="idatk" class="form-label">ID Buku</label>
                  <input type="text" class="form-control" id="idbuku" name="idbuku" value="<?php echo idotomatis() ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="nama" class="form-label">Nama Buku</label>
                  <input type="text" class="form-control" id="nama" name="nama">
                </div>

                <div class="form-group">
                  <label for="jenis" class="form-label">Jenis</label>
                  <select id="jenis" class="form-select" name="jenis">
                    <option selected>Choose...</option>
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
                    <option selected>Choose...</option>
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
                  <input type="number" class="form-control" id="stok" name="stok">
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



function idotomatis()
{
  include '../Connection/koneksi.php';
  $query = mysqli_query($koneksi, "SELECT max(id_buku) as maxKode FROM buku");
  $data = mysqli_fetch_array($query);
  $idBuku = $data['maxKode'];

  $noUrut = (int) substr($idBuku, 3, 3);
  $noUrut++;

  $char = "BKU";
  $newID = $char . sprintf("%03s", $noUrut);
  return $newID;
}
?>

<?php include '../layout/footer.php'; ?>