<?php 
$pageTitle = 'Login';
$pageCss = 'auth.css';
$pageJs = 'auth.js';
require_once BASE_PATH . '/views/layout/header.php'; 
?>

<section class="login-split">
    
    <div class="login-form-side">
        <div class="login-form-wrap">
            
            <h1 class="login-title">Welcome back</h1>
            <p class="login-sub">Sign in to continue sharing your memories.</p>
            
            <?php if (isset($_COOKIE['last_login'])): ?>
                <div class="last-login">
                    <span class="clock-icon">🕐</span>
                    Last login: <?= htmlspecialchars($_COOKIE['last_login']) ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
                <div class="login-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <div id="clientError" class="login-error" style="display: none;"></div>
            
            <form method="POST"
                  action="/alzikrayat/public/login"
                  id="loginForm">
                
                <div class="field">
                    <label>Email</label>

                    <input type="email" 
                           name="email" 
                           id="email"
                           placeholder="Enter your email" 
                           required>
                </div>
                
                <div class="field">
                    <label>Password</label>

                    <div class="password-wrap">
                        <input type="password" 
                               name="password" 
                               id="password"
                               placeholder="Enter your password" 
                               required>

                        <button type="button" 
                                class="toggle-pass" 
                                onclick="togglePassword()">
                            👁
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="btn-login">
                    Login
                </button>
                
            </form>
            
            <p class="signup-line">
                Don't have an account?
                <a href="/alzikrayat/public/register">
                    Create an account
                </a>
            </p>
            
        </div>
    </div>
    
    <div class="login-image-side">
        <div class="image-overlay"></div>

        <div class="image-content">
            <p class="image-quote">
                "Every frame holds a memory waiting to be rediscovered."
            </p>

            <div class="image-tag">
                ALZIKRAYAT <span>·</span> PHOTO SHARING
            </div>
        </div>

        <div class="image-thumbs">
            <div class="thumb" style="background-image: url('/alzikrayat/public/images/thumb-1.jpg');"></div>
            <div class="thumb" style="background-image: url('/alzikrayat/public/images/thumb-2.jpg');"></div>
            <div class="thumb" style="background-image: url('/alzikrayat/public/images/thumb-3.jpg');"></div>
        </div>
    </div>
    
</section>



<?php require_once BASE_PATH . '/views/layout/footer.php'; ?>