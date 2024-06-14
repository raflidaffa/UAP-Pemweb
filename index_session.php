<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'user') {
    header("Location: sign_in.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            <h1><a href="index_session.php">OTER HANDPHONE</a></h1>
            <ul>
                <li class="active"><a href="index_session.php">HOME</a></li>
                <li><a href="belanja_session.php">BELANJA</a></li>
                <li><a href="keranjang_session.php"><i class="fas fa-shopping-basket"></i></a></li>
                <?php if(isset($_SESSION['email'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="sign_in.php">Sign In</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>

    <!-- banner -->
    <section class="banner">
        <a href="BELANJA.html"></a>
    </section>

    <!-- about -->
    <section class="about">
        <div class="container">
            <h3>ABOUT</h3>
            <p>(OH) Oter Handphone adalah perusahaan yang bergerak di bidang penjualan handphone dan aksesori handphone secara online. Berdiri sejak tahun [UAP 2024], kami berkomitmen untuk memberikan produk berkualitas dengan harga yang kompetitif, serta layanan pelanggan yang terbaik.</p>
        </div>
    </section>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - OTER HANDPHONE. All Right reserves.</small>
        </div>
    </footer>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".bg-loader").hide();
        });
    </script>
</body>
</html>
