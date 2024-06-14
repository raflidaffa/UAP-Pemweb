<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header("Location: sign_in.php");
    exit();
}

include 'koneksi.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM handphone WHERE id_hp = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['submit'])) {
    $nama_hp = $_POST['nama_hp'];
    $merk_hp = $_POST['merk_hp'];
    $harga = $_POST['harga'];

    // Mengatur direktori tujuan upload
    $target_dir = "gambar_hp/";
    $uploadOk = 1;
    $file_name = $row['gambar']; // Default to current image

    if (!empty($_FILES["fileToUpload"]["tmp_name"])) {
        $temp_file = $_FILES["fileToUpload"]["tmp_name"];
        $file_name = $_FILES["fileToUpload"]["name"];
        $target_file = $target_dir . basename($file_name);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Cek apakah file adalah gambar sebenarnya
        $check = getimagesize($temp_file);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }

        // Hanya izinkan format file tertentu
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
            $uploadOk = 0;
        }

        // Cek apakah $uploadOk bernilai 0 karena error
        if ($uploadOk == 0) {
            echo "Maaf, file anda tidak ter-upload.";
        } else {
            if (!move_uploaded_file($temp_file, $target_file)) {
                echo "Maaf, terjadi kesalahan saat mengupload file anda.";
                $uploadOk = 0;
            }
        }
    }

    if ($uploadOk) {
        $query = "UPDATE handphone SET nama_hp='$nama_hp', merk_hp='$merk_hp', harga='$harga', gambar='$file_name' WHERE id_hp=$id";
    } else {
        $query = "UPDATE handphone SET nama_hp='$nama_hp', merk_hp='$merk_hp', harga='$harga' WHERE id_hp=$id";
    }

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data HP berhasil diupdate'); window.location='keloladaftarhp.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Data HP</title>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Admin <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <h1>Admin</h1>
            <h2>Edit Data HP</h2>
            <div class="form-container">
                <form action="edit_hp.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama_hp">Nama HP</label>
                        <input type="text" class="form-control" id="nama_hp" name="nama_hp" value="<?php echo $row['nama_hp']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="merk_hp">Merk HP</label>
                        <input type="text" class="form-control" id="merk_hp" name="merk_hp" value="<?php echo $row['merk_hp']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fileToUpload">Gambar HP</label>
                        <input type="file" class="form-control-file" id="fileToUpload" name="fileToUpload">
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
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
</body>
</html>
