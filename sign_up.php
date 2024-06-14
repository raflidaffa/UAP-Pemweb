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
            <h1><a href="index.html">OTER HANDPHONE</a></h1>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="belanja.php">BELANJA</a></li>
                <li><a href="keranjang.php"><i class="fas fa-shopping-basket"></i></a></li>
                <li class="active"><a href="sign_in.php">Sign In</a></li>
            </ul>
        </div>
    </header>

    <!-- sign up -->
    <div class="sign">
        <form action="register.php" method="post">
            <h1>Sign Up</h1>
            <input type="text" name="nama" placeholder="Nama Lengkap" class="txtb" required>
            <input type="email" name="email" placeholder="Email" class="txtb" required>
            <input type="password" name="password" placeholder="Password" class="txtb" required>
            <input type="submit" value="Create Account" class="signup">
            <a href="sign_in.php">Sudah punya akun?</a>
        </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".bg-loader").hide();
        });
    </script>
</body>
</html>
