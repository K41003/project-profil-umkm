<?php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin_umkm') {
    echo "Akses ditolak!";
    exit;
}

include 'config/db.php';

// Cek apakah user sudah punya data UMKM
$id_user = $_SESSION['user_id'];
$sql = "SELECT * FROM umkm WHERE id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$umkm = $result->fetch_assoc();
?>

<h2>Dashboard UMKM</h2>

<?php if (!$umkm): ?>
    <p>Anda belum mengisi profil UMKM.</p>
    <a href="index.php?page=profil_umkm_form">Isi Profil UMKM</a>
<?php else: ?>
    <h3>Profil Usaha: <?= $umkm['nama_umkm'] ?></h3>
    <p>Kategori: <?= $umkm['kategori'] ?></p>
    <p>Deskripsi: <?= $umkm['deskripsi'] ?></p>
    <p>Alamat: <?= $umkm['alamat'] ?></p>
    <p>Kontak: <?= $umkm['kontak'] ?></p>
    <a href="index.php?page=edit_profil_umkm&id=<?= $umkm['id_umkm'] ?>">Edit Profil</a>

    <hr>

    <h3>Daftar Produk</h3>
    <a href="index.php?page=tambah_produk">+ Tambah Produk</a>
    <br><br>
    <?php
    $id_umkm = $umkm['id_umkm'];
    $produk = $conn->query("SELECT * FROM produk WHERE id_umkm = $id_umkm");
    while ($p = $produk->fetch_assoc()):
    ?>
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <strong><?= $p['nama_produk'] ?></strong><br>
            <?= $p['deskripsi'] ?><br>
            Harga: Rp<?= number_format($p['harga'], 0, ',', '.') ?><br>
            <img src="uploads/produk/<?= $p['foto'] ?>" width="100"><br>
            <a href="index.php?page=edit_produk&id=<?= $p['id_produk'] ?>">Edit</a>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
