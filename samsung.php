<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'user') {
    header("Location: sign_in.php");
    exit();
}
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apple Phones</title>
    <link rel="stylesheet" type="text/css" href="css/samsung.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
    <!-- label -->
    <section class="label">
        <div class="container">
            <a href="belanja_session.php">HOME</a>
            <a href="belanja_session.php"> / BELANJA</a>
            <a href="samsung.php"> / SAMSUNG</a>
        </div>
    </section>

    <!-- Xiaomi phones display section -->
    <section class="samsung-phones">
        <div class="container">
            <h3>Samsung Phones</h3>
            <div class="phone-grid">
                <?php
                $query = "SELECT id_hp, nama_hp, harga, gambar FROM handphone WHERE merk_hp = 'Samsung'";
                $result = $conn->query($query);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $formatted_price = number_format($row["harga"], 2, ',', '.');
                        echo '
                        <div class="card">
                            <img src="gambar_hp/' . $row["gambar"] . '" class="card-img-top" alt="' . $row["nama_hp"] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $row["nama_hp"] . '</h5>
                                <p class="card-text">Price: Rp ' . $formatted_price . '</p>
                                <a href="buy.php?id_hp=' . $row["id_hp"] . '" class="btn btn-primary">Buy Now</a>
                            </div>
                        </div>';
                    }
                } else {
                    echo "0 results";
                }
                
                $conn->close();
                ?>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - OTER HANDPHONE. All Rights Reserved.</small>
        </div>
    </footer>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".bg-loader").hide();
        })
    </script>
</body>
</html>
