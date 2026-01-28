// ============================================
// 1. SETUP & UTILITIES
// ============================================
gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

// Cache DOM Elements
const el = {
    loader: document.getElementById('loader'),
    content: document.getElementById('content'),
    audio: document.getElementById('audioPlayer'),
    musicBtn: document.getElementById('musicBtn'),
    playIcon: document.getElementById('playIcon'),
    pauseIcon: document.getElementById('pauseIcon'),
    progressFill: document.getElementById('progressFill'),
    progressHandle: document.getElementById('progressHandle'),
    playingIndicator: document.getElementById('playingIndicator'),
    musicInterlude: document.getElementById('musicInterlude'),
    continueMessage: document.getElementById('continueMessage'),
    skipLink: document.getElementById('skipLink'),
    heroImage: document.getElementById('heroImage'),
    gallery: document.getElementById('galleryContainer'),
    videoOverlay: document.getElementById('videoOverlay'),
    memoryVideo: document.getElementById('memoryVideo'),
    videoContainer: document.getElementById('videoContainer')
};

// State
let isPlaying = false;
let audioFadeInterval = null;
let musicInterludePassed = false;
let musicStarted = false;

// Refresh ScrollTrigger on Resize to fix mobile layout issues
ScrollTrigger.config({ autoRefreshEvents: "visibilitychange,DOMContentLoaded,load,resize" });

// ============================================
// 2. AUDIO SYSTEM
// ============================================

if (el.musicBtn) {
    el.musicBtn.addEventListener('click', toggleMusic);
}

// Additional Controls inside Interlude
const musicControlBtn = document.getElementById('musicControlBtn');
if (musicControlBtn) {
    musicControlBtn.addEventListener('click', toggleMusic);
}

function toggleMusic() {
    if (!isPlaying) {
        el.audio.play().then(() => {
            isPlaying = true;
            musicStarted = true;
            updateMusicUI(true);
            
            if (el.continueMessage) {
                setTimeout(() => {
                    el.continueMessage.classList.remove('hidden');
                    el.continueMessage.classList.add('visible');
                    gsap.to(el.continueMessage, { opacity: 1, y: 0, duration: 0.5 });
                }, 2000);
            }
        }).catch(err => {
            console.log("Audio play failed:", err);
            if (el.continueMessage) {
                el.continueMessage.classList.remove('hidden');
                el.continueMessage.classList.add('visible');
            }
        });
    } else {
        el.audio.pause();
        isPlaying = false;
        updateMusicUI(false);
    }
}

function updateMusicUI(active) {
    // Main button icons
    if (active) {
        el.playIcon?.classList.add('hidden');
        el.pauseIcon?.classList.remove('hidden');
    } else {
        el.playIcon?.classList.remove('hidden');
        el.pauseIcon?.classList.add('hidden');
    }

    // Interlude player icons
    const playIconControl = document.getElementById('playIconControl');
    const pauseIconControl = document.getElementById('pauseIconControl');
    
    if (active) {
        playIconControl?.classList.add('hidden');
        pauseIconControl?.classList.remove('hidden');
        el.playingIndicator?.classList.remove('hidden');
    } else {
        playIconControl?.classList.remove('hidden');
        pauseIconControl?.classList.add('hidden');
        el.playingIndicator?.classList.add('hidden');
    }
}

// Update Progress Bar
if (el.audio) {
    el.audio.addEventListener('timeupdate', () => {
        if (el.audio.duration) {
            const progress = (el.audio.currentTime / el.audio.duration) * 100;
            if (el.progressFill) el.progressFill.style.width = `${progress}%`;
            if (el.progressHandle) el.progressHandle.style.left = `${progress}%`;
            
            const currTimeEl = document.querySelector('.time-current');
            const durTimeEl = document.querySelector('.time-duration');
            if (currTimeEl) currTimeEl.textContent = formatTime(el.audio.currentTime);
            if (durTimeEl) durTimeEl.textContent = formatTime(el.audio.duration);
        }
    });
}

