<?php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin_umkm') {
    echo "Akses ditolak!";
    exit;
}

include 'config/db.php';

$id_produk = $_GET['id'];
$id_user = $_SESSION['user_id'];

// Ambil data produk berdasarkan ID dan milik UMKM user yang login
$sql = "SELECT p.*, u.id_user FROM produk p
        JOIN umkm u ON p.id_umkm = u.id_umkm
        WHERE p.id_produk = ? AND u.id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id_produk, $id_user);
$stmt->execute();
$result = $stmt->get_result();
$produk = $result->fetch_assoc();

if (!$produk) {
    echo "Produk tidak ditemukan atau bukan milik Anda.";
    exit;
}
?>

<h2>Edit Produk</h2>

<form action="process/edit_produk_process.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">

    <label>Nama Produk:</label><br>
    <input type="text" name="nama_produk" value="<?= $produk['nama_produk'] ?>" required><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi" rows="4" required><?= $produk['deskripsi'] ?></textarea><br><br>

    <label>Harga:</label><br>
    <input type="number" name="harga" value="<?= $produk['harga'] ?>" required><br><br>

    <label>Foto Saat Ini:</label><br>
    <img src="uploads/produk/<?= $produk['foto'] ?>" width="120"><br><br>

    <label>Ganti Foto Produk (jika perlu):</label><br>
    <input type="file" name="foto" accept="image/*"><br><br>

    <button type="submit">Simpan Perubahan</button>
</form>
