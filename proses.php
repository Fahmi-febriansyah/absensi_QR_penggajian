<?php 
include 'koneksi.php';
session_start();
$id = $_GET['id'];
date_default_timezone_set('Asia/Jakarta');
$tgl = date('Y-m-d');
$jam = date('G:i');
$hari = date("l");
$tahun = date("Y");
$bulan = date('m');
$halo = mysqli_query($koneksi,"SELECT * FROM absen WHERE id = '$id'");
$lah = mysqli_num_rows($halo);
$kuari = mysqli_query($koneksi,"SELECT * FROM absen WHERE id = '$id' AND tanggal = '$tgl' ");
$jos = mysqli_query($koneksi,"SELECT * FROM absen_pulang WHERE id_pegawai = '$id' AND tanggal = '$tgl' ");
$data = mysqli_fetch_assoc($kuari);
$cek = mysqli_query($koneksi,"SELECT * FROM pegawai WHERE id_pegawai = '$id'");
if ($lah > 22) {
	echo "<script>
	alert('Hari Libur');
	document.location.href = 'baca.php'
	</script>";
}
if ($hari == "Saturday" OR $hari == "Sunday") {
	echo "<script>
	document.location.href = 'libur.php';
	</script>";
}else{
	if ($jam >= '15:00' AND $jam <= '15:30') {
		if($jos->num_rows > 0) {
			echo "<script>
			document.location.href = 'alert.php';
			</script>";
		} else {
			$mblo = mysqli_query($koneksi,"INSERT INTO absen_pulang VALUES('','$id','$tgl','$jam')");
			if ($mblo) {
				echo "<script>
				document.location.href = 'pulang.php';
				</script>";
			}else{
				echo "<script>
				document.location.href = 'gagaal.php';
				</script>";
			}
		}
	}elseif($jam >= "07:00" AND $jam <= "10:00" ){
		if($kuari->num_rows > 0) {
			echo "<script>
			document.location.href = 'alert.php';
			</script>";
		} else {
			$masuk = mysqli_query($koneksi,"INSERT INTO absen VALUES('','$id','$tgl','$bulan','$tahun','0')");
			if ($masuk) {
				echo "<script>
				document.location.href = 'suara.php';
				</script>";
			}else{
				echo "<script>
				document.location.href = 'gagal.php';
				</script>";
			}
		}
	}elseif($jam >= "10:00" AND $jam <= "11:00" ){
		if($kuari->num_rows > 0) {
			echo "<script>
			document.location.href = 'alert.php';
			</script>";
		} else {
			$masuk = mysqli_query($koneksi,"INSERT INTO absen VALUES('','$id','$tgl','$bulan','$tahun','1')");
			$_SESSION['telat'] = '1';
			if ($masuk) {
				echo "<script>
				document.location.href = 'telat.php';
				</script>";
			}else{
				echo "<script>
				document.location.href = 'gagal.php';
				</script>";
			}
		}
	}elseif($jam >= "11:00" AND $jam <= "12:00" ){
		if($kuari->num_rows > 0) {
			echo "<script>
			document.location.href = 'alert.php';
			</script>";
		} else {
			$masuk = mysqli_query($koneksi,"INSERT INTO absen VALUES('','$id','$tgl','$bulan','$tahun','2')");
			$_SESSION['telat'] = '2';
			if ($masuk) {
				echo "<script>
				document.location.href = 'telat.php';
				</script>";
			}else{
				echo "<script>
				document.location.href = 'gagal.php';
				</script>";
			}
		}
	}elseif($jam >= "12:00" AND $jam <= "13:00" ){
		if($kuari->num_rows > 0) {
			echo "<script>
			document.location.href = 'alert.php';
			</script>";
		} else {
			$masuk = mysqli_query($koneksi,"INSERT INTO absen VALUES('','$id','$tgl','$bulan','$tahun','3')");
			$_SESSION['telat'] = '3';
			if ($masuk) {
				echo "<script>
				document.location.href = 'telat.php';
				</script>";
			}else{
				echo "<script>
				document.location.href = 'gagal.php';
				</script>";
			}
		}
	}elseif($jam >= "13:00" AND $jam <= "14:00" ){
		if($kuari->num_rows > 0) {
			echo "<script>
			document.location.href = 'alert.php';
			</script>";
		} else {
			$masuk = mysqli_query($koneksi,"INSERT INTO absen VALUES('','$id','$tgl','$bulan','$tahun','4')");
			$_SESSION['telat'] = '4';
			if ($masuk) {
				echo "<script>
				document.location.href = 'telat.php';
				</script>";
			}else{
				echo "<script>
				document.location.href = 'gagal.php';
				</script>";
			}
		}
	}elseif($jam >= "16:00" AND $jam <= "17:00" ){
		if($jos->num_rows > 0) {
			echo "<script>
			document.location.href = 'alert.php';
			</script>";
		}else{
			$mblo = mysqli_query($koneksi,"INSERT INTO absen_pulang VALUES('','$id','$tgl','$jam')");
			$lambur = mysqli_query($koneksi,"UPDATE `lembur` SET jam = '1', status = 'off' WHERE id_pegawai = '$id' AND tanggal = '$tgl' AND status = 'on'");
			$_SESSION['lemburo'] = '1';
		}
		if ($mblo) {
			echo "<script>
			document.location.href = 'lembure.php';
			</script>";
		}else{
			echo "<script>
			document.location.href = 'gagaal.php';
			</script>";
		}



	}elseif($jam >= "17:00" AND $jam <= "18:00" ){
		if($jos->num_rows > 0) {
			echo "<script>
			document.location.href = 'alert.php';
			</script>";
		}else{
			$mblo = mysqli_query($koneksi,"INSERT INTO absen_pulang VALUES('','$id','$tgl','$jam')");
			$lambur = mysqli_query($koneksi,"UPDATE `lembur` SET jam = '2', status = 'off' WHERE id_pegawai = '$id' AND tanggal = '$tgl' AND status = 'on'");
			$_SESSION['lemburo'] = '2';
		}
		if ($mblo) {
			echo "<script>
			document.location.href = 'lembure.php';
			</script>";
		}else{
			echo "<script>
			document.location.href = 'gagaal.php';
			</script>";
		}



	}else{
		echo "<script>
		document.location.href = 'lewat.php';
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
</head>
<body>

</body>
</html>