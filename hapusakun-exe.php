<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_akun = $_GET['id'];

    // Check if the account exists
    $query = "SELECT * FROM akun WHERE id_akun = ?";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $id_akun);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Account exists, proceed with deletion confirmation
            if (isset($_POST['confirm'])) {
                if ($_POST['confirm'] === 'ok') {
                    // Delete the account
                    $delete_query = "DELETE FROM akun WHERE id_akun = ?";
                    
                    if ($stmt = $conn->prepare($delete_query)) {
                        $stmt->bind_param("i", $id_akun);
                        
                        if ($stmt->execute()) {
                            echo "<script>alert('Akun telah dihapus.'); window.location='kelolapengguna.php';</script>";
                            exit();
                        } else {
                            echo "Error: " . $delete_query . "<br>" . $conn->error;
                        }
                    } else {
                        echo "Error preparing delete statement: " . $conn->error;
                    }
                } else {
                    echo "<script>alert('Penghapusan akun dibatalkan.'); window.location='kelolapengguna.php';</script>";
                    exit();
                }
            } else {
                // Show confirmation dialog
                echo "<script>
                        if (confirm('Apakah Anda yakin ingin menghapus akun ini?')) {
                            document.write('<form method=\"post\" style=\"display:none;\"><input type=\"hidden\" name=\"confirm\" value=\"ok\"><input type=\"submit\"></form>');
                            document.forms[0].submit();
                        } else {
                            window.location = 'kelolapengguna.php';
                        }
                      </script>";
            }
        } else {
            echo "Akun tidak ditemukan.";
        }
        
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    
    $conn->close();
} else {
    echo "ID akun tidak ditemukan.";
}
?>
