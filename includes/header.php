<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profil UMKM</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php session_start(); ?>
    <nav>
        <a href="index.php">Beranda</a>
        <?php if (isset($_SESSION['user_id'])):?>
            <span>Hai, <?= $_SESSION['user_name'] ?></span>
            <a href="logout.php" onclick="return confirm('Yakin ingin logout?')">Logout</a>

        <?php else: ?>
        <a href="index.php?page=login">Login</a>
        <a href="index.php?page=register">Register</a>
        <?php endif; ?>
    </nav>