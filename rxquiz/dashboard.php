<?php
session_start();

// Jika user belum login, redirect ke halaman login
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - RxQuiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="parallax-background" id="parallaxBg"></div>
    <div class="parallax-overlay" id="parallaxOverlay"></div>
    
    <header class="header" role="banner">
        <div class="container flex-between">
            <a href="index.php" class="logo" aria-label="RxQuiz - Kembali ke beranda">RxQuiz</a>
            
            <nav aria-label="Navigasi utama">
                <ul class="nav flex-center" role="menubar">
                    <li role="none"><a href="index.php" class="nav-link" role="menuitem">Beranda</a></li>
                    <li role="none"><a href="create_quiz.php" class="nav-link" role="menuitem">Buat Quiz</a></li>
                    <li role="none"><a href="logout.php" class="nav-link" role="menuitem">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container" role="main">
        <section class="section">
            <h2 class="section-title">Dashboard</h2>
            
            <div class="card">
                <h3 style="color: var(--red); margin-bottom: 1rem;">Selamat datang, <?php echo htmlspecialchars($username); ?>!</h3>
                <p>Anda berhasil login ke sistem RxQuiz.</p>
                
                <div class="grid" style="margin-top: 2rem;">
                    <div class="card card-featured">
                        <span>📊</span>
                        <span>Statistik Quiz</span>
                    </div>
                    
                    <div class="card card-featured">
                        <span>📝</span>
                        <span>Quiz Saya</span>
                    </div>
                    
                    <div class="card card-featured">
                        <span>👥</span>
                        <span>Peserta</span>
                    </div>
                    
                    <div class="card card-featured">
                        <span>⚙️</span>
                        <span>Pengaturan</span>
                    </div>
                </div>
                
                <div style="margin-top: 2rem; padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                    <h4 style="color: var(--red); margin-bottom: 1rem;">Informasi Session</h4>
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
                    <p><strong>Session ID:</strong> <?php echo session_id(); ?></p>
                    <p><strong>Login Time:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
                </div>
                
                <div class="flex-center" style="margin-top: 2rem; gap: 1rem;">
                    <a href="create_quiz.php" class="btn btn-primary">Buat Quiz Baru</a>
                    <a href="logout.php" class="btn btn-secondary">Logout</a>
                </div>
            </div>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>