<?php 
session_start();
$jam = $_SESSION['lemburo'];
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
			title: 'anda lembur selama <?php echo $jam ?> jam',
			showConfirmButton: false,
			timer: 1500

		})
		setTimeout(pindah, 1500);
		function pindah(){
			document.location.href = 'logouta.php';
		}
		
	</script>
</body>
</html>