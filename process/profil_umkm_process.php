<?php
session_start();
include '../config/db.php';

$id_user = $_SESSION['user_id'];
$nama_umkm = $_POST['nama_umkm'];
$kategori = $_POST['kategori'];
$deskripsi = $_POST['deskripsi'];
$alamat = $_POST['alamat'];
$kontak = $_POST['kontak'];

// Upload logo
$logo_name = $_FILES['logo']['name'];
$tmp_name = $_FILES['logo']['tmp_name'];
$target_dir = "../uploads/logo/";
$target_file = $target_dir . basename($logo_name);

// Cek & pindahkan file
if (move_uploaded_file($tmp_name, $target_file)) {
    $sql = "INSERT INTO umkm (id_user, nama_umkm, kategori, deskripsi, alamat, kontak, logo)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $id_user, $nama_umkm, $kategori, $deskripsi, $alamat, $kontak, $logo_name);

    if ($stmt->execute()) {
        header("Location: ../index.php?page=dashboard");
    } else {
        echo "Gagal simpan profil.";
    }
} else {
    echo "Upload logo gagal!";
}
?>
