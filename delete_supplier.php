<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header("Location: sign_in.php");
    exit();
}

include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_suplier = $_GET['id'];

    // Prepare the delete statement
    $query = "DELETE FROM suplier WHERE id_suplier = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $id_suplier);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Supplier deleted successfully'); window.location='kelolasupplier.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

// Close the connection
$conn->close();
?>
