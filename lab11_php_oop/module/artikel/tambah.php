<?php
if (!isset($_SESSION['is_login'])) {
    header('Location: http://localhost/lab11_php_oop/index.php/user/login');
    exit();
}

$database = new Database();
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    
    // --- LOGIKA UPLOAD FIX ---
    $gambar = "";
    if (!empty($_FILES['gambar']['name'])) {
        $nama_file = $_FILES['gambar']['name'];
        $tmp_file  = $_FILES['gambar']['tmp_name'];
        
        // Deteksi folder img secara fisik
        $folder_tujuan = __DIR__ . "/../../img/"; 
        
        if (move_uploaded_file($tmp_file, $folder_tujuan . $nama_file)) {
            $gambar = $nama_file;
        }
    }
    // -------------------------

    $sql = "INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar) 
            VALUES ('{$nama}', '{$kategori}', '{$harga_jual}', '{$harga_beli}', '{$stok}', '{$gambar}')";
    
    if ($database->query($sql)) {
        header('Location: index');
    } else {
        echo "<div class='alert alert-danger'>Gagal menyimpan data.</div>";
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-custom">
            <h3 class="fw-bold mb-4 text-primary">➕ Tambah Barang</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Barang</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <select class="form-select" name="kategori">
                            <option value="Elektronik">Elektronik</option>
                            <option value="Fashion">Fashion</option>
                            <option value="Furniture">Furniture</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Stok</label>
                        <input type="number" class="form-control" name="stok" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Harga Beli</label>
                        <input type="number" class="form-control" name="harga_beli" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Harga Jual</label>
                        <input type="number" class="form-control" name="harga_jual" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Gambar Produk</label>
                    <input type="file" class="form-control" name="gambar">
                    <small class="text-muted">Format: jpg, png.</small>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-custom">Simpan</button>
                    <a href="index" class="btn btn-light btn-custom">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>