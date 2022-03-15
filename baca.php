<?php 

if (isset($_POST['id'])) {
	$ja = $_POST['id'];
	echo $ja;
}else{

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="instascan.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<script src="jquery.min.js"></script>
	<style>
	@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

	body{
		background : url('bg-new.jpg');
		background-size: cover;
	}
	.title{
		margin-top: 200px;
	}
	.clock{
		font-size: 35px;
		color: white;
		letter-spacing: 8px;
	}
</style>
</head>
<body>
	<!-- 
	<div class="container">
		<div class="row">
			<div class="col-sm-12" align="center">
				<div id="MyClockDisplay" class="clock" onload="showTime()"></div>
				<hr>
				<h1>ABSEN PEGAWAI</h1>
				<h3>Scan Di sini</h3>

			</div>
		</div>
		<div class="row">
			<div class="col-sm-6"><img src="scan.png" style=" width:35rem; " alt="">
			</div>
			<div class="col-sm-6"><h1></h1>
				<video id="preview" width="400" height="400"></video>
			</div>
		</div>	
	</div> -->

	<div class="container py-3 px-5">
		<div class="row">
			<div class="col-md-6 pt-5 mt-2">
				<h1 class="text-center">ABSEN PEGAWAI</h1>
				<img src="waktu.png" class="w-100" alt="">
				<p class="mx-4 text-center" style="font-family: 'Poppins', sans-serif;font-weight: 600;">Menggunakan waktu dengan tepat dan bijak adalah salah satu kunci keberhasilan dalam hidup</p>
			</div>
			<div class="col-md-6">
				<div class="box rounded shadow py-4 px-3" style="background: #6DA7BB">
					<center>
						<h3 class="text-white">SILAHKAN ARAHKAN KODE QR KE KAMERA</h3>
						<video id="preview" width="350" height="350"></video>
						<div class="waktu w-75 text-center rounded mb-4" style="background: #FFFFFF45;">
							<div id="MyClockDisplay" class="clock" onload="showTime()"></div>
						</div>
					</center>
				</div>
			</div>	
		</div>
	</div>







	<script>
		function showTime(){
			var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
    	h = 12;
    }
    
    if(h > 12){
    	h = h - 12;
    	session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;
    
    setTimeout(showTime, 1000);
    
}

showTime();s
</script>
<script>
	var audio = new Audio('beep.mp3');
	let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
	scanner.addListener('scan', function(content){

		$("#qr").val(content);


		var id = (content);
		audio.play();
		setTimeout(pindah, 500);
		function pindah(){
			top.location.href="proses.php?id="+id
		}



	});

	Instascan.Camera.getCameras().then(function (cameras){
		if (cameras.length > 0){
			scanner.start(cameras[0]);
		}else{
			console.error('no camera found')
		}
	}).catch(function (e){
		console.error(e);
	});


</script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>