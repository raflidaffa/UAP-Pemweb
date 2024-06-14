<!-- edit_stok.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Stok Handphone</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F4F4F9;
        }
        .wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #4e73df;
            color: white;
        }
        .sidebar .sidebar-heading {
            padding: 1.5rem;
            font-size: 1.25rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .sidebar .list-group-item {
            background-color: #4e73df;
            color: white;
        }
        .sidebar .list-group-item.active {
            background-color: #2e59d9;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">OTER HANDPHONE</div>
        <div class="list-group list-group-flush">
            <a href="keloladaftarhp.php" class="list-group-item list-group-item-action bg-primary text-white">Daftar Handphone</a>
            <a href="kelolapengguna.php" class="list-group-item list-group-item-action bg-primary text-white">Pengguna</a>
            <a href="kelolasupplier.php" class="list-group-item list-group-item-action bg-primary text-white">Supplier</a>
            <a href="kelolastok.php" class="list-group-item list-group-item-action bg-primary text-white">Stok</a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div class="content" id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <h1>Admin</h1>
            <h2>Edit Stok Handphone</h2>
            <div class="form-container">
                <?php
                // Include file koneksi database
                include 'koneksi.php';

                // Ambil ID handphone dan ID supplier dari URL
                $id_hp = $_GET['id_hp'];
                $id_supplier = $_GET['id_suplier'];

                // Query untuk mengambil data stok
                $query = "SELECT * FROM stok WHERE id_hp = '$id_hp' AND id_suplier = '$id_supplier'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <form action="proses_edit_stok.php" method="post">
                        <input type="hidden" name="id_hp" value="<?php echo $row['id_hp']; ?>">
                        <input type="hidden" name="id_suplier" value="<?php echo $row['id_suplier']; ?>">
                        <div class="form-group">
                            <label for="jumlah_stok">Jumlah Stok</label>
                            <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok" value="<?php echo $row['jumlah_stok']; ?>" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                <?php
                } else {
                    echo "Data stok tidak ditemukan.";
                }
                ?>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
