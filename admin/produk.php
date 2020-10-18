<?php 

	session_start();
	if(!isset($_SESSION['login'])) {
        header('location: ../login.php');
        exit;
	}
  date_default_timezone_set("Asia/Jakarta");

	if($_SESSION['level'] == 1 ) {
		require_once '../function.php';
    $kategori = mysqli_query($con, "SELECT * from kategori");
    $sub_kategori = mysqli_query($con, "SELECT * FROM sub_kategori");
		$produk = mysqli_query($con, "SELECT idproduk, p.nama as produk, deskripsi, k.idkategori, sk.idsub_kategori, file_gambar, harga, jumlah, last_update, pg.idpegawai, nama_kategori, sk.nama as sub_kategori, username, nama_lengkap, email, level  FROM kategori k JOIN sub_kategori sk on k.idkategori=sk.idkategori JOIN produk p on sk.idsub_kategori=p.idsub_kategori join pegawai pg on p.idpegawai=pg.idpegawai");

    if (isset($_POST['simpan'])) {
      $idkategori = $_POST['kategori'];
      $idsub_kategori = $_POST['sub_kategori'];
      $nama = htmlspecialchars($_POST['nama']);
      $deskripsi = htmlspecialchars($_POST['deskripsi']);
      $harga = htmlspecialchars($_POST['harga']);
      $jumlah = htmlspecialchars($_POST['jumlah']);

      $idpegawai = $_SESSION['idpegawai'];

      $idproduk = idproduk($idsub_kategori);

      $tgl = date("Ymdhis");

      //upload gambar
      $gambar = upload();
      if (!$gambar) {
        return false;
      }



      $query = "INSERT INTO produk VALUES ($idproduk,'$nama','$deskripsi',$idkategori,$idsub_kategori,'$gambar',$harga,$jumlah,$tgl,$idpegawai)";
      mysqli_query($con, $query);
      if (mysqli_affected_rows($con)>0) {
        echo "
          <script>
            alert('Berhasil!');
          </script>
        ";
        echo "<script>location='produk.php';</script>";
      } else {
        echo "
          <script>
            alert('Gagal!');
          </script>
        ";
      }

    }





	} else {
		header('location : ../pesan.php');
		exit;
	}
	
	function upload(){
      $namafile = $_FILES['gambar']['name'];
      $ukuran = $_FILES['gambar']['size'];
      $error = $_FILES['gambar']['error'];
      $tmpname = $_FILES['gambar']['tmp_name'];

      // cek appakah ada gambar yg diupload
      if ($error === 4) {
        echo "<script>
            alert('Anda tidak memilih gambar');
            </script>";
        return false;
      }

      // cek yang diupload gambar atau bukan
      $gambarvalid = ['jpg','jpeg','png'];
      $extgambar = explode('.',$namafile);
      $extgambar = strtolower(end($extgambar));
      if (!in_array($extgambar, $gambarvalid)) {
        echo "<script>
              alert('gambar bro, jangan yang lain');
              </script>";
        return false;     
          
      }

      // lolos pengecekan
      // generate nama gambar baru
      $namafilebaru = uniqid();
      $namafilebaru .= '.';
      $namafilebaru .= $extgambar;
      move_uploaded_file($tmpname, '../img/'.$namafilebaru);
      
      return $namafilebaru;
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
      <li class="nav-item ">
        <a class="nav-link" href="sub_kategori.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Sub Kategori</span></a>
      </li>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="produk.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Produk</span></a>
      </li>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
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
            <h1 class="h3 mb-0 text-gray-800">Produk</h1>
          </div>

		<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Produk</h6>
            </div>


			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			       <form method="post" action="" enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="inputState">Kategori</label>
                  <select id="kategori" name="kategori" onchange="getsub()" class="form-control" required>
                    <option selected>Choose...</option>
                    <?php foreach ($kategori as $ktgr) : ?>
                      <option value="<?= $ktgr['idkategori'] ?>"><?= $ktgr['nama_kategori'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="inputState">Sub Kategori</label>
                  <select id="sub_kategori" name="sub_kategori" class="form-control" required>
                    <option selected>Choose...</option>
                    
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="nama">Nama Produk</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Produk" required>
              </div>
              <div class="form-group">
                <label for="deskripsi">Deskripsi Produk</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
              </div>

              <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
              </div>

              <div class="form-group">
                <label for="gambar">Gambar produk</label>
                <input type="file" class="form-control-file" id="gambar" name="gambar" required>
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
        			  Tambah Produk
        			</button>
              <div class="alert alert-<?php if(isset($alert)) echo $alert[0][0] ?>">
                <?php if (isset($alert)) echo $alert[0][1]; ?>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Produk</th>
                      <th>Kategori</th>
                      <th>Harga</th>
                      <th>Jumlah</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php 
                  		$no=1; 
                      
                  		while ($row = $produk->fetch_array()) {
                        $a = 'a'.$row['idproduk'];
                  			echo "
								        <tr>
			                      <td>".$no."</td>
                            <td>".$row['produk']."</td>
                            <td>".$row['nama_kategori']."</td>
                            <td>".$row['harga']."</td>
			                      <td>".$row['jumlah']."</td>
			                      <td>
                            <a href='detail_produk.php?id=".$row['idproduk']."'><button type='button' class='btn btn-info btn-sm ml-3'>Detail</button></a>
				                  	<a href='edit_produk.php?id=".$row['idproduk']."'><button type='button' class='btn btn-success btn-sm ml-3'>Edit</button></a>
                            <a data-toggle='modal' data-target='#".$a."'><button type='button' class='btn btn-danger btn-sm ml-3'>Hapus</button></a>
			                      </td>
								        </tr>
	                  		";
	                  		$no++;


                        echo '
                        <div class="modal fade" id="'.$a.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Produk</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <div class="modal-body">Hapus Produk <b>'.$row['produk'].'</b>?</div>
                              <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                <a class="btn btn-primary" href="hapus_produk.php?id='.$row['idproduk'].'">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>';
                  		}
                  		
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
  <script src="fungsi.js"></script>
  <!-- <script src="../js/jquery-3.3.1.slim.min.js"></script> -->
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>

</body>

</html>
