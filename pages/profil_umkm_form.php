<?php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin_umkm') {
    echo "Akses ditolak!";
    exit;
}
?>

<h2>Form Profil UMKM</h2>

<form action="process/profil_umkm_process.php" method="post" enctype="multipart/form-data">
    <label>Nama UMKM:</label><br>
    <input type="text" name="nama_umkm" required><br>

    <label>Kategori:</label><br>
    <input type="text" name="kategori" required><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi" rows="4" required></textarea><br><br>

    <label>Alamat:</label><br>
    <textarea type="text" name="alamat" rows="3" required></textarea><br><br>

    <label>Kontak (No HP / Email):</label><br>
    <input type="text" name="kontak" required><br><br>

    <label>Foto UMKM:</label><br>
    <input type="file" name="logo" accept="image/*" required><br><br>

    <button type="submit">Simpan Profil</button>
</form>