// script.js

// DOM Manipulation dan Event Listeners
document.addEventListener('DOMContentLoaded', function() {
    console.log('RxQuiz loaded successfully!');
    
    // Inisialisasi semua fungsi
    initParallax();
    initAnimations();
    initDarkMode();
    initCardInteractions();
    fetchQuizData();
    
    // Smooth scrolling untuk anchor links
    initSmoothScrolling();
});

// ===== PARALLAX BACKGROUND =====
function initParallax() {
    const parallaxBg = document.getElementById('parallaxBg');
    const parallaxOverlay = document.getElementById('parallaxOverlay');
    
    if (!parallaxBg || !parallaxOverlay) {
        console.warn('Parallax elements not found');
        return;
    }
    
    // Faktor kecepatan parallax (10% = 0.1)
    const parallaxSpeed = 0.1;
    
    // Variabel untuk throttling (mengoptimalkan performa)
    let ticking = false;
    
    function updateParallax() {
        const scrolled = window.pageYOffset;
        const newPosition = -(scrolled * parallaxSpeed);
        
        // Terapkan transformasi dengan efek yang halus
        parallaxBg.style.transform = `translateY(${newPosition}px)`;
        parallaxOverlay.style.transform = `translateY(${newPosition}px)`;
        
        ticking = false;
    }
    
    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    }
    
    // Event listener untuk scroll dengan throttling
    window.addEventListener('scroll', function() {
        requestTick();
    });
    
    // Inisialisasi posisi awal
    updateParallax();
    
    // Handle resize untuk memastikan background tetap cover
    window.addEventListener('resize', function() {
        parallaxBg.style.height = `${document.documentElement.scrollHeight * 1.2}px`;
    });
    
    // Set initial height
    parallaxBg.style.height = `${document.documentElement.scrollHeight * 1.2}px`;
}

// ===== ANIMATIONS =====
function initAnimations() {
    // Animasi scroll untuk section
    const sections = document.querySelectorAll('.section');
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                entry.target.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            }
        });
    }, observerOptions);
    
    sections.forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(30px)';
        observer.observe(section);
    });
}

// ===== DARK MODE =====
function initDarkMode() {
    // Buat toggle button untuk dark mode
    const darkModeToggle = document.createElement('button');
    darkModeToggle.innerHTML = '🌙 Dark Mode';
    darkModeToggle.id = 'darkModeToggle';
    darkModeToggle.setAttribute('aria-label', 'Toggle dark mode');
    
    document.body.appendChild(darkModeToggle);
    
    // Event listener untuk toggle
    darkModeToggle.addEventListener('click', toggleDarkMode);
    
    // Cek preferensi dark mode pengguna
    if (localStorage.getItem('darkMode') === 'enabled') {
        enableDarkMode();
    }
    
    // Juga cek preferensi sistem
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        if (!localStorage.getItem('darkMode')) {
            enableDarkMode();
        }
    }
}

function toggleDarkMode() {
    if (document.body.classList.contains('dark-mode')) {
        disableDarkMode();
    } else {
        enableDarkMode();
    }
}

function enableDarkMode() {
    document.body.classList.add('dark-mode');
    const toggleBtn = document.querySelector('#darkModeToggle');
    if (toggleBtn) {
        toggleBtn.innerHTML = '☀️ Light Mode';
    }
    localStorage.setItem('darkMode', 'enabled');
}

function disableDarkMode() {
    document.body.classList.remove('dark-mode');
    const toggleBtn = document.querySelector('#darkModeToggle');
    if (toggleBtn) {
        toggleBtn.innerHTML = '🌙 Dark Mode';
    }
    localStorage.setItem('darkMode', 'disabled');
}

