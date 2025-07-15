<?php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin_umkm') {
    echo "Akses ditolak!";
    exit;
}

include 'config/db.php';

$id_umkm = $_GET['id'];
$id_user = $_SESSION['user_id'];

$sql = "SELECT * FROM umkm WHERE id_umkm = ? AND id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id_umkm, $id_user);
$stmt->execute();
$result = $stmt->get_result();
$umkm = $result->fetch_assoc();

if (!$umkm) {
    echo "Data UMKM tidak ditemukan atau bukan milik Anda.";
    exit;
}
?>

<h2>Edit Profil UMKM</h2>

<form action="process/edit_profil_umkm_process.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_umkm" value="<?= $umkm['id_umkm'] ?>">

    <label>Nama UMKM:</label><br>
    <input type="text" name="nama_umkm" value="<?= $umkm['nama_umkm'] ?>" required><br><br>

    <label>Kategori:</label><br>
    <input type="text" name="kategori" value="<?= $umkm['kategori'] ?>" required><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi" rows="4" required><?= $umkm['deskripsi'] ?></textarea><br><br>

    <label>Alamat:</label><br>
    <textarea name="alamat" rows="3" required><?= $umkm['alamat'] ?></textarea><br><br>

    <label>Kontak:</label><br>
    <input type="text" name="kontak" value="<?= $umkm['kontak'] ?>" required><br><br>

    <label>Logo Saat Ini:</label><br>
    <img src="uploads/logo/<?= $umkm['logo'] ?>" width="100"><br><br>

    <label>Ganti Logo (jika perlu):</label><br>
    <input type="file" name="logo" accept="image/*"><br><br>

    <button type="submit">Simpan Perubahan</button>
</form>
