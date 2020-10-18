<?php 

require 'function.php';

$kategori = mysqli_query($con, "SELECT * FROM kategori");


  if (isset($_POST['search'])) {
    $search = htmlspecialchars($_POST['search']);
    $hasil = mysqli_query($con, "SELECT * FROM produk WHERE nama='$search'");

  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fontawesom/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>Ten's SHOP</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
      <div class= "container">

        <h3><i class="fas fa-shopping-cart text-succes mr-2"></i></h3>
        <a class="navbar-brand font-weight-bold" href="index.php">TEN'S SHOP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mr-4">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="contact_us.html">Contact Us <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="help.html">Help <span class="sr-only">(current)</span></a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0" method="post" action="">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" name="search" type="submit">Search</button>
          </form>
          <div class="icon mt-2">
            <h5>
              <i class="fas fa-cart-plus ml-3 mr-3" data-toggle="tooltip" title="Keranjang Belanja"></i>
              <i class="fas fa-envelope-open mr-3" data-toggle="tooltip" title="Kotak Masuk"></i>
              <i class="far fa-bell mr-3" data-toggle="tooltip" title="Notifikasi"></i>
            </h5>
        </div>
      </div>
</nav>

<div class="row mt-5 no-gutters">
  <div class="col-md-2 bg-light">
    <ul class="list-group list-group-flush p-2 pt-4">
      <li class="list-group-item bg-warning"><i class="fas fa-list"></i>KATEGORI PRODUK</li>
     

     
      <?php while($row = mysqli_fetch_assoc($kategori)) { 
         $id = $row['idkategori'];
        echo '
        <div class="btn-group">
          <a href="produk.php?id='.$id.'"><button type="button" class="btn btn-warning mt-2">'.$row['nama_kategori'].'</button></a>
          <button type="button" class="btn btn-warning mt-2 dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="sr-only">Toggle Dropdown</span>
          </button>
          ';
         
          $subs = mysqli_query($con, "SELECT * FROM sub_kategori WHERE idkategori=$id");
          echo '<div class="dropdown-menu">';
          while($sub = mysqli_fetch_array($subs)) {
            echo '<a class="dropdown-item" href="produk.php?id='.$sub['idsub_kategori'].'">'.$sub['nama'].'</a>'; 
          }
          echo "</div></div>";
         } ?>
    
  


    </ul>
    

    
  </div>
  
  <div class="col-md-10">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/img1.jpg" class="d-block w-100 " alt="...">
        </div>
        <div class="carousel-item">
          <img src="img/img2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="img/img3.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <h4 class="text-center font-weight-bold m-4"> PRODUK TERBARU</h4>
    <div class="row mx-auto">
      <?php 
        $produk = mysqli_query($con, "SELECT * from produk");

        while ($row = mysqli_fetch_array($produk)) {
          $a = 'a'.$row['idproduk'];
          echo "
          <div class='row ml-4  mr-2  mb-4'>
            <div class='card ml-2 mr-2 mb-4' style='width: 18rem;'>
              <img src='img/".$row['file_gambar']."' class='card-img-top' height='250px'>
              <div class='card-body bg-light'>
                <h5 class='card-title font-weight-bold'>".$row['nama']."</h5>
           
                <i class='fas fa-star text-warning'></i>
                <i class='fas fa-star  text-warning '></i>
                <i class='fas fa-star  text-warning'></i>
                <i class='fas fa-star-half-alt  text-warning'></i>
                <i class='far fa-star  text-warning'></i><br>
                <a href='#' class='btn btn-primary'  data-target='#".$a."' data-toggle='modal'>Detail</a>
                <a href='#' class='btn btn-danger'>Rp".$row['harga']."</a>
              </div>
            </div> 
          </div>
          ";

          echo "
          <div class='modal fade' id='".$a."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-lg' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title' id='exampleModalLabel'>Detail produk</h5>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
                <div class='modal-body'>
                  <div class='row'>
                    <div class='col-md-5'>
                      <img src='img/".$row['file_gambar']."'>
                    </div>
                    <div class='col-md-7'>
                      <table class='table table-borderless'>
                        <tr>
                          <th>Produk</th>
                          <td>".$row['nama']."</td>
                        </tr>
                        <tr>
                          <th>Deskripsi</th>
                          <td>".$row['deskripsi']."</td>
                        </tr>
                         
                      
                         <tr>
                          <th>Stok</th>
                          <td>".$row['jumlah']."</td>
                        </tr>
                         <tr>
                          <th>Harga</th>
                          <td>Rp".$row['harga']."</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>KEMBALI</button>
                  <button type='button' class='btn btn-primary'>BELI</button>
                </div>
              </div>
            </div>
          </div>";

        }



       ?>

    </div>
  </div>
</div>


<footer class="bg-dark text-white p-5">
  <div class="row">
    <div class="col md-3">
    <h5 class="font-weight-bold">LAYANAN PELANGGAN</h5>
    <ul>
      <li>Pusat Bantuan</li>
      <li>Cara Pembelian</li>
      <li>Pengiriman Barang</li>
      <li>Cara Pengembalian</li>
    </ul>
    </div>
    <div class="col md-3">
      <h5 class="font-weight-bold" >TENTANG KAMI</h5>
      <p>
        Ten's Shop adalah sebuah toko belanja online yang menyediakan berbagai pakaian wanita, laki-laki dan anak. 
      </p>
    </div>
    <div class="col md-3">
      <h5 class="font-weight-bold">MITRA KERJASAMA</h5>
      <ul>
        <li>JNE</li>
        <li>PT. Pos Indonesia</li>
      </ul>
    </div>
    <div class="col md-3">
      <h5 class="font-weight-bold">HUBUNGI KAMI</h5>
      <ul>
        <li>081-276-333-986</li>
        <li>ten's@allshop.com</li>
      </ul>
    </div>
  </div>
</footer>

  <div class="copyright text-center text-white font-weight-bold bg-warning p-2">
    <p>Developement by Gruop Ten <i class="far fa-copyright"></i>2019</p>
  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>