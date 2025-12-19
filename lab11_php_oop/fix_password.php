<?php
// File: fix_password.php
include "config.php";
require "class/Database.php";

// Kita akan mereset password user 'admin' menjadi 'admin123'
// password_hash() akan mengubah 'admin123' menjadi kode acak yang valid
$password_baru = password_hash("admin123", PASSWORD_DEFAULT);

$db = new Database();
// Update password di database dengan versi yang sudah di-enkripsi
$sql = "UPDATE users SET password = '{$password_baru}' WHERE username = 'admin'";

if ($db->query($sql)) {
    echo "<h1>✅ BERHASIL DI-RESET!</h1>";
    echo "<p>Password di database sudah diubah menjadi format Enkripsi (Hash).</p>";
    echo "<p>Silakan Login dengan:</p>";
    echo "<ul>";
    echo "<li>Username: <b>admin</b></li>";
    echo "<li>Password: <b>admin123</b></li>";
    echo "</ul>";
    echo "<br><a href='index.php/user/login'>Klik Disini Untuk Login</a>";
} else {
    echo "❌ Gagal update. Pastikan config.php sudah benar.";
}
?>