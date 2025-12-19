<?php
include "config.php";
require "class/Database.php";

// Kita paksa ubah password jadi "admin123"
// password_hash() akan membuatkan kode enkripsi yang 100% VALID buat laptopmu
$password_baru = password_hash("admin123", PASSWORD_DEFAULT);

$db = new Database();
$sql = "UPDATE users SET password = '{$password_baru}' WHERE username = 'admin'";

if ($db->query($sql)) {
    echo "<h1>✅ BERHASIL!</h1>";
    echo "Password user 'admin' sudah di-reset.<br>";
    echo "Sekarang coba login pakai password: <b>admin123</b>";
    echo "<br><br><a href='index.php/user/login'>Klik untuk Login</a>";
} else {
    echo "Gagal update. Cek config.php kamu.";
}
?>