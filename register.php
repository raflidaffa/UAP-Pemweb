<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Mencegah SQL Injection
    $nama = mysqli_real_escape_string($conn, $nama);
    $email = mysqli_real_escape_string($conn, $email);
    $hashed_password = mysqli_real_escape_string($conn, $hashed_password);

    // Assign role as 'user'
    $role = 'user';

    // Insert user into database
    $query = "INSERT INTO akun (nama, email, password, role) VALUES ('$nama', '$email', '$hashed_password', '$role')";

    if (mysqli_query($conn, $query)) {
        echo "Akun berhasil dibuat.";
        header("Location: sign_in.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
