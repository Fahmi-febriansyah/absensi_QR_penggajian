<?php 
include 'koneksi.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = mysqli_query($koneksi,"SELECT * FROM pegawai WHERE id_pegawai = '$id'")->fetch_assoc();
	$quera = mysqli_query($koneksi,"SELECT pegawai.id_pegawai, bagian.bagian, bagian.id_bagian FROM pegawai INNER JOIN bagian on pegawai.bagian = bagian.id_bagian WHERE id_pegawai = '$id'")->fetch_assoc();
	$kuari = mysqli_query($koneksi,"SELECT * FROM bagian");

	if (isset($_POST['submit'])) {
		$nama = $_POST['nama'];
		$tgl = $_POST['tgl'];
		$alamat = $_POST['alamat'];
		$bagian = $_POST['bagian'];
		$tlp = $_POST['tlp'];

		$ubah = mysqli_query($koneksi,"UPDATE `pegawai` SET `nama_pegawai`='$nama',`tanggal_lahir`='$tgl',`alamat`='$alamat',`no_tlp`='$tlp',`bagian`='$bagian' WHERE id_pegawai = $id");
		if ($ubah) {
			echo "<script>alert('Data berhasil diubah');
			document.location.href = 'data_pegawai.php';
			</script>";
		}else{
			echo "<script>alert('Data gagal diubah');
			document.location.href = 'data_pegawai.php';
			</script>";
		}
	}
}else{
	header("location: data_pegawai.php");
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
		<br>
		<div class="container shadow-lg p-3 mb-5 bg-white rounded">
			<h4>Ubah Data pegawai</h4>
			<hr>
			<form method="post">
				<label for=""><b>Nama pegawai</b></label>
				<br>
				<input type="text" style=" width:100%;" value="<?php echo $query['nama_pegawai'] ?>" name="nama" placeholder="masukan nama pegawai">
				<br><br>
				<label for=""><b>Tanggal Lahir</b></label>
				<br>
				<input type="date" name="tgl" style=" width:100%;" >
				<br><br>
				<label for=""><b>alamat</b></label>
				<br>
				<input type="text" value="<?php echo $query['alamat'] ?>" style=" width:100%;" name="alamat" placeholder="masukan alamat pegawai">

				<div class="form-group my-3">
					<label for="basic-url"><b>Bagian</b></label>
					<select class="form-control" id="type" name="bagian">
						<?php while( $row = mysqli_fetch_assoc($kuari) ) : ?>
							<option value="<?= $row['id_bagian'] ?>"><?= $row['bagian'] ?></option>
						<?php endwhile; ?>
					</select>
					<small>Bagian awal adalah <b><?php echo $quera['bagian'] ?></b></small>
				</div>
				<label for=""><b>No Telpon</b></label>
				<br>
				<input type="number" style=" width:100%;" name="tlp" value="<?php echo $query['no_tlp'] ?>" placeholder="masukan nomor telpon pegawai">
				<br><br>
				<button type="submit" name="submit" class="btn btn-primary">Kirim</button>
			</form>
		</div>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>