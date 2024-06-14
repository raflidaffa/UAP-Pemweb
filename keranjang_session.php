<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'user') {
    header("Location: sign_in.php");
    exit();
}
include 'koneksi.php';

// Query untuk mengambil data keranjang yang terkait dengan id_akun saat ini
$id_akun = $_SESSION['id_akun']; // Sesuaikan dengan nama variabel session yang menyimpan id_akun
$query_keranjang = "SELECT k.id_keranjang, h.nama_hp, h.merk_hp, h.harga, h.gambar 
                    FROM keranjang k
                    INNER JOIN handphone h ON k.id_hp = h.id_hp
                    WHERE k.id_akun = '$id_akun'";
$result_keranjang = $conn->query($query_keranjang);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="oter.jpg">
    <title>Keranjang Anda</title>
    <link rel="stylesheet" type="text/css" href="css/keranjang_session.css">
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
                <li><a href="belanja_session.php">BELANJA</a></li>
                <li class="active"><a href="keranjang_session.php"><i class="fas fa-shopping-basket"></i></a></li>
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
            <p>HOME / KERANJANG</p>
        </div>
    </section>

    <!-- daftar barang -->
    <section class="daftar-barang">
        <div class="container">
            <h3>Keranjang Anda</h3>
            <?php
            if ($result_keranjang->num_rows > 0) {
                while($row = $result_keranjang->fetch_assoc()) {
                    $formatted_price = number_format($row["harga"], 2, ',', '.');
                    echo '
                    <div class="cart-item">
                        <img src="gambar_hp/' . $row["gambar"] . '" class="cart-item-img">
                        <div class="cart-item-details">
                            <h4 class="cart-item-title">' . $row["nama_hp"] . '</h4>
                            <p class="cart-item-desc">Merk: ' . $row["merk_hp"] . '</p>
                            <p class="cart-item-price">Harga: Rp ' . $formatted_price . '</p>
                        </div>
                        <div class="cart-item-actions">
                            <a href="remove.php?id_keranjang=' . $row["id_keranjang"] . '" class="btn btn-remove">Remove</a>
                            <a href="checkout.php?id_keranjang=' . $row["id_keranjang"] . '" class="btn btn-checkout">Checkout</a>
                        </div>
                    </div>';
                }
            } else {
                echo '<div class="info">
                        <h3>Keranjang anda kosong silahkan kembali <a href="belanja.php"><u>BELANJA</u></a></h3>
                      </div>';
            }
            ?>
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
        })
    </script>
</body>
</html>
