<?php 

$con = mysqli_connect('localhost','root','','db_baju');

	if (mysqli_connect_errno()){
		die ("Could not connect to the database: <br />".
		mysqli_connect_error( ));
	}





// CRUD ADMIN
function idkategori(){
	global $con;
	$result = mysqli_query($con, "SELECT max(idkategori) as id from kategori");

	$result = $result->fetch_array();
	
	$result['id']+= 1;
	
	return $result['id'];
}

function idsubkategori($idkategori){
	global $con;
	$result = mysqli_query($con, "SELECT max(idsub_kategori) as id from sub_kategori WHERE idkategori='$idkategori'");

	$result = $result->fetch_array();
	
	$result['id']+= 1;
	
	return $result['id'];
}

function idproduk($idsubkategori){
	global $con;
	$result = mysqli_query($con, "SELECT max(idproduk) as id from produk WHERE idsub_kategori='$idsubkategori'");

	$result = $result->fetch_array();
	
	$result['id']+= 1;
	
	return $result['id'];
}