function formatTime(seconds) {
    if (isNaN(seconds)) return '0:00';
    const mins = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${mins}:${secs.toString().padStart(2, '0')}`;
}

const progressBar = document.querySelector('.progress-bar');
if (progressBar && el.audio) {
    progressBar.addEventListener('click', (e) => {
        if (!el.audio.duration) return;
        const rect = e.currentTarget.getBoundingClientRect();
        const percent = (e.clientX - rect.left) / rect.width;
        el.audio.currentTime = percent * el.audio.duration;
    });
}

// ============================================
// 3. INTERLUDE LOGIC
// ============================================

function showMusicInterlude() {
    if (el.musicInterlude) {
        el.musicInterlude.style.display = 'flex'; // Ensure it's display flex
        setTimeout(() => {
            el.musicInterlude.classList.add('visible');
            gsap.to(el.musicInterlude, { opacity: 1, duration: 1 });
        }, 500);
    }
}

if (el.skipLink) {
    el.skipLink.addEventListener('click', unlockScroll);
}

function unlockScroll() {
    musicInterludePassed = true;
    if (el.musicInterlude) {
        gsap.to(el.musicInterlude, {
            opacity: 0,
            duration: 0.8,
            ease: "power2.inOut",
            onComplete: () => {
                el.musicInterlude.style.display = 'none';
                ScrollTrigger.refresh();
            }
        });
    }
}

let lastScrollTop = 0;
let scrollAttempts = 0;

window.addEventListener('scroll', () => {
    if (!el.musicInterlude || el.musicInterlude.style.display === 'none') return;

    const musicSection = el.musicInterlude.getBoundingClientRect();
    const isMusicVisible = musicSection.top <= window.innerHeight && musicSection.bottom >= 0;
    
    if (!musicInterludePassed && isMusicVisible && window.scrollY > 100) {
        scrollAttempts++;
        if (scrollAttempts > 5 && musicStarted) {
             unlockScroll();
        }
    }
});

// ============================================
// 4. OPENING SEQUENCE (FIXED LAYOUT)
// ============================================

window.addEventListener('load', () => {
    setTimeout(startOpeningSequence, 100);
});

function startOpeningSequence() {
    showPhase1();
}

function showPhase1() {
    const phase1 = document.querySelector('.phase-1');
    gsap.to(phase1, { opacity: 1, duration: 1 });
    phase1.classList.add('active');
    
    setTimeout(() => {
        hidePhase(phase1);
        showPhase2();
    }, 3000);
}

function showPhase2() {
    const phase2 = document.querySelector('.phase-2');
    phase2.classList.remove('hidden');
    gsap.fromTo(phase2, { opacity: 0, scale: 0.95 }, { opacity: 1, scale: 1, duration: 1 });
    phase2.classList.add('active');
    
    const choiceBtns = document.querySelectorAll('.choice-btn');
    choiceBtns.forEach(btn => {
        btn.onclick = () => {
            const answer = btn.getAttribute('data-answer');
            handleChoice(answer, phase2);
        };
    });
}

function handleChoice(answer, currentPhaseElement) {
    hidePhase(currentPhaseElement);
    setTimeout(() => {
        showPhase3(answer);
    }, 500);
}

function showPhase3(answer) {
    const phase3 = document.querySelector('.phase-3');
    const messageEl = document.querySelector('.opening-message');
    
    messageEl.textContent = answer === 'yes' 
        ? "Aku tahu kamu pasti siap. Mari kita mulai perjalanan ini bersama..." 
        : "Tidak apa-apa. Ambil waktu sejenak, dan mari kita mulai dengan perlahan...";
    
    phase3.classList.remove('hidden');
    gsap.fromTo(phase3, { opacity: 0 }, { opacity: 1, duration: 1 });
    phase3.classList.add('active');
    
    const startHandler = () => {
        hidePhase(phase3);
        setTimeout(showPhase4, 500);
        phase3.removeEventListener('click', startHandler);
    };

    phase3.style.cursor = 'pointer';
    phase3.addEventListener('click', startHandler);
}

function showPhase4() {
    const phase4 = document.querySelector('.phase-4');
    phase4.classList.remove('hidden');
    phase4.classList.add('active');
    
    gsap.to('.title-line', { opacity: 1, y: 0, duration: 1, stagger: 0.3, ease: "power3.out" });
    gsap.to('.title-number', { opacity: 1, scale: 1, duration: 1.5, delay: 0.5, ease: "elastic.out(1, 0.5)" });
    
    setTimeout(completeOpening, 3500);
}

function hidePhase(element) {
    gsap.to(element, { opacity: 0, duration: 0.5, onComplete: () => {
        element.classList.add('hidden');
        element.classList.remove('active');
    }});
}

function completeOpening() {
    gsap.to(el.loader, {
        opacity: 0,
        duration: 1,
        ease: "power2.inOut",
        onComplete: () => {
            el.loader.style.display = 'none';
            el.content.classList.remove('opacity-0');
            el.content.style.opacity = 1;
            
            ScrollTrigger.refresh(); 

            runOpeningAnimation();
            initScrollAnimations();
            initStickyAnimations(); // Initialize the FIXED sticky logic with scroll effect
            showMusicInterlude();
        }
    });
}

// Safety fallback
setTimeout(() => {
    if (el.loader.style.display !== 'none' && document.querySelector('.phase-4.active')) {
        completeOpening();
    }
}, 20000);

// ============================================
// 5. ANIMATIONS (Main Content)
// ============================================

function runOpeningAnimation() {
    const tl = gsap.timeline();
    tl.to('.line-child', { y: 0, duration: 1.8, ease: "power4.out", stagger: 0.2 })
      .from('#heroImage', { scale: 1.5, opacity: 0, duration: 2, ease: "power2.out" }, "-=1.5");
}

function initScrollAnimations() {
    // Hero Parallax
    gsap.to("#heroImage", {
        yPercent: 30,
        ease: "none",
        scrollTrigger: {
            trigger: ".hero-section",
            start: "top top",
            end: "bottom top",
            scrub: true
        }
    });

    // Text Reveal
    document.querySelectorAll('.reveal-p').forEach(text => {
        gsap.fromTo(text, 
            { y: 30, opacity: 0 },
            {
                y: 0,
                opacity: 1,
                duration: 1,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: text,
                    start: "top 90%", // Trigger earlier on mobile
                    toggleActions: "play none none reverse"
                }
            }
        );
    });

    // Title Reveals
    gsap.utils.toArray('.reveal-title').forEach(title => {
        gsap.fromTo(title,
            { x: -30, opacity: 0 },
            {
                x: 0,
                opacity: 1,
                duration: 1.2,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: title,
                    start: "top 85%"
                }
            }
        );
    });

    // Image Wrappers
    gsap.utils.toArray('.img-wrapper').forEach(wrapper => {
        gsap.fromTo(wrapper,
            { scale: 0.95, opacity: 0 },
            {
                scale: 1,
                opacity: 1,
                duration: 1,
                scrollTrigger: {
                    trigger: wrapper,
                    start: "top 90%",
                    toggleActions: "play none none reverse"
                }
            }
        );
    });

    // Footer
    gsap.fromTo('.footer-title',
        { scale: 0.8, opacity: 0 },
        {
            scale: 1,
            opacity: 1,
            duration: 1.5,
            ease: "power3.out",
            scrollTrigger: {
                trigger: '.footer-section',
                start: "top 75%"
            }
        }
    );

    gsap.fromTo('.footer-details',
        { y: 30, opacity: 0 },
        {
            y: 0,
            opacity: 1,
            duration: 1,
            delay: 0.5,
            scrollTrigger: {
                trigger: '.footer-section',
                start: "top 75%"
            }
        }
    );
}

// ============================================
// 6. STICKY SECTION WITH SCROLL EFFECT (FIXED)
// ============================================

function initStickyAnimations() {
    const wrapper = document.querySelector('.sticky-section-wrapper');
    const cards = gsap.utils.toArray('.sticky-image-card');
    
    if (!wrapper || cards.length === 0) return;

    // FIXED: Efek scroll bergantian pada gambar artwork
    // Card 1 visible by default (set in CSS)
    // Saat scroll, card 2 muncul (fade in), lalu card 3 muncul (fade in)
    
    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: wrapper,
            start: "top top",
            end: "+=300%", // Longer scroll distance for smooth transitions
            pin: true,
            scrub: 1,
            anticipatePin: 1
        }
    });

    // Sequence: Card 1 (visible) -> fade to Card 2 -> fade to Card 3
    tl.to(cards[0], { autoAlpha: 0, duration: 1 }, 0.5) // Card 1 fade out
      .to(cards[1], { autoAlpha: 1, duration: 1 }, 0.5) // Card 2 fade in (bersamaan)
      .to(cards[1], { autoAlpha: 0, duration: 1 }, 1.5) // Card 2 fade out
      .to(cards[2], { autoAlpha: 1, duration: 1 }, 1.5); // Card 3 fade in (bersamaan)
}

// ============================================
// 7. VIDEO & GALLERY
// ============================================

if (el.memoryVideo && el.videoOverlay) {
    el.videoOverlay.addEventListener('click', () => {
        el.memoryVideo.play();
    });
    
    el.memoryVideo.addEventListener('play', () => {
        el.videoOverlay.classList.add('hidden');
        if(el.videoContainer) el.videoContainer.classList.add('playing');
        fadeOutAudio();
    });

    el.memoryVideo.addEventListener('pause', () => {
        if (el.memoryVideo.currentTime < el.memoryVideo.duration - 0.5) fadeInAudio();
    });

    el.memoryVideo.addEventListener('ended', () => {
        setTimeout(() => {
            el.videoOverlay.classList.remove('hidden');
            if(el.videoContainer) el.videoContainer.classList.remove('playing');
        }, 800);
        fadeInAudio();
    });
}

function fadeOutAudio() {
    if (!isPlaying || !el.audio) return;
    clearInterval(audioFadeInterval);
    let vol = el.audio.volume;
    audioFadeInterval = setInterval(() => {
        if (vol > 0.1) {
            vol -= 0.1;
            el.audio.volume = vol;
        } else {
            el.audio.pause();
            clearInterval(audioFadeInterval);
        }
    }, 100);
}

function fadeInAudio() {
    if (!el.audio) return;
    clearInterval(audioFadeInterval);
    el.audio.play().then(() => {
        isPlaying = true;
        updateMusicUI(true);
        let vol = 0;
        audioFadeInterval = setInterval(() => {
            if (vol < 0.9) {
                vol += 0.1;
                el.audio.volume = Math.min(1, vol);
            } else {
                clearInterval(audioFadeInterval);
            }
        }, 100);
    });
}

if (el.gallery) {
    let isDown = false;
    let startX;
    let scrollLeft;

    el.gallery.addEventListener('mousedown', (e) => {
        isDown = true;
        el.gallery.style.cursor = 'grabbing';
        startX = e.pageX - el.gallery.offsetLeft;
        scrollLeft = el.gallery.scrollLeft;
    });
    el.gallery.addEventListener('mouseleave', () => { isDown = false; el.gallery.style.cursor = 'grab'; });
    el.gallery.addEventListener('mouseup', () => { isDown = false; el.gallery.style.cursor = 'grab'; });
    el.gallery.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - el.gallery.offsetLeft;
        const walk = (x - startX) * 2;
        el.gallery.scrollLeft = scrollLeft - walk;
    });
}

// Custom Cursor (Desktop Only)
if (window.matchMedia("(pointer: fine)").matches) {
    const dot = document.querySelector('.cursor-dot');
    const outline = document.querySelector('.cursor-outline');
    
    if (dot && outline) {
        window.addEventListener('mousemove', (e) => {
            dot.style.left = `${e.clientX}px`;
            dot.style.top = `${e.clientY}px`;
            gsap.to(outline, { x: e.clientX, y: e.clientY, duration: 0.15, ease: "power2.out" });
        });
        
        document.querySelectorAll('a, button, .img-wrapper, .video-overlay').forEach(el => {
            el.addEventListener('mouseenter', () => document.body.classList.add('hovering'));
            el.addEventListener('mouseleave', () => document.body.classList.remove('hovering'));
        });
    }
}