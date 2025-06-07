<?php
include 'koneksi.php';
session_start();
require_once 'csrf.php';
ensure_csrf_token();

// Jika user sudah login, arahkan ke halaman admin
if (isset($_SESSION['user_id'])) {
    header("Location: index.php?page=admin");
    exit();
}

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = "Invalid CSRF token";
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password']; // Password dalam format plain text

    // Query untuk mendapatkan data user
    $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Verifikasi password tanpa hashing
        if ($password === $user['password']) {  
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
          

            // Redirect ke halaman admin yang benar
            header("Location: index.php?page=admin");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
    }
}



?>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <!-- Perbaiki tautan pendaftaran -->
                    <small>Belum punya akun? <a href="index.php?page=daftar">Daftar</a></small>
                </div>
            </div>
        </div>
    </div>

