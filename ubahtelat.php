<?php 
include 'koneksi.php';
$query = mysqli_query($koneksi,"SELECT * FROM telat WHERE id_telat = 1");
$data = mysqli_fetch_assoc($query);
if (isset($_POST['submit'])) {
	$harga = $_POST['harga'];
	$ubah = mysqli_query($koneksi,"UPDATE telat SET harga='$harga' WHERE id_telat = 1");
	if ($ubah) {
		echo "<script>alert('berhasil di ubah');
		document.location.href = 'dashboard.php';
		</script>";
	}else{
		echo "gagal";
	}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<style>
	@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
	body{
		font-family: 'Poppins', sans-serif;
	}
	#kartu img{
		width: 10rem;
	}
	@media print {
		body {
			-webkit-print-color-adjust: exact;
		}
		#print{
			display: none;
		}
	}

</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="dashboard.php">Beranda <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="data_pegawai.php">Pegawai <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="laporan.php">Laporan<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="data_pegawai.php">histori gaji<span class="sr-only">(current)</span></a>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			</form>
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
				<img src="teamwork.png" style=" width: 2rem; " alt="">
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="add_pegawai.php">Tambah admin</a>
				<a class="dropdown-item" href="logout.php">Logout</a>
				<a class="dropdown-item" href="#">Edit</a>
			</div>
		</div>
	</nav>
	<main>
		<br><br><br>
		<div class="container" align="center">
			<div class="card" style=" width: 600px;">
				<div class="card-header" style=" background-color:#00a98f; color: white; float: left; ">
					<div class="row">
						
						<div class="col-sm-12 pt-2"><h5 align="center">Bonus Lembur</h5></div>

						
					</div>
				</div>
				<div class="card-body" style=" font-size: 20px; ">
					<div class="row">
						<div class="col-sm-12">
							<form method="POST">
								<div class="form-group">
									<label for="exampleInputPassword1">masukan nominal</label>
									<input type="number" value="<?php echo $data['harga'] ?>" required name="harga" class="form-control" id="exampleInputPassword1">
								</div>
								<button type="submit" name="submit" class="btn btn-primary">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<br>
		</div>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>