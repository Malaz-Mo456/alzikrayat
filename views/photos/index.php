<?php 
// photos gallery page
$pageTitle = 'Photos';
$pageCss = 'photos.css';
$pageJs = 'photos.js';
require_once BASE_PATH . '/views/layout/header.php'; 
?>

<section class="photos-section">

    <!-- header: title and upload button for logged in users -->
    <div class="photos-header">
        <div>
            <span class="photos-tag">GALLERY</span>
            <h1 class="photos-title">Photos</h1>
            <p class="photos-sub"><?= count($photos) ?> memories shared by the community</p>
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/alzikrayat/public/photo/create" class="btn-upload">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Upload Photo
            </a>
        <?php endif; ?>
    </div>

    <!-- view controls: buttons to switch between grid, list and slider views -->
    <div class="grid-controls">
        <span class="grid-label">View:</span>

        <button class="grid-btn active" data-view="3" onclick="setView('3', this)">
            3 columns
        </button>

        <button class="grid-btn" data-view="4" onclick="setView('4', this)">
            4 columns
        </button>

        <button class="grid-btn" data-view="list" onclick="setView('list', this)">
            List
        </button>

        <button class="grid-btn" data-view="slider" onclick="setView('slider', this)">
            Slider
        </button>
    </div>

    <!-- if there are no photos, show a friendly message -->
    <?php if (empty($photos)): ?>

        <div class="photos-empty">
            <div class="empty-icon">📷</div>
            <h3>No photos yet</h3>
            <p>Be the first to share a memory with the community.</p>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/alzikrayat/public/photo/create" class="btn-upload">
                    Upload First Photo
                </a>
            <?php else: ?>
                <a href="/alzikrayat/public/register" class="btn-upload">
                    Join to Share
                </a>
            <?php endif; ?>
        </div>

    <!-- if there are photos, show them -->
    <?php else: ?>

        <!-- grid view: shows photos in a grid -->
        <div class="photos-grid cols-3" id="photosGrid">

            <?php foreach ($photos as $photo): ?>

                <div class="photo-card">

                    <a href="/alzikrayat/public/photo/<?= $photo['id'] ?>" class="photo-card-link">

                        <div class="photo-image">

                            <?php // show image if file exists, otherwise show a placeholder ?>
                            <?php if (!empty($photo['file_name']) && file_exists(BASE_PATH . '/public/images/uploads/' . $photo['file_name'])): ?>

                                <img
                                    src="/alzikrayat/public/images/uploads/<?= htmlspecialchars($photo['file_name']) ?>"
                                    alt="<?= htmlspecialchars($photo['title']) ?>"
                                    loading="lazy"
                                >

                            <?php else: ?>

                                <div class="no-image">
                                    <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                                        <circle cx="12" cy="13" r="4"/>
                                    </svg>
                                    <span>No image</span>
                                </div>

                            <?php endif; ?>

                        </div>

                        <div class="photo-info">
                            <h3 class="photo-title">
                                <?= htmlspecialchars($photo['title']) ?>
                            </h3>

                            <p class="photo-author">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>

                                <?= htmlspecialchars($photo['first_name'] . ' ' . $photo['last_name']) ?>
                            </p>
                        </div>

                    </a>

                    <div class="photo-card-footer">
                        <a
                            href="/alzikrayat/public/photo/<?= $photo['id'] ?>"
                            class="btn-details"
                        >
                            View Details
                        </a>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>

        <!-- slider view: shows one large photo at a time with arrows -->
        <div class="slider-view" id="sliderView">

            <div class="slider-container">

                <?php foreach ($photos as $index => $photo): ?>

                    <div class="slide <?= $index === 0 ? 'active-slide' : '' ?>">

                        <?php if (!empty($photo['file_name']) && file_exists(BASE_PATH . '/public/images/uploads/' . $photo['file_name'])): ?>

                            <img
                                src="/alzikrayat/public/images/uploads/<?= htmlspecialchars($photo['file_name']) ?>"
                                alt="<?= htmlspecialchars($photo['title']) ?>"
                            >

                        <?php endif; ?>

                        <div class="slide-content">

                            <span class="slide-number">
                                <?= $index + 1 ?> / <?= count($photos) ?>
                            </span>

                            <h2>
                                <?= htmlspecialchars($photo['title']) ?>
                            </h2>

                            <p>
                                By <?= htmlspecialchars($photo['first_name'] . ' ' . $photo['last_name']) ?>
                            </p>

                            <a
                                href="/alzikrayat/public/photo/<?= $photo['id'] ?>"
                                class="btn-details slider-details"
                            >
                                View Details
                            </a>

                        </div>

                    </div>

                <?php endforeach; ?>

                <button class="slider-arrow slider-prev" onclick="changeSlide(-1)">
                    &#10094;
                </button>

                <button class="slider-arrow slider-next" onclick="changeSlide(1)">
                    &#10095;
                </button>

            </div>

        </div>

    <?php endif; ?>

</section>

<?php require_once BASE_PATH . '/views/layout/footer.php'; ?>