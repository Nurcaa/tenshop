<?php 

session_start();
	if(!isset($_SESSION['login'])) {
        header('location: ../login.php');
        exit;
	}

	if($_SESSION['level'] == 1 ) {
		require_once '../function.php';

		$id = $_GET['id'];
		$kategori = mysqli_query($con, "DELETE FROM produk WHERE idproduk=$id");
		
		if (mysqli_affected_rows($con)>0) {
			echo "<script>
					alert('Data berhasil dihapus!')
				  </script>";
			echo "<script>location='produk.php';</script>";
		
		} else {
			header('location : ../pesan.php');
			exit;
		}
	}
 ?>