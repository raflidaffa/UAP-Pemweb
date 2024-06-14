<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama_hp = $_POST['nama_hp'];
    $merk_hp = $_POST['merk_hp'];
    $harga = $_POST['harga'];

    $query = "UPDATE handphone SET nama_hp='$nama_hp', merk_hp='$merk_hp' , harga='$harga' , jumlah='$jumlah' , deskripsi='$deskripsi' WHERE id_aset=$id_aset";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data aset berhasil dirubah'); window.location='keloladaftaraset_admin.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>