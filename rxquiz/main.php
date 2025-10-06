<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - RxQuiz</title>
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
                    <li role="none"><a href="create_quiz.php" class="nav-link" role="menuitem">Buat Quiz</a></li>
                    <li role="none"><a href="quiz_detail.php" class="nav-link" role="menuitem">Detail Quiz</a></li>
                    <?php if(isset($_SESSION['username'])): ?>
                        <li role="none"><a href="dashboard.php" class="nav-link" role="menuitem">Dashboard</a></li>
                        <li role="none"><a href="logout.php" class="nav-link" role="menuitem">Logout</a></li>
                    <?php else: ?>
                        <li role="none"><a href="login.php" class="nav-link" role="menuitem">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container" role="main">
        <section class="section">
            <h2 class="section-title">Beranda RxQuiz</h2>
            
            <div class="card">
                <h3 style="color: var(--red); margin-bottom: 1rem;">Selamat Datang di RxQuiz</h3>
                
                <?php if(isset($_SESSION['username'])): ?>
                    <p>Halo, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>! Anda sudah login.</p>
                    <div class="flex-center" style="margin-top: 1.5rem; gap: 1rem;">
                        <a href="dashboard.php" class="btn btn-primary">Lihat Dashboard</a>
                        <a href="create_quiz.php" class="btn btn-secondary">Buat Quiz Baru</a>
                    </div>
                <?php else: ?>
                    <p>Platform untuk membuat dan berbagi kuis dengan mudah. Silakan login untuk mengakses fitur lengkap.</p>
                    <div class="flex-center" style="margin-top: 1.5rem; gap: 1rem;">
                        <a href="login.php" class="btn btn-primary">Login Sekarang</a>
                        <a href="create_quiz.php" class="btn btn-secondary">Jelajahi Quiz</a>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="grid" style="margin-top: 2rem;">
                <div class="card card-featured">
                    <span>🎯</span>
                    <span>Quiz Populer</span>
                </div>
                
                <div class="card card-featured">
                    <span>🏆</span>
                    <span>Peringkat</span>
                </div>
                
                <div class="card card-featured">
                    <span>📈</span>
                    <span>Trending</span>
                </div>
            </div>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>