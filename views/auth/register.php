<?php 
$pageTitle = 'Register';
$pageCss = 'auth.css';
$pageJs = 'auth.js';

require_once BASE_PATH . '/views/layout/header.php'; 
?>

<section class="register-split">
    
    <div class="register-image-side">
        <div class="image-overlay"></div>

        <div class="image-content">
            <p class="image-quote">
                "Your story begins with a single frame."
            </p>

            <div class="image-tag">
                ALZIKRAYAT <span>·</span> JOIN THE JOURNEY
            </div>
        </div>
    </div>
    
    <div class="register-form-side">
        <div class="register-form-wrap">
            
            <h1 class="register-title">Create account</h1>
            <p class="register-sub">Start capturing and sharing memories.</p>
            
            <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $e): ?>
                    <div class="register-error">
                        <?= htmlspecialchars($e) ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div id="clientRegisterError"
                 class="register-error"
                 style="display: none;">
            </div>
            
            <form method="POST"
                  action="/alzikrayat/public/register"
                  id="registerForm">
                
                <div class="field-row">

                    <div class="field">
                        <label>First name</label>

                        <input type="text"
                               name="first_name"
                               id="first_name"
                               required
                               maxlength="50"
                               placeholder="Ahmed">
                    </div>

                    <div class="field">
                        <label>Last name</label>

                        <input type="text"
                               name="last_name"
                               id="last_name"
                               required
                               maxlength="50"
                               placeholder="Ali">
                    </div>

                </div>
                
                <div class="field">
                    <label>Email</label>

                    <input type="email"
                           name="email"
                           id="email"
                           required
                           placeholder="you@example.com">
                </div>
                
                <div class="field">
                    <label>Password</label>

                    <input type="password"
                           name="password"
                           id="password"
                           required
                           minlength="8"
                           placeholder="At least 8 characters">
                </div>
                
                <div class="field">
                    <label>
                        Location <span class="opt">(optional)</span>
                    </label>

                    <input type="text"
                           name="location"
                           id="location"
                           maxlength="100"
                           placeholder="Khartoum">
                </div>
                
                <div class="field">
                    <label>
                        Occupation <span class="opt">(optional)</span>
                    </label>

                    <input type="text"
                           name="occupation"
                           id="occupation"
                           maxlength="100"
                           placeholder="Student">
                </div>
                
                <div class="field">
                    <label>
                        Bio <span class="opt">(optional)</span>
                    </label>

                    <textarea name="description"
                              id="description"
                              rows="2"
                              maxlength="1000"
                              placeholder="A few words..."></textarea>
                </div>
                
                <button type="submit" class="btn-register-submit">
                    Create account
                </button>
                
            </form>
            
            <p class="signin-line">
                Already have an account?
                <a href="/alzikrayat/public/login">
                    Sign in
                </a>
            </p>
            
        </div>
    </div>
    
</section>


<?php require_once BASE_PATH . '/views/layout/footer.php'; ?>