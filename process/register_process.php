<?php
include '../config/db.php';

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$role = $_POST['role'];

//Cek email sudah digunakan atau belum
$cek = $conn->query("SELECT * FROM users WHERE email='$email'");
if ($cek->num_rows > 0) {
    echo "Email sudah terdaftar!";
    exit;
}

//Insert user baru
$sql = "INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nama, $email, $password, $role);

if ($stmt->execute()) {
    header("Location: ../index.php?page=login");
} else {
    echo "Registrasi gagal!";
}
?>