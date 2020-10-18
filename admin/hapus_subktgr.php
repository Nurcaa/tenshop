<?php 

session_start();
	if(!isset($_SESSION['login'])) {
        header('location: ../login.php');
        exit;
	}

	if($_SESSION['level'] == 1 ) {
		require_once '../function.php';

		$id = $_GET['id'];
		$kategori = mysqli_query($con, "DELETE FROM sub_kategori WHERE idsub_kategori=$id");
		
		if (mysqli_affected_rows($con)>0) {
			echo "<script>
					alert('Data berhasil dihapus!')
				  </script>";
			echo "<script>location='sub_kategori.php';</script>";
		
		} else {
			header('location : ../pesan.php');
			exit;
		}
	}
 ?>