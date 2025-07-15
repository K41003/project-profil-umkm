<?php
session_start();
include '../config/db.php';

$id_produk = $_POST['id_produk'];
$nama_produk = $_POST['nama_produk'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];

// Cek apakah user memang pemilik produk
$sqlCheck = "SELECT p.*, u.id_user FROM produk p
             JOIN umkm u ON p.id_umkm = u.id_umkm
             WHERE p.id_produk = ? AND u.id_user = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("ii", $id_produk, $_SESSION['user_id']);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();
$produk = $resultCheck->fetch_assoc();

if (!$produk) {
    echo "Produk tidak ditemukan atau bukan milik Anda.";
    exit;
}

// Cek apakah user mengupload foto baru
if ($_FILES['foto']['name']) {
    $foto_name = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $target_dir = "../uploads/produk/";
    $target_file = $target_dir . basename($foto_name);

    if (move_uploaded_file($tmp_name, $target_file)) {
        // Hapus foto lama (opsional)
        $foto_lama = "../uploads/produk/" . $produk['foto'];
        if (file_exists($foto_lama)) unlink($foto_lama);

        $update = "UPDATE produk SET nama_produk=?, deskripsi=?, harga=?, foto=? WHERE id_produk=?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param("ssdsi", $nama_produk, $deskripsi, $harga, $foto_name, $id_produk);
    } else {
        echo "Upload gambar baru gagal!";
        exit;
    }
} else {
    // Tanpa ganti foto
    $update = "UPDATE produk SET nama_produk=?, deskripsi=?, harga=? WHERE id_produk=?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("ssdi", $nama_produk, $deskripsi, $harga, $id_produk);
}

if ($stmt->execute()) {
    header("Location: ../index.php?page=dashboard");
} else {
    echo "Gagal update data.";
}
?>
