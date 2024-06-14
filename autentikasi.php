<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Mencegah SQL Injection
    $email = mysqli_real_escape_string($conn, $email);

    $query = "SELECT * FROM akun WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['id_akun'] = $row['id_akun'];
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $row['role'];
            

            if ($row['role'] == 'admin') {
                header("Location: keloladaftarhp.php");
            } else if ($row['role'] == 'user') {
                header("Location: index_session.php");
            } else {
                echo "Ada kesalahan";
            }
            exit();
        } else {
            echo "Password salah";
        }
    } else {
        echo "Email tidak ditemukan";
    }
}
?>
