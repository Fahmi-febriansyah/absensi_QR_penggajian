<?php 
include 'koneksi.php';
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;

}
date_default_timezone_set('Asia/Jakarta');
$tgl = date('Y-m-d');
$query = mysqli_query($koneksi,"SELECT * FROM pegawai");
$pegawai = mysqli_num_rows($query);
$hadir = mysqli_query($koneksi,"SELECT * FROM absen WHERE tanggal = '$tgl'");
$kehadiran = mysqli_num_rows($hadir);
$lembur = mysqli_query($koneksi,"SELECT * FROM lembur WHERE tanggal = '$tgl'");
$kelemburan = mysqli_num_rows($lembur);
$telat = mysqli_query($koneksi,"SELECT * FROM absen WHERE telat > 0 AND tanggal = '$tgl'");
$ketelatan = mysqli_num_rows($telat);
$admin = mysqli_query($koneksi,"SELECT * FROM admin");
$keadmin = mysqli_num_rows($admin);
$brp = mysqli_query($koneksi,"SELECT * FROM no_lembur")->fetch_assoc();
$gaji = mysqli_query($koneksi,"SELECT * FROM bagian");
$berapa = mysqli_query($koneksi,"SELECT * FROM telat")->fetch_assoc();
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

	#black:hover{
		opacity: 70%;
		border-radius: 5px;
	}
</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Beranda <span class="sr-only">(current)</span></a>
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
	<br>
	<main>
		<div class="container">
			<h2>Dashboard</h2>
			<hr>
			<div class="row">
				<div class="col-sm-2 mr-3" style=" background-color: #7383ff; border-radius: 5px; ">
					<div class="row mt-4" id="black" >
						<div class="col-sm-6"><h5>Pegawai</h5> <h5><?php echo $pegawai ?></h5></div>
						<div class="col-sm-6"><img src="member.png" style=" width: 4rem; " alt=""></div>
					</div>
				</div>
				<div class="col-sm-2 mr-3" style=" background-color: #45ff42; border-radius: 5px; ">
					<div class="row mt-4" id="black" >
						<div class="col-sm-6"><h5>Hadir</h5> <h5><?php echo $kehadiran ?></h5></div>
						<div class="col-sm-6"><img src="hadir.png" style=" width: 3rem; " alt=""></div>
					</div>
				</div>
				<div class="col-sm-2 mr-3" style=" background-color: #fcff30; border-radius: 5px; ">
					<div class="row mt-4" id="black" >
						<div class="col-sm-6"><h5>Lembur</h5> <h5><?php echo $kelemburan ?></h5></div>
						<div class="col-sm-6"><img src="lembur.png" style=" width: 3rem; " alt=""></div>
					</div>
				</div>
				<div class="col-sm-2 mr-3" style=" background-color: #ff4545; border-radius: 5px; ">
					<div class="row mt-4" id="black" >
						<div class="col-sm-6"><h5>Telat</h5> <h5><?php echo $ketelatan ?></h5></div>
						<div class="col-sm-6"><img src="late.png" style=" width: 3rem; " alt=""></div>
					</div>
				</div>
				<div class="col-sm-2 mr-3" style=" background-color: #ff45a5; border-radius: 5px; ">
					<div class="row mt-4" id="black" >
						<div class="col-sm-6"><h5>Admin</h5> <h5><?php echo $keadmin ?></h5></div>
						<div class="col-sm-6"><img src="admin.png" style=" width: 3rem; " alt=""></div>
					</div>
				</div>
			</div>
		</div>
		<br><br>
		<div class="container">
			<h5>data gaji</h5>
			<div class="row">
				<div class="col-sm-7 mr-4 shadow p-3 mb-5 bg-white rounded"><table class="table">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Pekerjaan</th>
							<th scope="col">Gaji</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$tambah = 1;
						while ($data = mysqli_fetch_assoc($gaji)){ ?>
							<tr>
								<th scope="row"><?php echo $tambah ?></th>
								<td><?php echo $data['bagian'] ?></td>
								<td><?php echo rupiah($data['gaji']) ?></td>
								<td><a href="ubahgaji.php?id=<?php echo $data['id_bagian'] ?>"><button type="button" class="btn btn-primary" style=" font-size: 14px; ">Ubah</button></a></td>
							</tr>
							<?php $tambah++; ?>
						<?php } ?>
					</tbody>
				</table></div>
				<div class="col-sm-4 shadow p-3 mb-5 bg-white rounded"><center><img src="deposit.png" style="width: 2rem;" alt=""><br><b><?php echo rupiah($brp['harga']) ?></b><br>Per jam Lembur <br>
					<a href="ubahlembur.php"><button type="button" class="btn btn-dark" style=" font-size: 14px; ">Ubah</button></a><hr><img src="lema.png" style="width: 2rem;" alt=""><br><b><?php echo rupiah($berapa['harga']) ?></b><br>Per jam telat <br>
					<a href="ubahtelat.php"><button type="button" class="btn btn-warning" style=" font-size: 14px; ">Ubah</button></a></center></div>
				</div>
			</div>
		</main>

		<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
	</body>
	</html>