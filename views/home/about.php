<?php 
// about page
$pageTitle = 'About';
$pageCss = 'about.css';
require_once BASE_PATH . '/views/layout/header.php'; 
?>

<!-- hero section: big title with a background image and dark overlay.
     it introduces the page with the app name and a short tagline -->
<section class="about-hero">
    <div class="about-hero-overlay"></div>
    <div class="about-hero-content">
        <span class="about-hero-tag">OUR STORY</span>
        <h1 class="about-hero-title">About Alzikrayat</h1>
        <p class="about-hero-sub">
            A place where memories live forever.
        </p>
    </div>
</section>

<!-- story section: explains why this app exists and what makes it different -->
<section class="about-section">
    <div class="about-container">
        
        <div class="story-block">
            <span class="section-tag">THE BEGINNING</span>
            <h2 class="section-title">Built for moments that matter.</h2>
            <p class="section-text">
                Alzikrayat started as a simple idea: photos deserve a place where 
                they're actually seen, not buried in endless feeds. No algorithms, 
                no ads, no noise. Just real memories shared with the people who 
                matter most.
            </p>
        </div>
        
    </div>
</section>

<!-- tech section: shows the main parts of the project as small cards,
     each card has an icon, a title, and a short description -->
<section class="tech-section">
    <div class="about-container">
        
        <div class="tech-header">
            <span class="section-tag">UNDER THE HOOD</span>
            <h2 class="section-title">How it's built.</h2>
            <p class="section-text">
                A fully custom MVC application with no frameworks and no shortcuts.
            </p>
        </div>
        
        <div class="tech-grid">
            
            <div class="tech-card">
                <div class="tech-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="16 18 22 12 16 6"></polyline>
                        <polyline points="8 6 2 12 8 18"></polyline>
                    </svg>
                </div>
                <h3 class="tech-name">Custom MVC</h3>
                <p class="tech-desc">Handwritten Model-View-Controller architecture</p>
            </div>
            
            <div class="tech-card">
                <div class="tech-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </div>
                <h3 class="tech-name">Secure Auth</h3>
                <p class="tech-desc">Bcrypt password hashing & session management</p>
            </div>
            
            <div class="tech-card">
                <div class="tech-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="2" y1="12" x2="22" y2="12"></line>
                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                    </svg>
                </div>
                <h3 class="tech-name">Manual Router</h3>
                <p class="tech-desc">Regex-based URL routing without libraries</p>
            </div>
            
            <div class="tech-card">
                <div class="tech-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg>
                </div>
                <h3 class="tech-name">Responsive</h3>
                <p class="tech-desc">Mobile-first design with Bootstrap 5</p>
            </div>
            
            <div class="tech-card">
                <div class="tech-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                        <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                        <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                    </svg>
                </div>
                <h3 class="tech-name">MySQL + PDO</h3>
                <p class="tech-desc">Normalized schema with prepared statements</p>
            </div>
            
            <div class="tech-card">
                <div class="tech-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h3 class="tech-name">Secure by Design</h3>
                <p class="tech-desc">SQL injection & XSS protection built-in</p>
            </div>
            
        </div>
        
    </div>
</section>

<!-- developer card: a small green card that shows who built the project -->
<section class="dev-section">
    <div class="about-container">
        
        <div class="dev-card">
            <div class="dev-avatar">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>
            <span class="section-tag">BUILT BY</span>
            <h2 class="dev-name">Malaz Mohamed Ahmed Mohamed</h2>
            <p class="dev-role">Advanced Web Technologies — SUST</p>
        </div>
        
    </div>
</section>

<!-- final call to action: invites users to explore the gallery -->
<section class="cta-section">
    <div class="about-container">
        
        <div class="cta-card">
            <h2 class="cta-title">
                Ready to share your<br>
                <em>first memory?</em>
            </h2>
            <a href="/alzikrayat/public/photos" class="btn-cta">
                Explore Gallery →
            </a>
        </div>
        
    </div>
</section>

<?php require_once BASE_PATH . '/views/layout/footer.php'; ?>