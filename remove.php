<?php
include 'koneksi.php';

if (isset($_GET['id_keranjang'])) {
    $id_keranjang = $_GET['id_keranjang'];

    // Query untuk menghapus item dari keranjang berdasarkan id_keranjang
    $delete_query = "DELETE FROM keranjang WHERE id_keranjang = ?";
    
    if ($stmt = $conn->prepare($delete_query)) {
        $stmt->bind_param("i", $id_keranjang);
        
        if ($stmt->execute()) {
            echo "<script>alert('Item telah dihapus dari keranjang.'); window.location='keranjang_session.php';</script>";
        } else {
            echo "Error: " . $delete_query . "<br>" . $conn->error;
        }
    } else {
        echo "Error preparing delete statement: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "ID item tidak ditemukan.";
}
?>
