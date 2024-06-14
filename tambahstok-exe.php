<?php
// Mulai session
session_start();

// Cek apakah user sudah login sebagai admin
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header("Location: sign_in.php");
    exit();
}

// Include file koneksi database
include 'koneksi.php';

// Ambil data yang dikirimkan dari form
$nama_hp = $_POST['nama_hp'];
$nama_suplier = $_POST['nama_suplier'];
$jumlah_stok = $_POST['jumlah_stok'];

// Query untuk menyimpan data stok ke database
$query = "INSERT INTO stok (id_hp, id_suplier, jumlah_stok) 
          VALUES ('$nama_hp', '$nama_suplier', '$jumlah_stok')";

// Eksekusi query
if (mysqli_query($conn, $query)) {
    // Jika query berhasil dijalankan
    echo "<script>alert('Stok handphone berhasil ditambahkan');</script>";
    echo "<script>window.location = 'kelolastok.php';</script>";
} else {
    // Jika terjadi error
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Tutup koneksi database
mysqli_close($conn);
?>
