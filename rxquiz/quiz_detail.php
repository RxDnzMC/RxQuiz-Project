<?php
session_start();

// Handle query string parameters
$quiz_id = $_GET['id'] ?? '1';
$category = $_GET['category'] ?? 'general';
$difficulty = $_GET['difficulty'] ?? 'medium';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Quiz - RxQuiz</title>
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
            <h2 class="section-title">Detail Quiz</h2>
            
            <div class="card">
                <h3 style="color: var(--red); margin-bottom: 1rem;">Informasi Quiz</h3>
                
                <div style="margin-bottom: 1.5rem;">
                    <p><strong>Quiz ID:</strong> <?php echo htmlspecialchars($quiz_id); ?></p>
                    <p><strong>Kategori:</strong> <?php echo htmlspecialchars(ucfirst($category)); ?></p>
                    <p><strong>Tingkat Kesulitan:</strong> <?php echo htmlspecialchars(ucfirst($difficulty)); ?></p>
                    
                    <?php if(isset($_SESSION['username'])): ?>
                        <p><strong>Dibuat oleh:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    <?php endif; ?>
                </div>
                
                <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    <h4 style="color: var(--red); margin-bottom: 1rem;">Contoh Penggunaan Query String</h4>
                    <p>URL: <code>quiz_detail.php?id=<?php echo $quiz_id; ?>&category=<?php echo $category; ?>&difficulty=<?php echo $difficulty; ?></code></p>
                    <p style="margin-top: 0.5rem;">Coba ubah parameter di URL untuk melihat perubahan:</p>
                    <ul style="margin-top: 0.5rem;">
                        <li><code>?id=2&category=science&difficulty=hard</code></li>
                        <li><code>?id=3&category=history&difficulty=easy</code></li>
                    </ul>
                </div>
                
                <div class="flex-center" style="gap: 1rem;">
                    <a href="quiz_detail.php?id=<?php echo rand(1, 10); ?>&category=general&difficulty=medium" 
                       class="btn btn-primary">Load Random Quiz</a>
                    <a href="index.php" class="btn btn-secondary">Kembali ke Beranda</a>
                </div>
            </div>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>