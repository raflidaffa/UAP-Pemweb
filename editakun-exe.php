<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id_akun = $_POST['id_akun'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hash the password if it is not empty
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE akun SET nama = ?, email = ?, password = ?, role = ? WHERE id_akun = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $nama, $email, $hashed_password, $role, $id_akun);
    } else {
        $sql = "UPDATE akun SET nama = ?, email = ?, role = ? WHERE id_akun = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nama, $email, $role, $id_akun);
    }

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Akun telah diubah'); window.location='kelolapengguna.php';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement
    $stmt->close();

    // Close the connection
    $conn->close();
}
?>
