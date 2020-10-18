<?php 

  session_start();
  // var_dump($_SESSION);
  if (!isset($_SESSION["login"])) {
    header("Location : login.php");
    exit;
  }

  require 'function.php';
  if (isset($_POST["submit"])) {
    // $pass_lama = $_POST['pass_lama'];
    $pass_baru = $_POST['pass_baru'];
    $konfir_password = $_POST['konfir_password'];

    if ($pass_baru == $konfir_password) { 
      $level = $_SESSION["level"];
      $username = $_SESSION["user"];

      mysqli_query($con, "UPDATE `pegawai` SET `password`='$pass_baru' WHERE level=$level and username='$username'");
      if (mysqli_affected_rows($con) > 0 ) {
        echo "
          <script>
            alert('Password berhasil diubah');
            </script>
        ";
      } else {
         echo "
          <script>
            alert('Gagal');
            </script>
        ";
      }      
    }

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
    <link rel="stylesheet" href="css/style.css">

    <title>Ganti Password</title>
  </head>
  <body>


     <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <div class="row justify-content-center">
                <div class="col-lg-8">
                  <div class="p-5">
                     <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Ganti Password</h1>
                     </div>
                     <form method="post" action="">
                      <div class="form-group">
                        <input type="text" class="form-control" id="pass_lama" name="pass_lama" required autofocus placeholder="Password lama" value="">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" id="pass_baru" name="pass_baru" required placeholder="Password baru">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" id="konfir_password" name="konfir_password" required placeholder="Konfirmasi password">
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>


    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>


