<?php
if (!isset($_SESSION['is_login'])) {
    header('Location: http://localhost/lab11_php_oop/index.php/user/login');
    exit();
}

$id = $_GET['id'];
$db = new Database();

// Ambil data lama
$sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'";
$data = mysqli_fetch_array($db->query($sql));

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    
    // Logika Update Gambar
    $gambar = $data['gambar']; // Default pakai gambar lama
    if (!empty($_FILES['gambar']['name'])) {
        $nama_file = $_FILES['gambar']['name'];
        $tmp_file  = $_FILES['gambar']['tmp_name'];
        $folder_tujuan = __DIR__ . "/../../img/";
        
        if (move_uploaded_file($tmp_file, $folder_tujuan . $nama_file)) {
            $gambar = $nama_file; // Kalau upload sukses, ganti nama gambar
        }
    }

    $sql_update = "UPDATE data_barang SET 
                   nama = '{$nama}', kategori = '{$kategori}', 
                   harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}', 
                   stok = '{$stok}', gambar = '{$gambar}' 
                   WHERE id_barang = '{$id}'";
    
    if ($db->query($sql_update)) {
        header('Location: index');
    } else {
        echo "Gagal update data.";
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-custom">
            <h3 class="fw-bold mb-4 text-warning">✏️ Ubah Data Barang</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="fw-bold">Nama Barang</label>
                    <input type="text" class="form-control" name="nama" value="<?= $data['nama']; ?>">
                </div>
                <div class="row">
                     <div class="col-md-6 mb-3">
                        <label class="fw-bold">Kategori</label>
                        <select class="form-select" name="kategori">
                            <option value="Elektronik" <?= ($data['kategori'] == 'Elektronik') ? 'selected' : ''; ?>>Elektronik</option>
                            <option value="Fashion" <?= ($data['kategori'] == 'Fashion') ? 'selected' : ''; ?>>Fashion</option>
                            <option value="Furniture" <?= ($data['kategori'] == 'Furniture') ? 'selected' : ''; ?>>Furniture</option>
                        </select>
                    </div>
                     <div class="col-md-6 mb-3">
                        <label class="fw-bold">Stok</label>
                        <input type="number" class="form-control" name="stok" value="<?= $data['stok']; ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Harga Beli</label>
                        <input type="number" class="form-control" name="harga_beli" value="<?= $data['harga_beli']; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Harga Jual</label>
                        <input type="number" class="form-control" name="harga_jual" value="<?= $data['harga_jual']; ?>">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="fw-bold">Ganti Gambar (Opsional)</label><br>
                    <img src="/lab11_php_oop/img/<?= $data['gambar']; ?>" width="80" class="mb-2 border rounded">
                    <input type="file" class="form-control" name="gambar">
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" name="submit" class="btn btn-warning text-white btn-custom">Update Data</button>
                    <a href="index" class="btn btn-light btn-custom">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>