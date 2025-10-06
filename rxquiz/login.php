<?php
session_start();

// Nama : admin dan password: password123
// Jika user sudah login, redirect ke dashboard
if(isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

// Proses login
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Autentikasi sederhana (dalam praktek nyata, gunakan database dan hash password)
    if($username === 'admin' && $password === 'password123') {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RxQuiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="parallax-background" id="parallaxBg"></div>
    <div class="parallax-overlay" id="parallaxOverlay"></div>
    
    <header class="header" role="banner">
        <div class="container flex-between">
            <a href="index.php" class="logo" aria-label="RxQuiz - Kembali ke beranda">RxQuiz</a>
        </div>
    </header>

    <main class="container" style="min-height: 80vh; display: flex; align-items: center; justify-content: center;">
        <div class="card" style="max-width: 400px; width: 100%;">
            <h2 class="section-title" style="text-align: center;">Login</h2>
            
            <?php if(isset($error)): ?>
                <div style="background: #ffe6e6; color: var(--red); padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div style="margin-bottom: 1rem;">
                    <label for="username" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Username</label>
                    <input type="text" id="username" name="username" required 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px;"
                           placeholder="Masukkan username">
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <label for="password" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Password</label>
                    <input type="password" id="password" name="password" required 
                           style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px;"
                           placeholder="Masukkan password">
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
            </form>
            
            <div style="margin-top: 1rem; text-align: center; font-size: 0.9em; color: #666;">
                <p>Demo credentials:<br>Username: <strong>admin</strong><br>Password: <strong>password123</strong></p>
            </div>
        </div>
    </main>

    <script src="script.js"></script>
</body>
</html>