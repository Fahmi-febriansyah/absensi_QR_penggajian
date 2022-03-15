<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>


	<script>
		Swal.fire({
			position: 'top-center',
			icon: 'success',
			title: 'Absen Hari ini berhasil',
			showConfirmButton: false,
			timer: 1500

		})
		setTimeout(pindah, 1500);
		function pindah(){
			document.location.href = 'baca.php';
		}
		
	</script>
</body>
</html>