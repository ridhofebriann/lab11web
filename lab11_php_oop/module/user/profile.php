<?php
// Cek Login (Security)
if (!isset($_SESSION['is_login'])) {
    header('Location: ../user/login');
    exit();
}

$id = $_SESSION['user_id'];
$db = new Database();
$pesan = "";

// LOGIKA GANTI PASSWORD
if (isset($_POST['submit'])) {
    $pass_baru = $_POST['pass_baru'];
    $pass_konf = $_POST['pass_konf'];

    if ($pass_baru == $pass_konf) {
        $hash = password_hash($pass_baru, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = '{$hash}' WHERE id = '{$id}'";
        
        if ($db->query($sql)) {
            $pesan = "<div class='alert alert-success'>Password berhasil diubah!</div>";
        } else {
            $pesan = "<div class='alert alert-danger'>Gagal update database.</div>";
        }
    } else {
        $pesan = "<div class='alert alert-warning'>Konfirmasi password tidak cocok.</div>";
    }
}

// Ambil data terbaru
$sql = "SELECT * FROM users WHERE id = '{$id}'";
$user = mysqli_fetch_array($db->query($sql));
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card-custom">
            <h3 class="fw-bold text-primary mb-4">👤 Profil Pengguna</h3>
            <?= $pesan; ?>

            <div class="mb-3">
                <label class="small text-muted">Nama Lengkap</label>
                <h5 class="fw-bold"><?= $user['nama']; ?></h5>
            </div>
            <div class="mb-4">
                <label class="small text-muted">Username</label>
                <h5 class="fw-bold text-secondary">@<?= $user['username']; ?></h5>
            </div>
            <hr>
            <h5 class="mb-3 fw-bold">Ganti Password</h5>
            <form method="post">
                <div class="mb-3">
                    <label>Password Baru</label>
                    <input type="password" class="form-control" name="pass_baru" required>
                </div>
                <div class="mb-3">
                    <label>Konfirmasi Password</label>
                    <input type="password" class="form-control" name="pass_konf" required>
                </div>
                <button type="submit" name="submit" class="btn btn-warning text-white w-100 btn-custom">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>