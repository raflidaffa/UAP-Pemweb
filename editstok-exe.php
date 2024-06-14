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
$id_hp = $_POST['id_hp'];
$id_suplier = $_POST['id_suplier'];
$jumlah_stok = $_POST['jumlah_stok'];

// Query untuk update data stok
$query = "UPDATE stok SET jumlah_stok = '$jumlah_stok' WHERE id_hp = '$id_hp' AND id_suplier = '$id_suplier'";

// Eksekusi query
if (mysqli_query($conn, $query)) {
    // Jika query berhasil dijalankan
    echo "<script>alert('Data stok berhasil diupdate');</script>";
    echo "<script>window.location = 'kelolastok.php';</script>";
} else {
    // Jika terjadi error
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Tutup koneksi database
mysqli_close($conn);
?>
