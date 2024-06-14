<?php
session_start(); // Mulai session

if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: sign_in.php");
    exit();
}

include 'koneksi.php'; // Include file koneksi.php

// Pastikan $_GET['id_hp'] tidak kosong
if (isset($_GET['id_hp'])) {
    $id_hp = $_GET['id_hp'];

    // Query untuk memasukkan barang ke dalam tabel keranjang
    $id_akun = $_SESSION['id_akun']; // Pastikan id_akun sudah tersimpan di session
    $query_insert = "INSERT INTO keranjang (id_hp, id_akun) VALUES ('$id_hp', '$id_akun')";
    $result = $conn->query($query_insert);

    if ($result) {
        echo "<script>
                alert('Barang berhasil dimasukkan ke keranjang.');
                window.location.href = 'belanja_session.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal memasukkan barang ke keranjang: " . $conn->error . "');
                window.location.href = 'belanja_session.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID HP tidak ditemukan.');
            window.location.href = 'belanja_session.php';
          </script>";
}

// Tutup koneksi setelah selesai menggunakan
$conn->close();
?>
