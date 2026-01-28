<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>19th Chapter | Devi Rachma Anjani</title>
    <meta name="description" content="A special page for a special person.">

    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,600&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'void': '#080808',
                        'dust': '#1a1a1a',
                        'mist': '#e5e5e5',
                        'accent': '#d4d4d4',
                    },
                    fontFamily: {
                        'serif': ['"Cormorant Garamond"', 'serif'],
                        'mono': ['"Space Mono"', 'monospace'],
                    },
                }
            }
        }
    </script>

    <link rel="stylesheet" href="style.css">
</head>

<body class="antialiased selection:bg-white selection:text-black">

    <audio id="audioPlayer" loop preload="auto">
        <source src="src/monokrom.mpeg" type="audio/mpeg">
    </audio>

    <div class="noise-overlay"></div>

    <div class="cursor-dot"></div>
    <div class="cursor-outline"></div>

    <div id="loader" class="fixed inset-0 z-[10000] bg-void w-full h-full overflow-hidden">
        <div class="opening-container">
            <div class="opening-phase phase-1">
                <h2 class="opening-name">Devi Rachma Anjani</h2>
            </div>

            <div class="opening-phase phase-2 hidden">
                <p class="opening-question">Sudah siap?</p>
                <div class="opening-choices">
                    <button class="choice-btn" data-answer="yes">
                        <span>Siap</span>
                    </button>
                    <button class="choice-btn" data-answer="no">
                        <span>Belum</span>
                    </button>
                </div>
            </div>

            <div class="opening-phase phase-3 hidden">
                <p class="opening-message"></p>
                <p class="opening-subtitle">Klik di mana saja untuk melanjutkan</p>
            </div>

            <div class="opening-phase phase-4 hidden">
                <h1 class="opening-title">
                    <span class="title-line">The</span>
                    <span class="title-number">19th</span>
                    <span class="title-line">Chapter</span>
                </h1>
            </div>
        </div>
    </div>

    <div class="fixed bottom-6 left-6 z-[9900] mix-blend-difference">
        <button id="musicBtn" class="music-button group">
            <div class="music-icon-wrapper">
                <svg id="playIcon" class="music-play-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                </svg>

                <div id="pauseIcon" class="music-pause-icon hidden">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
            </div>
            
            <div class="music-label-wrapper">
                <span class="music-label">PLAY SOUND</span>
            </div>
        </button>
    </div>

    <main id="content" class="opacity-0 transition-opacity duration-1000">

        <section class="hero-section" data-scroll-section>
            <div class="hero-image-wrapper">
                <img src="src/merpati.png" class="hero-image" id="heroImage" alt="Ethereal Dove">
            </div>

            <div class="hero-content">
                <div class="line-parent">
                    <h1 class="line-child hero-number">
                        19<span class="hero-suffix">th</span>
                    </h1>
                </div>
                <div class="line-parent mt-4 md:mt-8">
                    <p class="line-child hero-name">
                        Devi Rachma Anjani
                    </p>
                </div>
            </div>

            <div class="hero-scroll-indicator">
                <p class="scroll-text">Scroll Down</p>
                <div class="scroll-line"></div>
            </div>
        </section>

        <section class="music-interlude-section" id="musicInterlude" data-scroll-section>
            <div class="music-interlude-overlay"></div>
            
            <div class="music-interlude-container">
                <div class="music-message">
                    <p class="music-message-text">sebelumnya, nyalain dulu dong musicnya biar lebih berkesan, JANGAN scroll dulu sampai musicnya mulai !!!</p>
                </div>

                <div class="spotify-player">
                    <div class="album-cover">
                        <div class="album-cover-inner">
                            <div class="album-cover-gradient"></div>
                            <div class="album-cover-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M9 18V5l12-2v13"></path>
                                    <circle cx="6" cy="18" r="3"></circle>
                                    <circle cx="18" cy="16" r="3"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="song-info">
                        <h3 class="song-title">Monokrom</h3>
                        <p class="song-artist">Tulus</p>
                    </div>

                    <div class="progress-container">
                        <span class="time-current">0:00</span>
                        <div class="progress-bar">
                            <div class="progress-fill" id="progressFill"></div>
                            <div class="progress-handle" id="progressHandle"></div>
                        </div>
                        <span class="time-duration">0:00</span>
                    </div>

                    <div class="player-controls">
                        <button class="control-btn" id="musicControlBtn">
                            <svg class="play-icon" id="playIconControl" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                            <svg class="pause-icon hidden" id="pauseIconControl" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M6 4h4v16H6V4zm8 0h4v16h-4V4z"/>
                            </svg>
                        </button>
                    </div>

                    <div class="playing-indicator hidden" id="playingIndicator">
                        <div class="indicator-bar"></div>
                        <div class="indicator-bar"></div>
                        <div class="indicator-bar"></div>
                        <div class="indicator-bar"></div>
                    </div>
                </div>

                <div class="continue-message hidden" id="continueMessage">
                    <p class="continue-text">Scroll untuk melanjutkan</p>
                    <svg class="continue-arrow-down" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12l7 7 7-7"/>
                    </svg>
                </div>

                <button class="skip-link" id="skipLink">
                    <span>lewati (jika audio gagal load)</span>
                </button>
            </div>
        </section>

        <section class="intro-section" data-scroll-section>
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-12 md:gap-24">
                
                <div class="w-full md:w-5/12" id="introImgTrigger">
                    <div class="img-wrapper aspect-[3/4]">
                        <img src="src/to_love.jpeg" class="img-anim" alt="Portrait">
                    </div>
                </div>

                <div class="w-full md:w-7/12 flex flex-col justify-center">
                    <h2 class="intro-title" data-speed="0.9">
                        to love,
                    </h2>
                    
                    <div class="intro-content">
                        <p class="reveal-p">
                            Happy 19th birthday, Devi... <br>
                            Selamat datang di tahun yang baru. Semoga di umur yang ke-19 ini, kamu tumbuh menjadi versi terbaik dari dirimu sendiri. Dan juga semoga kamu bisa menurunkan egomu sedikit buat aku :p
                        </p>
                        <p class="reveal-p">
                            Di usia yang terus bertambah ini, aku harap kamu semakin menemukan kebahagiaan. Kebahagiaan yang tulus, yang datang dari dalam dirimu dan dari orang-orang yang benar-benar peduli padamu.
                        </p>
                        <div class="intro-signature reveal-p">
                            <p class="signature-text">
                                From the one who always proud of you
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="philosophy-section" data-scroll-section>
            <div class="philosophy-bg-number">M</div>

            <div class="max-w-7xl mx-auto px-6 md:px-20 relative z-10">
                <div class="mb-16 md:mb-24">
                    <h2 class="philosophy-title reveal-title">Monokrom</h2>
                    <p class="philosophy-subtitle">A SONG, A FEELING, A MEMORY</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-0 border border-white/10">
                    <div class="philosophy-content-box">
                        <div class="philosophy-quote">"Dalam hitam putih, ada kejujuran..."</div>
                        <p class="philosophy-text">
                            Website ini terinspirasi dari lagu <strong>"Monokrom"</strong> karya <strong>Tulus</strong>. 
                            Lagu yang berbicara tentang kenangan, kesederhanaan, dan kejujuran perasaan.<br><br>
                            
                            Monokrom bukan tentang kehilangan warna, tapi tentang menemukan esensi. 
                            Seperti foto lama yang memudar, tapi makna di dalamnya tetap tajam. 
                            Seperti perasaan yang tidak perlu banyak kata, tapi langsung menyentuh hati.<br><br>
                            
                            Hitam dan putih. Sederhana, tapi dalam. Itulah yang aku rasakan untukmu.EEAA
                        </p>
                    </div>

                    <div class="philosophy-grid">
                        <div class="img-wrapper border-r border-b border-white/10">
                            <img src="src/filosofi1.jpeg" class="img-anim">
                        </div>
                        <div class="img-wrapper border-b border-white/10">
                            <img src="src/filosofi2.jpeg" class="img-anim">
                        </div>
                        <div class="img-wrapper border-r border-white/10">
                            <img src="src/filosofi3.jpeg" class="img-anim">
                        </div>
                        <div class="philosophy-word-box">
                            <span class="philosophy-word">Pure.</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="memories-section" data-scroll-section>
            <div class="max-w-7xl mx-auto px-6 md:px-20">
                <div class="mb-12 md:mb-16 text-center">
                    <h2 class="memories-main-title reveal-title">The Moment</h2>
                    <p class="memories-subtitle">MOMENTS THAT LAST FOREVER</p>
                </div>

                <div class="memories-container">
                    <div class="memories-video-column">
                        <div class="video-frame">
                            <div class="video-container" id="videoContainer">
                                <video id="memoryVideo" class="memory-video" controls preload="metadata" playsinline>
                                    <source src="src/kenangan.MOV" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                
                                <div class="video-overlay" id="videoOverlay">
                                    <div class="video-overlay-content">
                                        <svg class="play-circle-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polygon points="10 8 16 12 10 16 10 8" fill="currentColor"></polygon>
                                        </svg>
                                        <p class="video-overlay-text">
                                            Kenangan ini direkam secara sederhana,<br>
                                            <span class="overlay-highlight">tapi artinya luar biasa.</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="memories-text-wrapper">
                        <div class="memories-narrative">
                            <p class="narrative-line">Ada hal-hal yang tidak perlu diulang,</p>
                            <p class="narrative-line">cukup diingat…</p>
                            <p class="narrative-line">dan disimpan baik-baik di hati.</p>
                            
                            <div class="narrative-spacer"></div>
                            
                            <p class="narrative-line">Setiap momen bersama adalah bab kecil</p>
                            <p class="narrative-line">yang membentuk cerita besar kita.</p>
                            
                            <div class="narrative-spacer"></div>
                            
                            <p class="narrative-line italic-line">Dan ini… adalah salah satunya.</p>
                        </div>
                        
                        <div class="memories-signature">
                            <div class="signature-line"></div>
                            <p class="signature-date">A memory worth keeping</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="gallery-section" data-scroll-section>
            <div class="text-center mb-16 px-4">
                <h2 class="gallery-title">
                    5 things you get<br>when you turn <span class="gallery-age">19</span>
                </h2>
            </div>

            <div class="gallery-container" id="galleryContainer">
                <div class="gallery-track">
                    <div class="gallery-frame">
                        <div class="gallery-image-wrapper">
                            <img src="src/freedom.jpeg" 
                                 class="gallery-image">
                            
                            <div class="gallery-caption">
                                <p class="gallery-caption-text">
                                    01 — Freedom
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-frame">
                        <div class="gallery-image-wrapper">
                            <img src="src/responsibility.jpeg" 
                                 class="gallery-image">
                            
                            <div class="gallery-caption">
                                <p class="gallery-caption-text">
                                    02 — Responsibility
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-frame">
                        <div class="gallery-image-wrapper">
                            <img src="src/love.jpeg" 
                                 class="gallery-image">
                            
                            <div class="gallery-caption">
                                <p class="gallery-caption-text">
                                    03 — Love
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-frame">
                        <div class="gallery-image-wrapper">
                            <img src="src/hope.jpeg" 
                                 class="gallery-image">
                            
                            <div class="gallery-caption">
                                <p class="gallery-caption-text">
                                    04 — Hope
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-frame">
                        <div class="gallery-image-wrapper">
                            <img src="src/pressure.PNG" 
                                 class="gallery-image">
                            
                            <div class="gallery-caption">
                                <p class="gallery-caption-text">
                                    05 — Pressure
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="sticky-section-wrapper" id="stickyWrapper">
            <div class="sticky-pin-container">
                
                <div class="sticky-left">
                    <div class="sticky-content">
                        <div class="mb-8">
                            <h2 class="sticky-title-main">The First <span class="sticky-title-number">1</span></h2>
                            <h3 class="sticky-title-sub">on my mind</h3>
                        </div>
                        
                        <blockquote class="sticky-quote">
                            "Kamu selalu jadi yang pertama di pikiranku... <br>
                            SEMANGAT KULIAH, JANGAN NYESEL AMBIL PETERNAKAN OKEII??!! U CAN DO IT!!"
                        </blockquote>
                        
                        <p class="sticky-description">
                            Kamu bisa semua hal, selalu dari 0. Jangan minder sama kemampuan orang lain, karena dulu mereka juga mulai dari 0 kayak kamu.
                        </p>
                    </div>
                </div>

                <div class="sticky-right">
                    <div class="sticky-images-stack">
                        <div class="sticky-image-card card-1">
                            <img src="src/artwork1.jpeg" class="img-anim">
                            <div class="sticky-image-label">ARTWORK I</div>
                        </div>
                        <div class="sticky-image-card card-2">
                            <img src="src/artwork2.jpeg" class="img-anim">
                            <div class="sticky-image-label">ARTWORK II</div>
                        </div>
                        <div class="sticky-image-card card-3">
                            <img src="src/artwork3.jpeg" class="img-anim">
                            <div class="sticky-image-label">ARTWORK III</div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <footer class="footer-section" data-scroll-section>
            <div class="footer-bg-image">
                 <img src="src/merpati.png" class="footer-dove">
            </div>

            <div class="footer-content">
                <h2 class="footer-title">
                    Happy<br>Birthday
                </h2>
                <div class="footer-details">
                    <p class="footer-name">Devi Rachma Anjani</p>
                    <div class="footer-divider"></div>
                    <p class="footer-credit">Made with pure love.</p>
                </div>
            </div>
        </footer>

    </main>

    <script src="script.js"></script>
</body>
</html>