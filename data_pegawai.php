<?php 
include 'koneksi.php';
session_start();
if (!$_SESSION['id']) {
	header("location: login.php");
}
$query = mysqli_query($koneksi,"SELECT * FROM pegawai");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
body{
	font-family: 'Poppins', sans-serif;
}
</style>
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
					<a class="nav-link" href="rekap.php">histori gaji<span class="sr-only">(current)</span></a>
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
		<div class="container-fluid">
			<br><br>
			<div class="row">
				<div class="col-sm-6"><h2><b>Daftar pegawai</b></h2></div>
				<div class="col-sm-6"><a class="nav-link btn btn-danger font-weight-bold" style=" width:150px; float:right; font-size:14px; " href="add_pegawai.php">Tambah</a></div>
			</div>
			
			
		</div>
		<div class="container-fluid">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Nama Pegawai</th>
						<th scope="col">alamat</th>
						<th colspan="col">aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$tambah = 1;
					while ($data = mysqli_fetch_assoc($query)){ ?>
						<tr>
							<th scope="row"><?php echo $tambah ?></th>
							<td><?php echo $data['nama_pegawai'] ?></td>
							<td><?php echo $data['alamat'] ?></td>
							<td><a href="qr.php?id=<?php echo $data['id_pegawai'] ?>" class="btn btn-primary">Kartu</a>  | <a href="ubah.php?id=<?php echo $data['id_pegawai'] ?>" class="btn btn-primary">Ubah</a></td>

						</tr>
						<?php $tambah++; ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>