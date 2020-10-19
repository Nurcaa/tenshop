<?php

session_start();
if (!isset($_SESSION['login'])) {
  header('location: ../login.php');
  print_r(exit);
}

if ($_SESSION['level'] == 1) {
  require_once '../function.php';

  // $pegawai = mysqli_query($con, "SELECT * FROM pegawai");
  $pegawai = "SELECT * FROM pegawai";
  $result = mysqli_query($con, $pegawai);

  $pgw = mysqli_fetch_array($result, MYSQLI_BOTH);
  if ($pgw['level'] == 1) {
    $status = 'Admin';
  } else if ($pgw['level'] == 2) {
    $status = 'Manager';
  }

  if (isset($_POST['simpan'])) {

    $username = htmlspecialchars($_POST['username']);
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $level = htmlspecialchars($_POST['level']);

    // cek usernmae sudah ada belum
    $result = mysqli_query($con, "SELECT * FROM pegawai WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
      echo "<script>
             alert('username sudah terdaftar');
           </script>";
      return false;
    }

    mysqli_query($con, "INSERT INTO pegawai VALUES ('','$username','$nama','$email','$password',$level)");
    if (mysqli_affected_rows($con) > 0) {
      echo "<script>
          alert('User baru berhasil ditambahkan!')
          </script>";
      echo "<script>location='pegawai.php';</script>";
    } else {
      $alert[] = ["danger", "User baru <b>gagal</b> ditambahkan!"];
    }
  }
} else {
  header('location : ../pesan.php');
  exit;
}




?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard Admin</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-text mx-3">Admin Ten Shop</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item ">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Kategori</span></a>
      </li>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="sub_kategori.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Sub Kategori</span></a>
      </li>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="produk.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Produk</span></a>
      </li>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="pegawai.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Pegawai</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username'] ?></span>
                <img class="img-profile rounded-circle" src="../img/profile.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="edit_profil.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pegawai</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Pegawai</h6>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="">
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="username" required>
                      </div>
                      <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="email" required>
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                      </div>
                      <div class="form-group">
                        <label for="level">Level</label>
                        <select id="level" name="level" class="form-control" required>
                          <option selected>Choose...</option>
                          <option value="1">Admin</option>
                          <option value="2">Manager</option>
                        </select>
                      </div>

                      <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Pegawai
              </button>
              <div class="alert alert-<?php if (isset($alert)) echo $alert[0][0] ?>">
                <?php if (isset($alert)) echo $alert[0][1]; ?>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                  <thead>
                    <tr>
                      <th>id pegawai</th>
                      <th>username</th>
                      <th>nama lengkap</th>
                      <th>email</th>
                      <th>password</th>
                      <th>level</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <?php $id = 1; ?>
                  <?php $result = $con->query("SELECT * FROM pegawai"); ?>
                  <?php while ($row = $result->fetch_assoc()) {
                    $a = 'a' . $row['idpegawai']; ?>
                    <tr>
                      <td><?php echo $id; ?></td>
                      <td><?php echo $row['username']; ?></td>
                      <td><?php echo $row['nama_lengkap']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['password']; ?></td>
                      <td><?php echo $row['level']; ?></td>
                      <td>
                        <a href="detail_pegawai.php?id=<?= $row['idpegawai'] ?>" class="btn btn-info btn-sm ml-3">Detail</a>
                        <a href="edit_pegawai.php?id=<?= $row['idpegawai'] ?>" class="btn btn-success btn-sm ml-3">Edit</a>
                        <a data-toggle='modal' data-target='#<?= $a ?>'><button type='button' class='btn btn-danger btn-sm ml-3'>Hapus</button></a>
                      </td>
                    </tr>

                    <div class="modal fade" id=<?= $a ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pegawai</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">Hapus <b><?= $row['username'] ?></b>?</div>
                          <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <a class="btn btn-primary" href="hapus_pegawai.php?id=<?= $row['idpegawai'] ?>">Hapus</a>
                          </div>
                        </div>
                      </div>
                    </div>


                    <?PHP $id++; ?>
                  <?php } ?>
                  <?php
                  echo 'Total Rows = ' . $result->num_rows;
                  $result->free();
                  $con->close();
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Ten's Shop 2019</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="../logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>