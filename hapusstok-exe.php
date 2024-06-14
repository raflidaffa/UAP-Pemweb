<?php
include 'koneksi.php';

if (isset($_GET['id_hp']) && isset($_GET['id_suplier'])) {
    $id_hp = $_GET['id_hp'];
    $id_suplier = $_GET['id_suplier'];

    // Check if the stock exists
    $query = "SELECT * FROM stok WHERE id_hp = ? AND id_suplier = ?";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ii", $id_hp, $id_suplier);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Stock exists, proceed with deletion confirmation
            if (isset($_POST['confirm'])) {
                if ($_POST['confirm'] === 'ok') {
                    // Delete the stock
                    $delete_query = "DELETE FROM stok WHERE id_hp = ? AND id_suplier = ?";
                    
                    if ($stmt = $conn->prepare($delete_query)) {
                        $stmt->bind_param("ii", $id_hp, $id_suplier);
                        
                        if ($stmt->execute()) {
                            echo "<script>alert('Stok telah dihapus.'); window.location='kelolastok.php';</script>";
                            exit();
                        } else {
                            echo "Error: " . $delete_query . "<br>" . $conn->error;
                        }
                    } else {
                        echo "Error preparing delete statement: " . $conn->error;
                    }
                } else {
                    echo "<script>alert('Penghapusan stok dibatalkan.'); window.location='kelolastok.php';</script>";
                    exit();
                }
            } else {
                // Show confirmation dialog
                echo "<script>
                        if (confirm('Apakah Anda yakin ingin menghapus stok ini?')) {
                            document.write('<form method=\"post\" style=\"display:none;\"><input type=\"hidden\" name=\"confirm\" value=\"ok\"><input type=\"submit\"></form>');
                            document.forms[0].submit();
                        } else {
                            window.location = 'kelolastok.php';
                        }
                      </script>";
            }
        } else {
            echo "Stok tidak ditemukan.";
        }
        
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    
    $conn->close();
} else {
    echo "ID handphone atau supplier tidak ditemukan.";
}
?>
