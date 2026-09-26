<?php require_once BASE_PATH . '/views/layout/header.php'; ?>

<section class="error-section">
    
    <div class="error-content">
        
        <div class="error-number">
            <span>4</span>
            <span class="error-icon">📷</span>
            <span>4</span>
        </div>
        
        <h1 class="error-title">Page not found</h1>
        
        <p class="error-text">
            The memory you're looking for might have been moved, deleted, 
            or perhaps never existed.
        </p>
        
        <div class="error-actions">
            <a href="/alzikrayat/public/" class="btn-primary-error">
                Back to Home
            </a>
            <a href="/alzikrayat/public/photos" class="btn-outline-error">
                Browse Photos
            </a>
        </div>
        
    </div>
    
</section>

<style>
.error-section {
    min-height: calc(100vh - 62px - 120px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 24px;
    background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 50%, #f0fdfa 100%);
}

.error-content {
    text-align: center;
    max-width: 520px;
}

.error-number {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    margin-bottom: 20px;
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 120px;
    font-weight: 700;
    line-height: 1;
    background: linear-gradient(135deg, #10b981, #0d9488);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.error-icon {
    font-size: 72px;
    -webkit-text-fill-color: initial;
    opacity: 0.5;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.error-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 36px;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 16px;
    letter-spacing: -0.5px;
}

.error-text {
    color: #64748b;
    font-size: 16px;
    line-height: 1.6;
    margin: 0 0 36px;
}

.error-actions {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-primary-error {
    display: inline-block;
    background: linear-gradient(135deg, #10b981, #0d9488);
    color: #fff;
    padding: 14px 32px;
    border-radius: 999px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}

.btn-primary-error:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 30px rgba(16, 185, 129, 0.35);
    color: #fff;
}

.btn-outline-error {
    display: inline-block;
    background: transparent;
    color: #059669;
    padding: 14px 32px;
    border-radius: 999px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    border: 2px solid #10b981;
    transition: all 0.3s;
}

.btn-outline-error:hover {
    background: #10b981;
    color: #fff;
    transform: translateY(-2px);
}

@media (max-width: 576px) {
    .error-number {
        font-size: 80px;
        gap: 12px;
    }
    .error-icon {
        font-size: 48px;
    }
    .error-title {
        font-size: 26px;
    }
    .error-text {
        font-size: 14px;
    }
    .btn-primary-error,
    .btn-outline-error {
        padding: 12px 24px;
        font-size: 14px;
    }
}
</style>

<?php require_once BASE_PATH . '/views/layout/footer.php'; ?>