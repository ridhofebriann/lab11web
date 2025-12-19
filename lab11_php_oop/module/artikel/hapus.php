<?php
// --- KODE PROTEKSI ---
if (!isset($_SESSION['is_login'])) {
    header('Location: http://localhost/lab11_php_oop/index.php/user/login');
    exit();
}
// ---------------------

// Logika Hapus Data
$id = $_GET['id'];
$db = new Database();
$sql = "DELETE FROM data_barang WHERE id_barang = '{$id}'";
$result = $db->query($sql);

header('Location: index'); // Kembali ke tabel
exit();
?>