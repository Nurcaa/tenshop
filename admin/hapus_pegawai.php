<?php 

session_start();
	if(!isset($_SESSION['login'])) {
        header('location: ../login.php');
        exit;
	}

	if($_SESSION['level'] == 1 ) {
		require_once '../function.php';

		$id = $_GET['id'];
		$kategori = mysqli_query($con, "DELETE FROM pegawai WHERE idpegawai=$id");
		
		if (mysqli_affected_rows($con)>0) {
			echo "<script>
					alert('Data pegawai terhapus!')
				  </script>";
			echo "<script>location='pegawai.php';</script>";
		
		} else {
			header('location : ../pesan.php');
			exit;
		}
	}
 ?>