// ===== CARD INTERACTIONS =====
function initCardInteractions() {
    const featureCards = document.querySelectorAll('.card-featured');
    
    featureCards.forEach(card => {
        // Click interaction
        card.addEventListener('click', function() {
            this.classList.toggle('active');
            
            // Hapus active class dari card lain
            featureCards.forEach(otherCard => {
                if (otherCard !== this) {
                    otherCard.classList.remove('active');
                }
            });
        });
        
        // Keyboard interaction
        card.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });
}

// ===== SMOOTH SCROLLING =====
function initSmoothScrolling() {
    const navLinks = document.querySelectorAll('a[href^="#"]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const headerHeight = document.querySelector('.header').offsetHeight;
                const targetPosition = targetElement.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// ===== FETCH API UNTUK QUIZ DATA =====
async function fetchQuizData() {
    const quizContainer = document.getElementById('quiz-api-container');
    
    if (!quizContainer) {
        console.warn('Quiz container not found');
        return;
    }
    
    // Tampilkan loading state
    quizContainer.innerHTML = `
        <div class="quiz-loading">
            <div class="loading-dots">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <p>Memuat quiz...</p>
        </div>
    `;
    
    try {
        // Menggunakan Open Trivia Database API
        const response = await fetch('https://opentdb.com/api.php?amount=5&type=multiple&encode=url3986');
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        
        if (data.response_code === 0) {
            displayQuizData(data.results);
        } else {
            throw new Error('API returned error code: ' + data.response_code);
        }
        
    } catch (error) {
        console.error('Error fetching quiz data:', error);
        displayQuizError(error.message);
    }
}

function displayQuizData(quizData) {
    const quizContainer = document.getElementById('quiz-api-container');
    
    if (!quizData || quizData.length === 0) {
        quizContainer.innerHTML = `
            <div class="quiz-error">
                <p>Tidak ada quiz yang tersedia saat ini.</p>
            </div>
        `;
        return;
    }
    
    const quizHTML = `
        <div class="quiz-container">
            <h3 style="color: var(--red); margin-bottom: 1.5rem; text-align: center;">Contoh Quiz dari Open Trivia Database API</h3>
            <div class="quiz-list">
                ${quizData.map((quiz, index) => `
                    <div class="quiz-item">
                        <div class="quiz-question">${decodeURIComponent(quiz.question)}</div>
                        <div class="quiz-category">${decodeURIComponent(quiz.category)} • ${decodeURIComponent(quiz.difficulty)}</div>
                    </div>
                `).join('')}
            </div>
            <div style="text-align: center; margin-top: 1.5rem;">
                <button class="btn btn-primary" onclick="fetchQuizData()">Muat Quiz Lain</button>
            </div>
        </div>
    `;
    
    quizContainer.innerHTML = quizHTML;
    
    // Tambahkan animasi untuk quiz items
    const quizItems = quizContainer.querySelectorAll('.quiz-item');
    quizItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(-20px)';
        item.style.transition = `opacity 0.5s ease ${index * 0.1}s, transform 0.5s ease ${index * 0.1}s`;
        
        setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'translateX(0)';
        }, 100);
    });
}

function displayQuizError(errorMessage) {
    const quizContainer = document.getElementById('quiz-api-container');
    
    quizContainer.innerHTML = `
        <div class="quiz-error">
            <p>Gagal memuat quiz dari API.</p>
            <p style="font-size: 0.9em; margin-top: 0.5rem;">Error: ${errorMessage}</p>
            <div style="text-align: center; margin-top: 1rem;">
                <button class="btn btn-secondary" onclick="fetchQuizData()">Coba Lagi</button>
            </div>
        </div>
    `;
}

// ===== UTILITY FUNCTIONS =====
// Fungsi untuk decode HTML entities (jika diperlukan)
function decodeHTML(html) {
    const txt = document.createElement('textarea');
    txt.innerHTML = html;
    return txt.value;
}

// Export functions untuk global access (jika diperlukan)
window.toggleDarkMode = toggleDarkMode;
window.fetchQuizData = fetchQuizData;