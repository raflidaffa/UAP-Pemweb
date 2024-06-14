<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header("Location: sign_in.php");
    exit();
}

include 'koneksi.php';

$query = "SELECT handphone.id_hp, suplier.id_suplier, handphone.nama_hp, handphone.merk_hp, suplier.nama_suplier, stok.jumlah_stok
          FROM stok
          INNER JOIN handphone ON stok.id_hp = handphone.id_hp
          INNER JOIN suplier ON stok.id_suplier = suplier.id_suplier";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Stok Handphone</title>
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
            transition: all 0.3s;
        }
        .sidebar.toggled {
            margin-left: -250px;
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
        .navbar {
            margin-bottom: 20px;
        }
        .table-container {
            margin-top: 20px;
        }
        .table-container h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="wrapper" id="wrapper">
        <!-- Sidebar -->
        <div class="sidebar border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">OTER HANDPHONE</div>
            <div class="list-group list-group-flush">
                <a href="keloladaftarhp.php" class="list-group-item list-group-item-action bg-primary text-white">Daftar Handphone</a>
                <a href="kelolapengguna.php" class="list-group-item list-group-item-action bg-primary text-white">Pengguna</a>
                <a href="kelolasupplier.php" class="list-group-item list-group-item-action bg-primary text-white">Supplier</a>
                <a href="#" class="list-group-item list-group-item-action bg-primary text-white active">Stok</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div class="content" id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
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
                <h2>Daftar Stok Handphone</h2>
                <a href="tambahstok.php" class="btn btn-success mb-3">TAMBAH STOK</a>
                <div class="table-container">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nama HP</th>
                                <th>Merk</th>
                                <th>Nama Supplier</th>
                                <th>Jumlah Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row["nama_hp"] . "</td>";
                                    echo "<td>" . $row["merk_hp"] . "</td>";
                                    echo "<td>" . $row["nama_suplier"] . "</td>";
                                    echo "<td>" . $row["jumlah_stok"] . "</td>";
                                    echo '<td>
                                            <a href="edit_stok.php?id_hp=' . $row["id_hp"] . '&id_suplier=' . $row["id_suplier"] . '" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="hapusstok-exe.php?id_hp=' . $row["id_hp"] . '&id_suplier=' . $row["id_suplier"] . '" class="btn btn-danger btn-sm">Delete</a>
                                          </td>';
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
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
