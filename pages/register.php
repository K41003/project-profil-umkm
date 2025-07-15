<h2>Register</h2>
<form action="process/register_process.php" method="post">
    <label>Nama:</label><br>
    <input type="text" name="nama" required><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br>

    <label>Daftar sebagai:</label><br>
    <select name="role" required>
        <option value="admin_umkm">Pemilik UMKM</option>
        <option value="visitor">Pengunjung</option>
    </select><br><br>

    <button type="submit">Daftar</button>
</form>