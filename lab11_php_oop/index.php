<?php
session_start(); // WAJIB ADA DI BARIS PERTAMA

include "config.php";
require "class/Database.php";
require "class/Form.php";

$mod = $_GET['mod'] ?? 'home';
$page = $_GET['page'] ?? 'index';

if (isset($_SERVER['PATH_INFO'])) {
    $path = trim($_SERVER['PATH_INFO'], '/');
    $segments = explode('/', $path);
    if (count($segments) >= 2) {
        $mod = $segments[0];
        $page = $segments[1];
    }
}

$file = "module/{$mod}/{$page}.php";
include "template/header.php";

if (file_exists($file)) {
    include $file;
} else {
    echo '<div class="container mt-5 alert alert-danger">Error 404: Halaman tidak ditemukan.</div>';
}

include "template/footer.php";
?>