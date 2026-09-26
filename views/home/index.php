<?php 
$pageTitle = 'Home';
$pageCss = 'home.css';
require_once BASE_PATH . '/views/layout/header.php'; 
?>

<!-- Hero section: welcome banner with the site name -->
<section class="hero">
    <div class="hero-overlay"></div>

    <div class="hero-content">
        <span class="hero-tag">PHOTO SHARING, REIMAGINED</span>

        <h1 class="hero-title">Alzikrayat</h1>

        <p class="hero-subtitle">
            Every picture tells a story worth keeping.
        </p>

        <div class="hero-buttons">
            <a href="/alzikrayat/public/photos" class="btn-hero-primary">
                Start Sharing
            </a>

            <a href="/alzikrayat/public/photos" class="btn-hero-outline">
                Explore Gallery
            </a>
        </div>

        <p class="hero-info">
            <?= $total ?> memories shared by <?= $users ?> storytellers
        </p>
    </div>

    <div class="hero-scroll">
        <span>⌄</span>
    </div>
</section>


<!-- Stats bar: total photos, users and comments -->
<div class="stats-bar">

    <div class="stat">
        <div class="stat-number"><?= $total ?></div>
        <div class="stat-label">PHOTOS</div>
        <div class="stat-sub">Captured</div>
    </div>

    <div class="stat-divider"></div>

    <div class="stat">
        <div class="stat-number"><?= $users ?></div>
        <div class="stat-label">MEMBERS</div>
        <div class="stat-sub">Sharing</div>
    </div>

    <div class="stat-divider"></div>

    <div class="stat">
        <div class="stat-number"><?= $comments ?></div>
        <div class="stat-label">COMMENTS</div>
        <div class="stat-sub">Shared</div>
    </div>

</div>


<!-- Latest memories: shows 6 recent photos -->
<section class="memories-section">

    <div class="section-header">

        <div>
            <span class="section-tag">FRESH FROM THE COMMUNITY</span>
            <h2 class="section-title">Latest Memories</h2>
        </div>

        <a href="/alzikrayat/public/photos" class="view-all">
            View all →
        </a>

    </div>


    <?php if (!empty($recent)): ?>

        <div class="memories-grid">

            <?php foreach ($recent as $p): ?>

                <a
                    href="/alzikrayat/public/photo/<?= (int) $p['id'] ?>"
                    class="memory-card"
                >

                    <img
                        src="/alzikrayat/public/images/uploads/<?= htmlspecialchars($p['file_name']) ?>"
                        alt="<?= htmlspecialchars($p['title']) ?>"
                    >

                    <div class="memory-overlay">

                        <div class="memory-title">
                            <?= htmlspecialchars($p['title']) ?>
                        </div>

                        <div class="memory-author">
                            by <?= htmlspecialchars($p['first_name']) ?>
                        </div>

                    </div>

                </a>

            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <div class="empty-memories">

            <div class="empty-emoji">📷</div>

            <h3>Nothing here yet</h3>

            <p>Be the first to share a memory.</p>

            <?php if (isset($_SESSION['user_id'])): ?>

                <a href="/alzikrayat/public/photo/create" class="btn-emerald">
                    Upload First Photo
                </a>

            <?php else: ?>

                <a href="/alzikrayat/public/login" class="btn-emerald">
                    Login to Share
                </a>

            <?php endif; ?>

        </div>

    <?php endif; ?>

</section>


<!-- Quote band: photography quote -->
<section class="quote-band">

    <div class="quote-mark">"</div>

    <p class="quote-text">
        A photograph is a pause button on life.
    </p>

    <div class="quote-dots">
        • • •
    </div>

</section>


<!-- About teaser: short intro with three polaroid images -->
<section class="about-teaser">

    <div class="about-text">

        <span class="section-tag">ABOUT THE APP</span>

        <h2 class="about-title">
            Your memories,<br>
            <em>beautifully kept.</em>
        </h2>

        <p class="about-desc">
            Alzikrayat is where everyday moments become lasting stories.
            Upload, curate, and share your photos with the people who matter most.
        </p>

        <a href="/alzikrayat/public/about" class="btn-emerald">
            Learn more →
        </a>

    </div>


    <div class="about-visual">

        <div class="polaroid polaroid-1">
            <div class="polaroid-img"></div>
            <span class="polaroid-label">Memories</span>
        </div>

        <div class="polaroid polaroid-2">
            <div class="polaroid-img"></div>
            <span class="polaroid-label">Moments</span>
        </div>

        <div class="polaroid polaroid-3">
            <div class="polaroid-img"></div>
            <span class="polaroid-label">Stories</span>
        </div>

    </div>

</section>


<!-- Call to action: invite users to register -->
<section class="cta-band">

    <span class="cta-tag">JOIN THE COMMUNITY</span>

    <h2 class="cta-title">
        Ready to share your<br>
        <em>first memory?</em>
    </h2>

    <a href="/alzikrayat/public/register" class="btn-cta">
        Create your album →
    </a>

</section>


<?php require_once BASE_PATH . '/views/layout/footer.php'; ?>