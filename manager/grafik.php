<!DOCTYPE html>
<html>
<head>
	<title>GRAFIK PRODUK</title>
<script type="text/javascript" src="../vendor/chartjs/Chart.js"></script>
</head>
<body>
	<style type="text/css">
	body{
		font-family: roboto;
	}
 
	table{
		margin: 0px auto;
	}
	</style>
 
	<center>
		<h2>GRAFIK PRODUK<br/></h2>
	</center>
 
 
	<?php 
	include '../function.php';
	?>
 
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
</body>
</html>