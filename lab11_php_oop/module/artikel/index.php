<?php
if (!isset($_SESSION['is_login'])) {
    header('Location: http://localhost/lab11_php_oop/index.php/user/login');
    exit();
}

$database = new Database();
$sql = "SELECT * FROM data_barang";
$data = $database->query($sql);
?>

<div class="card-custom">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📦 Data Barang</h2>
        <a href="tambah" class="btn btn-primary btn-custom">+ Tambah Barang</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Gambar</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Jual</th>
                    <th>Harga Beli</th>
                    <th>Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if($data): ?>
                    <?php $no = 1; foreach($data as $row): ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center">
                            <img src="<?= !empty($row['gambar']) ? '/lab11_php_oop/img/' . $row['gambar'] : 'https://via.placeholder.com/80' ?>" 
                                 alt="Gambar" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                        </td>
                        <td class="fw-bold"><?= $row['nama']; ?></td>
                        <td><span class="badge bg-secondary"><?= $row['kategori']; ?></span></td>
                        <td class="text-success fw-bold">Rp <?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                        <td class="text-muted">Rp <?= number_format($row['harga_beli'], 0, ',', '.'); ?></td>
                        <td class="text-center">
                            <span class="badge <?= $row['stok'] < 5 ? 'bg-danger' : 'bg-success'; ?>"><?= $row['stok']; ?></span>
                        </td>
                        <td class="text-center">
                            <a href="ubah?id=<?= $row['id_barang']; ?>" class="btn btn-warning btn-sm btn-custom text-white">Ubah</a>
                            <a href="hapus?id=<?= $row['id_barang']; ?>" class="btn btn-danger btn-sm btn-custom" onclick="return confirm('Yakin hapus?');">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8" class="text-center">Data kosong.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>