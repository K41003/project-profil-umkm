<?php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin_umkm') {
    echo "Akses ditolak!";
    exit;
}

include 'config/db.php';

// Ambil data UMKM milik user login
$id_user = $_SESSION['user_id'];
$sql = "SELECT * FROM umkm WHERE id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$umkm = $result->fetch_assoc();

if (!$umkm) {
    echo "Profil UMKM belum diisi.";
    exit;
}

$id_umkm = $umkm['id_umkm'];
?>

<h2>Tambah Produk</h2>

<form action="process/tambah_produk_process.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_umkm" value="<?= $id_umkm ?>">

    <label>Nama Produk:</label><br>
    <input type="text" name="nama_produk" required><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi" rows="4" required></textarea><br><br>

    <label>Harga:</label><br>
    <input type="number" name="harga" required><br><br>

    <label>Foto Produk:</label><br>
    <input type="file" name="foto" accept="image/*" required><br><br>

    <button type="submit">Simpan Produk</button>
</form>
