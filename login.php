<?php 


session_start();

if (isset($_SESSION["login"])) {
  if ($_SESSION["level"] == 1) {
    header('Location : admin/index.php');
  } else if($_SESSION["level"] == 2) {
    header('Location : manager/index.php');
  }
}

require 'function.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($con, "SELECT * FROM pegawai WHERE username='$username'");

    if (mysqli_num_rows($result) === 1) {

      $row = mysqli_fetch_assoc($result);
      if ($password == $row['password']) {
        if ($row['level'] == 1) {
          $_SESSION['login'] = true;
          $_SESSION['username'] = $username;
          $_SESSION['level'] = 1;
          $_SESSION['idpegawai'] = $row['idpegawai'];
          header('Location: admin/index.php');
          exit;
        } elseif ($row['level'] == 2) {
          $_SESSION['login'] = true;
          $_SESSION['username'] = $username;
          $_SESSION['level'] = 2;
          $_SESSION['idpegawai'] = $row['idpegawai'];
          header('Location: manager/index.php');
          exit;
        } 
      } else {
          $error_pass = "Password salah!";
          $gagal = "alert alert-danger";
      }
    } else {
      $error_username = "Username salah!";
      $gagal = "alert alert-danger";
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
    <!-- <link rel="stylesheet" href="css/style.css"> -->

    <title>Login</title>
  </head>
  <body>
     <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 md-5">
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <div class="row justify-content-center">
                <div class="col-lg-7">
                  <div class="p-5">
                     <div class="text-center">
                      <h3 class="h3 mb-4">Login</h3>
                     </div>
                     <form method="post" action="">
                      <div class="<?php if(isset($gagal)) echo $gagal ?>" role="alert">
                        <?php 
                          if(isset($error_username)) echo $error_username;
                          if(isset($error_pass)) echo $error_pass; 
                        ?>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username" required autofocus placeholder="Username" value="<?php if(isset($_POST['username'])) echo $username?>">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Password" value="<?php if(isset($_POST['password'])) echo $password?>">
                      </div>
                      <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
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
</html

