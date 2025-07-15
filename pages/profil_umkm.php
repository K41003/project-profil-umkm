<?php
include 'config/db.php';

if (!isset($_GET['id'])) {
    echo "UMKM tidak ditemukan.";
    exit;
}

$id_umkm = $_GET['id'];

// Ambil data UMKM
$stmt = $conn->prepare("SELECT * FROM umkm WHERE id_umkm = ?");
$stmt->bind_param("i", $id_umkm);
$stmt->execute();
$result = $stmt->get_result();
$umkm = $result->fetch_assoc();

if (!$umkm) {
    echo "UMKM tidak ditemukan.";
    exit;
}
?>

<h2><?= $umkm['nama_umkm'] ?></h2>
<img src="uploads/logo/<?= $umkm['logo'] ?>" width="120" alt="Logo UMKM"><br><br>
<p><strong>Kategori:</strong> <?= $umkm['kategori'] ?></p>
<p><strong>Deskripsi:</strong> <?= nl2br($umkm['deskripsi']) ?></p>
<p><strong>Alamat:</strong> <?= nl2br($umkm['alamat']) ?></p>
<p><strong>Kontak:</strong> <?= $umkm['kontak'] ?></p>

<hr>

<h3>Produk/Jasa yang Ditawarkan</h3>
<?php
$produk = $conn->query("SELECT * FROM produk WHERE id_umkm = $id_umkm");
if ($produk->num_rows > 0):
    while ($p = $produk->fetch_assoc()):
?>
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <strong><?= $p['nama_produk'] ?></strong><br>
        <?= $p['deskripsi'] ?><br>
        Harga: Rp<?= number_format($p['harga'], 0, ',', '.') ?><br>
        <img src="uploads/produk/<?= $p['foto'] ?>" width="100"><br>
    </div>
<?php
    endwhile;
else:
    echo "<p>Belum ada produk yang ditambahkan.</p>";
endif;
?>
