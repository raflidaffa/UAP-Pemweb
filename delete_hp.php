<?php 
include "koneksi.php";

if (isset($_GET['id'])) {
    $id_hp = $_GET['id']; 
    $query = "SELECT * FROM handphone WHERE id_hp = '$id_hp'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (isset($_POST['confirm'])) {
            if ($_POST['confirm'] === 'ok') {
                $delete_query = "DELETE FROM  handphone WHERE id_hp='$id_hp'";
                if (mysqli_query($conn, $delete_query)) {
                    echo "<script>alert('Data berhasil dihapus.'); window.location='keloladaftarhp.php';</script>";
                } else {
                    echo "Error: " . $delete_query . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "<script>alert('Penghapusan data dibatalkan.'); window.location='keloladaftarhp.php';</script>";
            }
        } else {
            echo "<script>
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    document.write('<form method=\"post\" style=\"display:none;\"><input type=\"hidden\" name=\"confirm\" value=\"ok\"><input type=\"submit\"></form>');
                    document.forms[0].submit();
                } else {
                    window.location = 'keloladaftarhp.php';
                }
                </script>";
        }
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
