<?php 

include '../function.php';
$idkategori = $_GET['id'];

$sub = mysqli_query($con, "SELECT * FROM sub_kategori WHERE idkategori='$idkategori'");

if (mysqli_num_rows($sub) > 0) {
	while ($row = mysqli_fetch_array($sub)) {
		echo "<option value=".$row['idsub_kategori'].">".$row['nama']."</option>";
	}
}

 ?>