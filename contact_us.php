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

    <section id="contact-page">
          <div class="container">
              <div class="large-title text-center m-4">        
                  <h2>Tuliskan Pesanmu</h2>
                  <p>Jika ada complain tentang pemesanan, silahkan tuliskan pesan di bawah ini. Happy Shopping!</p>
              </div> 
              <div class="row contact-wrap"> 
                  <div class="status alert alert-success" style="display: none"></div>
                  <!-- <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="sendemail.php"> -->
                      <div class="col-sm-5 col-sm-offset-1">
                          <div class="form-group m-15" >
                              <label>Name *</label>
                              <input type="text" name="name" class="form-control" required="required">
                          </div>
                          <div class="form-group">
                              <label>Email *</label>
                              <input type="email" name="email" class="form-control" required="required">
                          </div>
                          <div class="form-group">
                              <label>Phone</label>
                              <input type="number" class="form-control">
                          </div>
                          <div class="form-group">
                              <label>Company Name</label>
                              <input type="text" class="form-control">
                          </div>                        
                      </div>
                      <div class="col-sm-5">
                          <div class="form-group">
                              <label>Subject *</label>
                              <input type="text" name="subject" class="form-control" required="required">
                          </div>
                          <div class="form-group">
                              <label>Message *</label>
                              <textarea name="message" id="message" required="required" class="form-control" rows="8"></textarea>
                          </div>                        
                          <div class="form-group">
                              <button type="button" name="button" class="btn btn-primary center-block" required="required">Submit Message</button>
                          </div>
                      </div>
                  <!-- </form>  -->
              </div><!--/.row-->
          </div><!--/.container-->
      </section><!--/#contact-page-->
    <div class="justify-content-center">
      <h5 class="text-center font-weight-bold m-4">Contact Us</h5>
      <p class="text-center m-3"> Telephone : 081-276-333-986</p>
      <p class="text-center m-4"> E-mail    : ten's@allshop.com</p>
    </div>
  </div>
  </div>
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