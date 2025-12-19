<?php
$iduser = $_POST['iduser'] ?? "";
$pass   = $_POST['pass'] ?? "";
$error  = "";

if (isset($_POST['submit'])) {
    $db = new Database();
    // Ambil data user dari DB
    $sql = "SELECT * FROM users WHERE username = '{$iduser}'";
    $result = $db->query($sql);
    $data = mysqli_fetch_array($result);

    if ($data && password_verify($pass, $data['password'])) {
        // LOGIN SUKSES
        $_SESSION['is_login'] = true;
        $_SESSION['user_id']  = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama']     = $data['nama'];
        
        // Redirect ke Data Barang
        header('Location: ../artikel/index'); 
        exit();
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card-custom">
            <h3 class="text-center fw-bold text-primary mb-4">🔐 Login Sistem</h3>
            <?php if($error): ?><div class="alert alert-danger"><?= $error; ?></div><?php endif; ?>
            
            <form method="post">
                <div class="mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" class="form-control p-3" name="iduser" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control p-3" name="pass" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary w-100 btn-lg btn-custom">Masuk</button>
            </form>
        </div>
    </div>
</div>