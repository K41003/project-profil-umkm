<?php
session_start();
include '../config/db.php';

$id_umkm = $_POST['id_umkm'];
$id_user = $_SESSION['user_id'];
$nama_umkm = $_POST['nama_umkm'];
$kategori = $_POST['kategori'];
$deskripsi = $_POST['deskripsi'];
$alamat = $_POST['alamat'];
$kontak = $_POST['kontak'];

// Cek apakah UMKM milik user login
$sqlCheck = "SELECT * FROM umkm WHERE id_umkm = ? AND id_user = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("ii", $id_umkm, $id_user);
$stmtCheck->execute();
$result = $stmtCheck->get_result();
$umkm = $result->fetch_assoc();

if (!$umkm) {
    echo "Data UMKM tidak valid atau bukan milik Anda.";
    exit;
}

// Apakah user upload logo baru?
if ($_FILES['logo']['name']) {
    $logo_name = $_FILES['logo']['name'];
    $tmp_name = $_FILES['logo']['tmp_name'];
    $target_dir = "../uploads/logo/";
    $target_file = $target_dir . basename($logo_name);

    if (move_uploaded_file($tmp_name, $target_file)) {
        // Hapus logo lama
        $old_logo = "../uploads/logo/" . $umkm['logo'];
        if (file_exists($old_logo)) unlink($old_logo);

        $sql = "UPDATE umkm SET nama_umkm=?, kategori=?, deskripsi=?, alamat=?, kontak=?, logo=? WHERE id_umkm=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $nama_umkm, $kategori, $deskripsi, $alamat, $kontak, $logo_name, $id_umkm);
    } else {
        echo "Upload logo baru gagal!";
        exit;
    }
} else {
    // Tidak mengganti logo
    $sql = "UPDATE umkm SET nama_umkm=?, kategori=?, deskripsi=?, alamat=?, kontak=? WHERE id_umkm=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nama_umkm, $kategori, $deskripsi, $alamat, $kontak, $id_umkm);
}

if ($stmt->execute()) {
    header("Location: ../index.php?page=dashboard");
} else {
    echo "Gagal memperbarui data.";
}
?>
