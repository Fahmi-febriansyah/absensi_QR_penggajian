<?php 
include 'koneksi.php';
$kuari = mysqli_query($koneksi,"SELECT * FROM bagian");
if (isset($_POST['submit'])) {
	$nama = $_POST['nama'];
	$tgl = $_POST['tgl'];
	$alamat = $_POST['alamat'];
	$tlp = $_POST['no'];
	$bagian = $_POST['bagian'];
	$idpagawai = rand(10000, 99999);
	include "phpqrcode/qrlib.php"; 
	$tempdir = "temp/"; 
	$teks_qrcode    =$idpagawai;
	$asli = str_replace(' ', '', $nama);
	$namafile        =$asli.".png";
	$quality        ="H";
	$ukuran           =5;
	$padding        =1;
	QRCode::png ($teks_qrcode, $tempdir.$namafile, $quality, $ukuran, $padding);
	$masuk = mysqli_query($koneksi,"INSERT INTO pegawai VALUES('$idpagawai','$nama','$tgl','$alamat','$tlp','$bagian','$namafile')");
	if ($masuk) {
		echo "<script>alert('Data berhasil ditambahkan');
		document.location.href = 'data_pegawai.php';
		</script>";
	}else{
		echo "<script>alert('data gagal ditambahkan');
		document.location.href = 'add_pegawai.php';
		</script>";
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
				<a class="dropdown-item" href="#">Tambah admin</a>
				<a class="dropdown-item" href="logout.php">Logout</a>
				<a class="dropdown-item" href="#">Edit</a>
			</div>
		</div>
	</nav>
	<main>
		<br>
		<div class="container shadow-lg p-3 mb-5 bg-white rounded">
			<h4>Formulir Pegawai</h4>
			<hr>
			<form method="post">
				<label for=""><b>Nama pegawai</b></label>
				<br>
				<input type="text" style=" width:100%;" name="nama" placeholder="masukan nama pegawai">
				<br><br>
				<label for=""><b>Tanggal Lahir</b></label>
				<br>
				<input type="date" name="tgl" style=" width:100%;" >
				<br><br>
				<label for=""><b>alamat</b></label>
				<br>
				<input type="text" style=" width:100%;" name="alamat" placeholder="masukan alamat pegawai">
				
				<div class="form-group my-3">
					<label for="basic-url"><b>Kategori</b></label>
					<select class="form-control" id="type" name="bagian">
						<?php while( $row = mysqli_fetch_assoc($kuari) ) : ?>
							<option value="<?= $row['id_bagian'] ?>"><?= $row['bagian'] ?></option>
						<?php endwhile; ?>
					</select>
				</div>
				<label for=""><b>No Telpon</b></label>
				<br>
				<input type="number" style=" width:100%;" name="no" placeholder="masukan nomor telpon pegawai">
				<br><br>
				<button type="submit" name="submit" class="btn btn-primary">Kirim</button>
			</form>
		</div>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>