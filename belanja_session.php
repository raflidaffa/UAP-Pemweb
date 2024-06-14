<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'user') {
    header("Location: sign_in.php");
    exit();
}
include 'koneksi.php'

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="uf-8">
	<meta charset="viewport" content="width=device-width, intial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="oter.jpg">
	<title>OTER HANDPHONE</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
	<!-- loader -->
	<div class="bg-loader">
		<div class="loader"></div>
	</div>

	<!-- header -->
	<div class="medsos">
		<div class="container">
			<ul>
				<li><a href="#"><i class="fab fa-facebook"></i></a></li>
				<li><a href="#"><i class="fab fa-youtube"></i></a></li>
				<li><a href="#"><i class="fab fa-instagram"></i></a></li>
			</ul>
		</div>
	</div>
	<header>
		<div class="container">
			<h1><a href="index.html">OTER HANDPHONE</a></h1>
			<ul>
				<li><a href="index_session.php">HOME</a></li>
				<li class="active"><a href="belanja_session.php">BELANJA</a></li>
				<li><a href="keranjang_session.php"><i class="fas fa-shopping-basket"></i></a></li>
				<?php if(isset($_SESSION['email'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="sign_in.php">Sign In</a></li>
                <?php endif; ?>
			</ul>
		</div>
	</header>

	<!-- label -->
	<section class="label">
		<div class="container">
			<p>HOME / BELANJA</p>
		</div>
	</section>

	<!-- gambar -->
	<selection class="gambargerak">
		<div align="center">
			<marquee width ="1200">
				<img src="img/1.jpg" height="100">
				<img src="img/2.jpg" height="100">
				<img src="img/3.jpg" height="100">
				<img src="img/4.jpg" height="100">
				<img src="img/5.jpg" height="100">
				<img src="img/6.jpg" height="100">
				<img src="img/7.jpg" height="100">
				<img src="img/9.jpg" height="100">
				<img src="img/10.jpg" height="100">
				<img src="img/11.jpg" height="100">
				<img src="img/12.jpg" height="100">
				<img src="img/13.jpg" height="100">
				<img src="img/14.jpg" height="100">
			</marquee>
		</div>
	</selection>

	<!-- kategori -->
	<section class="kategori">
		<div class="container">
			<h3>KATEGORI</h3>
			<div class="box">
				<div class="col-7">
					<a href="xiaomi.php"><img src="imgg/logo-xiaomi.jpg" height="100" ></a>
					<h4>Xiaomi</h4>
				</div>
				<div class="col-7">
					<a href="apple.php"><img src="imgg/logo-apple.png" height="100" ></a>
					<h4>Apple</h4>
				</div>
				<div class="col-7">
					<a href="samsung.php"><img src="imgg/logo-Samsung.png" height="100" ></a>
					<h4>Samsung</h4>
			</div>
		</div>
	</section>

	<!-- recomendasi -->
	<div class="rekomendasi">
		<h3>REKOMENDASI</h3>
	</div>

	<!-- beli beli -->
	<div class='gambar'>

	<div class='foto'>
		<img src='img/1.jpg'>
		<h2>Iphone 15 Promax</h2>
		<p>Rp.20.000.000,00</p> <br>
		
	</div>

	<div class='foto'>
			<img src='img/4.jpg'>
			<h2>Samsung S24 Ultra</h2>
			<p>Rp.20.000.000,00</p> <br>
			
		</div>

		<div class='foto'>
				<img src='img/5.jpg'>
				<h2>Xiaomi 14</h2>
				<p>Rp.12.000,00</p> <br>
			</div>

			<div class='foto'>
					<img src='img/14.jpg'>
					<h2>Pocophone</h2>
					<p>Rp.8.999.999,00</p><br>
				</div>

												</div> <br><br><br><br><br><br>
	</div>



	<!-- footer -->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2024 - OTER HANDPHONE. All Right reserves.</small>
		</div>
	</footer>


	<script type="text/javascript">
		$(document).ready(function() {
			$(".bg-loader").hide();
		})
	</script>
</body>
</html>