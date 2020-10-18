<?php 

	session_start();
	if(!isset($_SESSION['login'])) {
        header('location: ../login.php');
        exit;
	}

	if($_SESSION['level'] == 2 ) {
		require_once '../function.php';

		$kategori = mysqli_query($con, "SELECT k.idkategori as idkategori, k.nama_kategori as kategori, COUNT(p.idproduk) as jumlah FROM kategori k JOIN produk p on k.idkategori=p.idkategori GROUP BY k.idkategori");

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

  <title>Dashboard Manager</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

<script type="text/javascript" src="../vendor/chartjs/Chart.js"></script>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-text mx-3">Manager Ten Shop</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Kategori</span></a>
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
            <h1 class="h3 mb-0 text-gray-800">Kategori</h1>
          </div>


             <table class="table table-success table-bordered table-hover">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Kategori</th>
                  <th scope="col">Sub Kategori</th>
                  <th scope="col">Produk</th>
                </tr>
              </thead>

              <tbody>
                <?php while ($row = mysqli_fetch_array($kategori)) {
                  $idktgr = $row['idkategori'];
                  $subs = mysqli_query($con, "SELECT sk.idsub_kategori as idsub_kategori, sk.nama as sub, COUNT(p.nama) as jumlah FROM sub_kategori sk JOIN produk p on sk.idsub_kategori=p.idsub_kategori WHERE p.idkategori=$idktgr GROUP BY sk.idsub_kategori");

                      echo '
                        <tr>
                          <td rowspan ='.$row['jumlah'].'>'.$row['kategori'].'</td>';

                  while ($row1 = mysqli_fetch_array($subs)) {
                    $idsub = $row1['idsub_kategori'];
                    $produk = mysqli_query($con, "SELECT * FROM produk WHERE idsub_kategori=$idsub");
                      echo '
                          <td rowspan ='.$row1['jumlah'].'>'.$row1['sub'].'</td>';
                    while($row2 = mysqli_fetch_array($produk)) {
                      echo '
                          <td>'.$row2['nama'].'</td>
                        </tr>';
                    }  
                  }
                }
                ?>
              </tbody>
            </table>

 

      <!-- Page Heading -->
        <div>

      <br>  
      <br>  
      <center>
        <h2>GRAFIK PRODUK<br/></h2>
      </center>
 
 
 
  <div style="width: 800px;margin: 0px auto;">
    <canvas id="myChart"></canvas>
  </div>
 
  <br/>
  <br/>
 
  <table border="1" id="db_tokopakaian2" class="display">
    <!-- <thead> -->
      <!-- <tr> -->
              <!-- <th scope="col">Kategori</th> -->
             <!--  <th scope="col">Sub Kategori</th>
              <th scope="col">Produk</th>
            </tr>
    </thead> -->
<!-- <tbody>
            <tr>
              <td rowspan = 3>Pakaian Pria</td>
              <td>Kemeja</td>
              <td>Batik</td>
            </tr>

            <tr>
              <td>Celana Panjang</td>
              <td>Jeans</td>
            </tr>

            <tr>
              <td>Celana Pendek</td>
              <td>Kain</td>
            </tr>

            <tr>
              <td rowspan = 3>Pakaian Wanita</td>
              <td>Resmi</td>
              <td>Batik</td>
            </tr>

            <tr>
              <td>Atasan Wanita</td>
              <td>Paris</td>
            </tr>

            <tr>
              <td>Rok</td>
              <td>Baloteli</td>
            </tr>

            <tr>
              <td rowspan = 1>Pakaian Anak</td>
              <td>Setelan Anak</td>
              <td>Setelan Anak</td>

          </tbody>
        </table>
        </table>
        </table>

    <tbody> -->
      <?php 
      $no = 1;
      $data = mysqli_query($con,"select nama_kategori, COUNT(nama_kategori) from kategori k JOIN produk p ON k.idkategori=p.idkategori GROUP BY k.nama_kategori");
      while($d=mysqli_connect_errno($data)){
        ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $d['kategori']; ?></td>
          <td><?php echo $d['sub_kategori']; ?></td>
          <td><?php echo $d['produk']; ?></td>
        </tr>
        <?php 
      }
      ?>
    </tbody>
  </table>

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


  
  <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Pakaian Pria", "Pakaian Wanita", "Pakaian Anak"],
        datasets: [{
          label: 'Grafik Data Produk',
          data: [
          <?php 

            $pakaian_pria = mysqli_query($con, "SELECT * from produk WHERE idkategori=1");
            echo mysqli_num_rows($pakaian_pria);
          ?>, 
          <?php 

            $pakaian_wanita = mysqli_query($con, "SELECT * from produk WHERE idkategori=2");
            echo mysqli_num_rows($pakaian_wanita);
          ?>, 
          <?php 

            $pakaian_anak = mysqli_query($con, "SELECT * from produk WHERE idkategori=3");
            echo mysqli_num_rows($pakaian_anak);
          ?>, 
        
          ],
          backgroundColor: [
          'rgba(200, 0, 0 , 0.9)',
          'rgba(0, 100, 0 , 0.9)',
          'rgba(0, 0, 100 , 0.9)'
          ],
          borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });
  </script>
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->

  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>
