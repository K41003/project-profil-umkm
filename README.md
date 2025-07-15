# 🌐 Project Profil UMKM Web

Website ini adalah aplikasi sederhana berbasis PHP dan MySQL untuk menampilkan profil UMKM beserta daftar produk/jasa yang mereka tawarkan.

---

## 📦 Fitur

- Register & Login dengan hash password
- Dashboard untuk UMKM
- Tambah/Edit Hapus Produk
- Edit Profil UMKM
- Halaman Publik Profil UMKM
- Logout
- Responsive untuk ditampilkan di browser

---

## 🧑‍💻 Cara Menjalankan Proyek Ini (Lokal)

1. Clone atau download repository ini:
```bash
git clone https://github.com/username/Project_Profil_UMKM.git
Pindahkan folder ke direktori:

C:\xampp\htdocs\Project_Profil_UMKM
Buka XAMPP Control Panel, jalankan Apache & MySQL

Buka browser → http://localhost/phpmyadmin

Buat database baru:
umkm_db

Import file SQL dari folder ini:
database_umkm.sql

Buka di browser:
http://localhost/Project_Profil_UMKM

Struktur Kode
Project_Profil_UMKM/
├── config/
├── pages/
├── process/
├── uploads/
│   ├── logo/
│   └── produk/
├── database_umkm.sql
├── index.php
├── README.md
├── .gitignore