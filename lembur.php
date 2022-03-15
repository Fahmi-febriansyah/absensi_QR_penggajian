<?php 
$id = $_GET['id'];
date_default_timezone_set('Asia/Jakarta');
$tgl = date('Y-m-d');
include 'koneksi.php';
$cek = mysqli_query($koneksi,"SELECT * FROM absen WHERE id = '$id' AND tanggal = '$tgl'");
if (mysqli_num_rows($cek) > 0) {
	$query = mysqli_query($koneksi,"INSERT INTO lembur VALUES('','$id','','$tgl','on')");
	if ($query) {
		echo "<script>
		alert('berhasil lembur');
		document.location.href = 'laporan.php'
		</script>";
	}else{
		echo "<script>
		alert('gagal');
		document.location.href = 'laporan.php'
		</script>";
	}
}else{
	echo "<script>
	alert('pegawai tidak hadir');
	document.location.href = 'laporan.php'
	</script>";
}



?>