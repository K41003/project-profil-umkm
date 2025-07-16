<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

include 'includes/header.php';

// Cek jika page logout, langsung jalankan logout.php dari root/process
if ($page === 'logout') {
    include 'logout.php'; // atau 'process/logout.php' tergantung lokasi kamu
} else {
    include "pages/$page.php";
}

include 'includes/footer.php';
?>
