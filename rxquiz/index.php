<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="RxQuiz - Platform untuk membuat dan berbagi kuis dengan mudah. Buat kuis interaktif untuk pembelajaran yang menyenangkan.">
  <meta name="keywords" content="kuis, quiz, pembelajaran, edukasi, interaktif">
  <meta name="author" content="RxQuiz Team">
  
  <title>RxQuiz - Buat Quiz Dengan Mudah dan Menyenangkan</title>
  <link rel="icon" href="Logo.png" type="image/png">
  <link rel="stylesheet" href="style.css">
  
  <!-- Preload untuk performa yang lebih baik -->
  <link rel="preload" href="style.css" as="style">
</head>

<body>
  <!-- Elemen untuk efek parallax -->
  <div class="parallax-background" id="parallaxBg"></div>
  <div class="parallax-overlay" id="parallaxOverlay"></div>
  
  <!-- HEADER -->
  <header class="header" role="banner">
    <div class="container flex-between">
      <a href="index.php" class="logo" aria-label="RxQuiz - Kembali ke beranda">RxQuiz</a>
      
      <nav aria-label="Navigasi utama">
        <ul class="nav flex-center" role="menubar">
          <li role="none"><a href="main.php" class="nav-link" role="menuitem">Beranda</a></li>
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

  <!-- MAIN CONTENT -->
  <main id="main-content" class="container" role="main">
    <!-- Tentang -->
    <section id="tentang" class="section" aria-labelledby="tentang-title">
      <h2 id="tentang-title" class="section-title">Tentang RxQuiz</h2>
      
      <article class="card">
        <p>RxQuiz adalah platform inovatif yang memungkinkan Anda untuk membuat dan berbagi kuis dengan mudah. Dengan RxQuiz, Anda dapat membuat kuis interaktif yang dapat dimainkan oleh teman-teman atau siswa Anda.</p>
        
        <p>Platform ini dirancang khusus untuk memberikan pengalaman belajar yang menyenangkan dan menarik, cocok untuk berbagai kebutuhan:</p>
        
        <ul style="margin: 1rem 0; padding-left: 2rem;">
          <li><strong>Pendidikan:</strong> Sekolah, universitas, dan lembaga kursus</li>
          <li><strong>Perusahaan:</strong> Training karyawan dan assessment</li>
          <li><strong>Komunitas:</strong> Kuis kelompok dan permainan edukatif</li>
          <li><strong>Personal:</strong> Belajar mandiri dan menguji pengetahuan</li>
        </ul>
        
        <p>Dengan antarmuka yang intuitif, RxQuiz memungkinkan siapa saja membuat kuis tanpa perlu keterampilan teknis khusus. Cukup pilih jenis pertanyaan, tambahkan jawaban, dan bagikan kuis Anda dengan mudah.</p>
        
        <p>Fitur analitik real-time memungkinkan Anda melacak hasil kuis secara langsung, memberikan wawasan berharga tentang pemahaman peserta.</p>
        
        <div class="flex-center" style="margin-top: 2rem;">
          <a href="create_quiz.php" class="btn btn-primary">Mulai Buat Quiz Sekarang</a>
        </div>
      </article>
    </section>

    <!-- Fitur -->
    <section id="fitur" class="section" aria-labelledby="fitur-title">
      <h2 id="fitur-title" class="section-title">Fitur Utama</h2>
      
      <div class="grid">
        <div class="card card-featured" tabindex="0" role="button">
          <span>✨</span>
          <span>Membuat kuis dengan mudah</span>
        </div>
        
        <div class="card card-featured" tabindex="0" role="button">
          <span>📝</span>
          <span>Pertanyaan pilihan ganda</span>
        </div>
        
        <div class="card card-featured" tabindex="0" role="button">
          <span>📊</span>
          <span>Hasil kuis real-time</span>
        </div>
        
        <div class="card card-featured" tabindex="0" role="button">
          <span>🔗</span>
          <span>Berbagi kuis dengan teman</span>
        </div>
        
        <div class="card card-featured" tabindex="0" role="button">
          <span>🎮</span>
          <span>Mainkan banyak quiz seru!</span>
        </div>
      </div>
      
      <!-- Container untuk quiz dari API -->
      <div id="quiz-api-container"></div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="section card" aria-labelledby="kontak-title">
      <h2 id="kontak-title" class="section-title">Kontak Kami</h2>
      
      <p>Jika Anda memiliki pertanyaan, saran, atau membutuhkan bantuan, jangan ragu untuk menghubungi kami:</p>
      
      <ul class="contact-list">
        <li>
          <strong>Email:</strong> 
          <a href="mailto:anakpintarsamboja@gmail.com" class="btn btn-secondary">
            📧 anakpintarsamboja@gmail.com
          </a>
        </li>
        
        <li>
          <strong>WhatsApp:</strong> 
          <a href="https://wa.me/6285754588718" class="btn btn-secondary" target="_blank" rel="noopener">
            📱 +62857-5458-8718
          </a>
        </li>
        
        <li>
          <strong>Instagram:</strong> 
          <a href="https://instagram.com/rxdnz__" class="btn btn-secondary" target="_blank" rel="noopener">
            📸 @rxdnz
          </a>
        </li>
      </ul>
      
      <div style="margin-top: 2rem; padding: 1rem; background: #f8f9fa; border-radius: 8px;">
        <h3 style="color: var(--red); margin-bottom: 0.5rem;">Jam Operasional</h3>
        <p>Senin - Jumat: 08:00 - 17:00 WIB</p>
        <p>Sabtu: 08:00 - 12:00 WIB</p>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="footer" role="contentinfo">
    <div class="container">
      <p>&copy; 2023 RxQuiz. Semua hak cipta dilindungi.</p>
      <p>Terinspirasi oleh <a href="https://kahoot.com/" target="_blank" rel="noopener">Kahoot</a> &amp; <a href="https://dribbble.com/" target="_blank" rel="noopener">Dribbble</a>.</p>
      
      <div style="margin-top: 1rem;">
        <a href="#tentang" style="margin-right: 1rem;">Tentang</a>
        <a href="#fitur" style="margin-right: 1rem;">Fitur</a>
        <a href="#kontak">Kontak</a>
      </div>
    </div>
  </footer>

  <!-- JavaScript -->
  <script src="script.js"></script>
</body>
</html>