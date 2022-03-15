<?php 
include 'koneksi.php';
$id = $_GET['id'];
session_start();
date_default_timezone_set('Asia/Jakarta');
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;

}

$tgl = date('Y-m-d');
$tglcek = date('Y-m');
$hari = date('d');
$bulan = date('m');
$tahun = date("Y");
if ($hari) {
	
	$kuari = mysqli_query($koneksi,"SELECT * FROM pegawai INNER JOIN bagian ON pegawai.bagian = bagian.id_bagian WHERE id_pegawai = '$id'");
	$data = mysqli_fetch_assoc($kuari);
	$kacau = mysqli_query($koneksi,"SELECT * FROM absen WHERE id = '$id' AND tahun = '$tahun' AND bulan = '$bulan'");
	$anj = mysqli_num_rows($kacau);
	$bikin = mysqli_query($koneksi,"SELECT SUM(telat) as gblk FROM absen WHERE id = '$id'")->fetch_array();
	$lembur = mysqli_query($koneksi,"SELECT SUM(jam) as jumlah FROM lembur WHERE id_pegawai = '$id'")->fetch_array();
	$no_lembur = mysqli_query($koneksi,"SELECT * FROM no_lembur")->fetch_assoc();
	$lelem = $lembur['jumlah'] * $no_lembur['harga'];
	$gaji = mysqli_query($koneksi,"SELECT * FROM bagian INNER JOIN pegawai ON bagian.id_bagian = pegawai.bagian WHERE id_pegawai = '$id'");
	$lah = mysqli_fetch_assoc($gaji);
	$telat = mysqli_query($koneksi,"SELECT * FROM telat")->fetch_assoc();
	$telatt = $bikin['gblk'] * $telat['harga'];
	$kok = $anj * $lah['gaji'];
	$papk = $anj * $lah['gaji'];
	$hasill = rupiah($anj * $lah['gaji']);
	$sopa = mysqli_query($koneksi,"SELECT * FROM pegawai INNER JOIN bagian ON pegawai.bagian = bagian.id_bagian WHERE id_pegawai = '$id'")->fetch_assoc();
	$liuk = $sopa['pokok'];
	
	$total = $kok + $liuk + $lelem - $telatt;
	
}else{
	echo "<script>
	document.location.href = 'belom.php';
	</script>";
}

$bank = mysqli_query($koneksi,"SELECT * FROM gajian WHERE tanggal = '$bulan' AND id_pegawai = '$id'");
$paksa = mysqli_num_rows($bank);
if (isset($_POST['submit'])) {
	$nih = mysqli_query($koneksi,"INSERT INTO gajian VALUES ('','$id','0','$bulan','1','$total')");
	$noh = mysqli_query($koneksi,"INSERT INTO rekap VALUES('','$id','$total', '$telatt','$tgl','$total')");
	if ($nih) {
		echo "<script>alert('gaji sukses');
		document.location.href = 'laporan.php';
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
		#pront{
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
		<div class="container">
			<div class="card" style=" border: 1px solid black; ">
				<div class="card-header" style=" background-color:#00a98f; color: white; float: left; ">
					<h2 align="center">Slip Gaji</h2>
				</div>
				<div class="card-body" style=" font-size: 20px; ">
					Pembayaran Bulann : <?php echo $tgl ?>
					<br>
					Pegawai =<b> <?php echo $data['nama_pegawai'] ?></b>
					<br><br>
					<div class="row">
						<div class="col-sm-6"><table border="1">
							<table class="table">
								<thead>
									<tr>
										<th scope="col">Penghasilan</th>
										<th scope="col">Ket</th>
										<th scope="col">Rp</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Gaji Pokok</td>
										<td>-</td>
										<td><?php echo rupiah($liuk); ?></td>
									</tr>
									<tr>
										<td>absen</td>
										<td><?php echo $anj ?> hari</td>
										<td><?php echo $hasill; ?></td>
									</tr>
									<tr>
										<td>Lembur</td>
										<td><?php echo $lembur['jumlah']; ?> jam</td>
										<td><?php echo rupiah($lelem) ?></td>
										
									</tr>
								</tbody>
							</table>
							
						</div>	
						<div class="col-sm-6">
							<table class="table">
								<thead>
									<tr>
										<th scope="col">Potongan</th>
										<th scope="col">Keterangan</th>
										<th scope="col">Rp</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Telat</td>
										<?php if ($bikin['gblk'] == 0): ?>
											<td>0 jam</td>
										<?php endif ?>
										<?php if ($bikin['gblk'] > 0): ?>
											<td><?php echo $bikin['gblk'] ?> jam</td>
										<?php endif ?>
										
										<td><?php echo rupiah($telatt) ?></td>
									</tr>
								</tbody>
							</table>
							
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-6"><center><p>Total = <b><?php echo rupiah($total); ?></b></center></p></div>
						<div class="col-sm-6"><p style=" font-size: 14px; ">Cileungsi. <?php echo $tgl ?></p><br><?php echo $_SESSION['nama'] ?> <small>"HRD"</small></div>
					</div>

				</div>
			</div>
			<br>
			<div class="container" align="center">
				<div class="row">
					<div class="col-sm-7"><button type="button" id="print" onclick="window.print()" class="btn btn-primary">Print</button></div>
					<?php if ($paksa == 0): ?>
						<form method="POST">
							<div class="col-sm-"><button type="submit" name="submit" id="pront" class="btn btn-primary">Berikan gaji</button></div></form>
						<?php endif ?>

					</div>
				</div>
				<br><br>
			</div>
		</main>

		<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
	</body>
	</html>