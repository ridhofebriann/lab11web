<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Praktikum 12 - Autentikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; color: #333; }
        .navbar { background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .navbar-brand, .nav-link { color: white !important; }
        .card-custom { background: white; border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); padding: 30px; margin-top: 30px; }
        .btn-custom { border-radius: 50px; font-weight: 500; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="http://localhost/lab11_php_oop/index.php/home/index">✨ Toko Ridho</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="http://localhost/lab11_php_oop/index.php/home/index">Home</a></li>
                
                <?php if(isset($_SESSION['is_login'])): ?>
                    <li class="nav-item"><a class="nav-link" href="http://localhost/lab11_php_oop/index.php/artikel/index">Data Barang</a></li>
                    <li class="nav-item"><a class="nav-link" href="http://localhost/lab11_php_oop/index.php/user/profile">Profil Akun</a></li>
                    <li class="nav-item"><a class="nav-link text-warning fw-bold" href="http://localhost/lab11_php_oop/index.php/user/logout">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link btn btn-light text-primary px-4 ms-2 btn-custom" href="http://localhost/lab11_php_oop/index.php/user/login">Login Admin</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container main-content">