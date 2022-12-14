<?php
include '../Connection/koneksi.php';

session_start();
//kalai session nya username dan role
if (isset($_SESSION["nama"]) && isset($_SESSION["role"])) {

?>

  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Buku Manajemen</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <!-- nama akun -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-user"></i>
              <span class="badge badge-danger navbar-badge"></span>
              <!-- nama akun dari session -->
              <?php echo $_COOKIE['nama'] ?>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-item dropdown-header">Akun</span>
              <div class="dropdown-divider"></div>
              <a href="../logout.php" class="dropdown-item">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
              </a>
            </div>
          </li>
        </ul>

      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="../index.php" class="brand-link">
          <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Buku Manajemen</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="../index.php" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-header">MASTER DATA</li>
              <li class="nav-item">
                <a href="../buku/index.php" class="nav-link">
                  <i class="nav-icon fas fa-pencil-alt"></i>
                  <p>
                    Buku
                  </p>
                </a>
              </li>
              <?php if ($_SESSION['role'] == '1') { ?>
                <li class="nav-item">
                  <a href="../jenisbuku/index.php" class="nav-link">
                    <i class="nav-icon fas fa-stream"></i>
                    <p>
                      Jenis Buku
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../vendor/index.php" class="nav-link">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                      Vendor
                    </p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Buku</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                  <li class="breadcrumb-item active">Data Buku</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- jika session bukan addmin button hilang -->
            <?php if ($_SESSION['role'] == '1') { ?>
              <a href="create.php"><button class="btn btn-primary">Tambah</button></a>
            <?php } ?>
            <button class="btn btn-success" onclick="search()" name="print"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Download </button><br><br>


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Buku</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Id Buku</th>
                      <th>Nama Buku</th>
                      <th>Jenis Buku</th>
                      <th>Vendor</th>
                      <th>Stok</th>
                      <?php if ($_SESSION['role'] == '1') { ?>
                        <th>Action</th>
                      <?php } ?>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    //view data jenis widh id
                    $sql = "SELECT id_buku,nama_buku,jenis_buku.nama_jenis_buku,vendor.nama_vendor,jml_stok FROM buku inner join jenis_buku on buku.id_jenis_buku = jenis_buku.id_jenis_buku inner join vendor on buku.id_vendor = vendor.id_vendor;";
                    $result = mysqli_query($koneksi, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id_buku'];
                        $nama = $row['nama_buku'];
                        $jenis = $row['nama_jenis_buku'];
                        $vendor = $row['nama_vendor'];
                        $stok = $row['jml_stok'];

                        echo "<tr>";
                        echo "<td>" . $id . "</td>";
                        echo "<td>" . $nama . "</td>";
                        echo "<td>" . $jenis . "</td>";
                        echo "<td>" . $vendor . "</td>";
                        echo "<td>" . $stok . "</td>";
                        if ($_SESSION['role'] == '1') {
                          echo "<td><a href='edit.php?id=$id'><button class='btn btn-primary'>Edit</button></a> <a href='?id=$id'><button class='btn btn-danger'>Delete</button></a></td>";
                        }
                        echo "</tr>";
                      }
                    }

                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <div id="jam"></div>
        </div>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

    <!-- page script -->
    <script>
      $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
        });
      });

      function search() {
        var value = $('.dataTables_filter input').val();
        console.log(value); // <-- the value 
        var data = {
          "search": value
        };

        window.location.href = "sheet.php?search=" + value;
      }

      setInterval(function() {
        var waktu = new Date();
        var jam = waktu.getHours();
        var menit = waktu.getMinutes();
        var detik = waktu.getSeconds();
        var jam = jam < 10 ? "0" + jam : jam;
        var menit = menit < 10 ? "0" + menit : menit;
        var detik = detik < 10 ? "0" + detik : detik;
        var jam = jam < 10 ? "0" + jam : jam;

        var jam = jam + ":" + menit + ":" + detik;
        document.getElementById("jam").innerHTML = jam + " ";
      }, 1000);
    </script>
  </body>

  </html>

<?php
} else {
  echo "<script language=\"javascript\">alert(\"Please login\");document.location.href='../login.php';</script>";
}
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  deletedata($id);
}

function deletedata($id)
{
  include '../Connection/koneksi.php';
  $delete = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku='$id'");
  if ($delete) {
    echo "<script>alert('Data Berhasil Dihapus');window.location.href='index.php';</script>";
  } else {
    echo "<script>alert('Data Gagal Dihapus');window.location.href='index.php';</script>";
  }
}
?>