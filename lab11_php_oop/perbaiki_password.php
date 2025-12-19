<?php
// File: perbaiki_password.php
include "config.php";
require "class/Database.php";

// Kita akan mengubah password admin menjadi: admin123
// password_hash() akan mengubahnya menjadi kode enkripsi yang sah
$password_baru = password_hash("admin123", PASSWORD_DEFAULT);

$db = new Database();
// Update password user 'admin' dengan password yang sudah di-enkripsi
$sql = "UPDATE users SET password = '{$password_baru}' WHERE username = 'admin'";

if ($db->query($sql)) {
    echo "<h1>✅ BERHASIL! Database Sudah Diperbaiki.</h1>";
    echo "Password 'admin' sekarang sudah diubah menjadi kode Enkripsi.<br>";
    echo "Silakan Login dengan:<br>";
    echo "Username: <b>admin</b><br>";
    echo "Password: <b>admin123</b><br>";
    echo "<br><a href='index.php/user/login'>Klik Disini Untuk Login</a>";
} else {
    echo "❌ Gagal update. Cek koneksi database kamu.";
}
?>