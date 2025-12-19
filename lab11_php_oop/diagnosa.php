<?php
// Tampilkan semua error biar kelihatan
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "config.php";
require "class/Database.php";

echo "<h1>🔍 DIAGNOSA & PERBAIKAN OTOMATIS</h1>";
echo "<hr>";

// BAGIAN 1: CEK KONEKSI
echo "<h3>1. Cek Database</h3>";
echo "Mencoba connect ke database: <b>" . $config['db_name'] . "</b> ... <br>";

$db = new Database();
// Tes query sederhana
$cek_db = $db->query("SELECT database()");
$nama_db = mysqli_fetch_row($cek_db);

if ($nama_db[0] == $config['db_name']) {
    echo "✅ Koneksi BERHASIL. Terhubung ke: <b>" . $nama_db[0] . "</b><br>";
} else {
    echo "❌ GAGAL! Config kamu mengarah ke database lain.<br>";
    exit(); // Stop disini kalau salah DB
}

// BAGIAN 2: RESET PASSWORD (PAKSA)
echo "<h3>2. Reset Password Admin</h3>";
$pass_asli = "admin123";
// Buat hash baru yang fresh
$pass_hash = password_hash($pass_asli, PASSWORD_DEFAULT);

echo "Mengubah password user 'admin' menjadi 'admin123'...<br>";
$sql_update = "UPDATE users SET password = '{$pass_hash}' WHERE username = 'admin'";
$update = $db->query($sql_update);

if ($update) {
    echo "✅ Update Database SUKSES.<br>";
    echo "Kode Hash Baru: <small>$pass_hash</small><br>";
} else {
    echo "❌ Update Database GAGAL. Pesan: " . mysqli_error($db->conn) . "<br>";
    exit();
}

// BAGIAN 3: TES VERIFIKASI (SIMULASI LOGIN)
echo "<h3>3. Simulasi Login (Pembuktian)</h3>";
// Ambil data yang barusan kita update
$sql_cek = "SELECT * FROM users WHERE username = 'admin'";
$result = $db->query($sql_cek);
$data = mysqli_fetch_array($result);

if ($data) {
    echo "Data di Database:<br>";
    echo "- Username: " . $data['username'] . "<br>";
    echo "- Password (Hash): " . substr($data['password'], 0, 20) . "... (Terenkripsi)<br><br>";

    echo "<b>Mencoba mencocokkan 'admin123' dengan Database...</b><br>";
    
    // INI TES YANG MENENTUKAN
    if (password_verify($pass_asli, $data['password'])) {
        echo "<h2 style='color:green'>✅ HASIL: PASSWORD COCOK! (VALID)</h2>";
        echo "Sistem Login kamu SEKARANG SUDAH AMAN.<br>";
        echo "Jangan ubah apa-apa lagi di phpMyAdmin.<br><br>";
        echo "<a href='index.php/user/login' style='font-size:20px; font-weight:bold;'>👉 KLIK DISINI UNTUK LOGIN</a>";
    } else {
        echo "<h2 style='color:red'>❌ HASIL: MASIH GAGAL!</h2>";
        echo "Ada masalah aneh di server PHP/XAMPP kamu.";
    }
} else {
    echo "❌ User 'admin' tidak ditemukan! Pastikan tabel 'users' ada isinya.";
}
?>