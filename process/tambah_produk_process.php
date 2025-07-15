<?php
session_start();
include '../config/db.php';

$id_umkm = $_POST['id_umkm'];
$nama_produk = $_POST['nama_produk'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];

//Upload gambar produk
$foto_name = $_FILES['foto']['name'];
$tmp_name = $_FILES['foto']['tmp_name'];
$target_dir = "../uploads/produk/";
$target_file = $target_dir . basename($foto_name);

if (move_uploaded_file($tmp_name, $target_file)) {
    $sql = "INSERT INTO produk (id_umkm, nama_produk, deskripsi, harga, foto) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issds", $id_umkm, $nama_produk, $deskripsi, $harga, $foto_name);

    if ($stmt->execute()) {
        header("Location: ../index.php?page=dashboard");
    } else {
        echo "Gagal tambah produk.";
    }
} else {
    echo "Upload foto gagal!.";
}
?>