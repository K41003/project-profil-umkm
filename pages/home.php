<?php
include 'config/db.php';
$query = $conn->query("SELECT * FROM umkm");
while ($row = $query->fetch_assoc()) {
    echo "<div style='margin-bottom: 15px'>";
    echo "<img src='uploads/logo/{$row['logo']}' width='60'><br>";
    echo "<strong>{$row['nama_umkm']}</strong><br>";
    echo substr($row['deskripsi'], 0, 80) . "...<br>";
    echo "<a href='index.php?page=profil_umkm&id={$row['id_umkm']}'>Lihat Profil</a>";
    echo "</div>";
}
?>
