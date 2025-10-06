<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Quiz - RxQuiz</title>
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
            <h2 class="section-title">Buat Quiz Baru</h2>
            
            <div class="card">
                <?php if(isset($_SESSION['username'])): ?>
                    <h3 style="color: var(--red); margin-bottom: 1rem;">Halo, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h3>
                    <p>Silakan buat quiz baru Anda di sini.</p>
                    
                    <form style="margin-top: 2rem;">
                        <div style="margin-bottom: 1rem;">
                            <label for="quiz-title" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Judul Quiz</label>
                            <input type="text" id="quiz-title" name="quiz-title" 
                                   style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px;"
                                   placeholder="Masukkan judul quiz">
                        </div>
                        
                        <div style="margin-bottom: 1rem;">
                            <label for="quiz-description" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Deskripsi</label>
                            <textarea id="quiz-description" name="quiz-description" rows="4"
                                      style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px;"
                                      placeholder="Masukkan deskripsi quiz"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Buat Quiz</button>
                    </form>
                <?php else: ?>
                    <div style="text-align: center; padding: 2rem;">
                        <h3 style="color: var(--red); margin-bottom: 1rem;">Anda perlu login untuk membuat quiz</h3>
                        <p>Silakan login terlebih dahulu untuk mengakses fitur ini.</p>
                        <a href="login.php" class="btn btn-primary" style="margin-top: 1rem;">Login Sekarang</a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>