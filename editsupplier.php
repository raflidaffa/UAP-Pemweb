<?php

include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_suplier = $_GET['id'];

    // Fetch supplier data
    $query = "SELECT * FROM suplier WHERE id_suplier = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $id_suplier);
        $stmt->execute();
        $result = $stmt->get_result();
        $supplier = $result->fetch_assoc();

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid request.";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_supplier = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $provinsi = $_POST['provinsi'];
    $telepon = $_POST['telepon'];

    // Update supplier data
    $query = "UPDATE suplier SET nama_suplier = ?, alamat = ?, kota = ?, provinsi = ?, telepon = ? WHERE id_suplier = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("sssssi", $nama_supplier, $alamat, $kota, $provinsi, $telepon, $id_suplier);
        if ($stmt->execute()) {
            echo "<script>alert('Supplier updated successfully'); window.location='kelolasupplier.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close the connection
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Supplier</title>
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
        .navbar {
            margin-bottom: 20px;
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
            <a href="keloladaftarhp.php" class="list-group-item list-group-item-action bg-primary text-white active">Daftar Handphone</a>
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
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <h1>Admin</h1>
            <h2>Edit Supplier</h2>
            <div class="form-container">
                <form action="editsupplier.php?id=<?php echo $id_suplier; ?>" method="post">
                    <div class="form-group">
                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="<?php echo $supplier['nama_suplier']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $supplier['alamat']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="kota">Kota</label>
                        <input type="text" class="form-control" id="kota" name="kota" value="<?php echo $supplier['kota']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?php echo $supplier['provinsi']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $supplier['telepon']; ?>" required>
                    </div>
                    
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                </form>
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
