<?php

// Single photo page.
$pageTitle = 'Photo Details';
$pageCss = 'photos.css';
$pageJs = 'show.js';

require_once BASE_PATH . '/views/layout/header.php';
?>

<div class="photo-details-page">

    <div class="photo-details-container">

        <!-- Back to the gallery. -->
        <a
            href="/alzikrayat/public/photos"
            class="back-link"
        >
            ← Back to Gallery
        </a>

        <!-- Main photo card with the image and its information. -->
        <div class="photo-main-card">

            <img
                src="/alzikrayat/public/images/uploads/<?= htmlspecialchars($photo['file_name']) ?>"
                class="main-photo"
                alt="<?= htmlspecialchars($photo['title']) ?>"
            >

            <div class="photo-content">

                <div class="photo-heading">

                    <div>

                        <span class="photo-label">
                            PHOTO DETAILS
                        </span>

                        <h2 class="photo-title">
                            <?= htmlspecialchars($photo['title']) ?>
                        </h2>

                    </div>

                </div>

                <!-- Show the person who uploaded the photo. -->
                <p class="photo-author">

                    By:

                    <strong>
                        <?= htmlspecialchars(
                            $photo['first_name'] .
                            ' ' .
                            $photo['last_name']
                        ) ?>
                    </strong>

                </p>

                <!-- Show tagged users when the photo has tags. -->
                <?php if (!empty($tags)): ?>

                    <div class="photo-tags">

                        <strong>🏷️ Tagged:</strong>

                        <?php

                        $tagNames = array_map(
                            function ($tag) {
                                return htmlspecialchars(
                                    $tag['first_name'] .
                                    ' ' .
                                    $tag['last_name']
                                );
                            },
                            $tags
                        );

                        echo implode(', ', $tagNames);
                        ?>

                    </div>

                <?php endif; ?>

                <!-- Show the description only when one was added. -->
                <?php if (!empty($photo['description'])): ?>

                    <p class="photo-description">
                        <?= htmlspecialchars($photo['description']) ?>
                    </p>

                <?php endif; ?>

                <p class="photo-date">

                    Date:
                    <?= htmlspecialchars($photo['date_time']) ?>

                </p>

                <!-- Photo actions such as like and delete. -->
                <div class="photo-actions">

                    <!-- Logged-in users can like without refreshing the page. -->
                    <?php if (isset($_SESSION['user_id'])): ?>

                        <a
                            href="/alzikrayat/public/photo/<?= (int) $photo['id'] ?>/like"
                            class="like-btn <?= !empty($userLiked) ? 'liked' : '' ?>"
                            id="likeButton"
                            data-url="/alzikrayat/public/photo/<?= (int) $photo['id'] ?>/like"
                        >

                            <svg
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="<?= !empty($userLiked) ? 'currentColor' : 'none' ?>"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >

                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>

                            </svg>

                            <span id="likeCount">
                                <?= $likeCount ?? 0 ?>
                                <?= ($likeCount ?? 0) == 1 ? 'like' : 'likes' ?>
                            </span>

                        </a>

                    <?php else: ?>

                        <!-- Guests can see the count but must log in to like. -->
                        <div class="like-btn-disabled">

                            <svg
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >

                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>

                            </svg>

                            <span>
                                <?= $likeCount ?? 0 ?>
                                <?= ($likeCount ?? 0) == 1 ? 'like' : 'likes' ?>
                            </span>

                            <a
                                href="/alzikrayat/public/login"
                                class="like-login"
                            >
                                Login to like
                            </a>

                        </div>

                    <?php endif; ?>

                    <!-- Only the owner can delete the photo. -->
                    <?php if (
                        isset($_SESSION['user_id']) &&
                        $_SESSION['user_id'] == $photo['user_id']
                    ): ?>

                        <a
                            href="/alzikrayat/public/photo/<?= (int) $photo['id'] ?>/delete"
                            class="delete-btn"
                            onclick="return confirm('Delete this photo?')"
                        >
                            Delete
                        </a>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <!-- Comments section. -->
        <div class="comments-card">

            <div class="comments-header">

                <span class="comments-label">
                    COMMUNITY
                </span>

                <h3>
                    Comments
                </h3>

            </div>

            <!-- Logged-in users can add comments without refreshing. -->
            <?php if (isset($_SESSION['user_id'])): ?>

                <form
                    method="POST"
                    action="/alzikrayat/public/comment/store"
                    class="comment-form"
                    id="commentForm"
                >

                    <input
                        type="hidden"
                        name="photo_id"
                        value="<?= (int) $photo['id'] ?>"
                    >

                    <div class="comment-input-wrapper">

                        <input
                            type="text"
                            name="comment"
                            id="commentInput"
                            class="comment-input"
                            placeholder="Write a comment..."
                            maxlength="1000"
                            required
                        >

                        <button
                            type="submit"
                            class="send-btn"
                            id="sendCommentBtn"
                        >
                            Send
                        </button>

                    </div>

                    <div
                        id="commentError"
                        class="comment-error"
                        style="display: none;"
                    ></div>

                </form>

            <?php else: ?>

                <p class="login-comment">

                    <a href="/alzikrayat/public/login">
                        Login
                    </a>

                    to add a comment.

                </p>

            <?php endif; ?>

            <!-- Show existing comments. -->
            <?php if (empty($comments)): ?>

                <p class="no-comments">
                    No comments yet.
                </p>

            <?php else: ?>

                <div class="comments-list">

                    <?php foreach ($comments as $comment): ?>

                        <div class="comment-item">

                            <div class="comment-user">

                                <div class="user-circle">
                                    <?= htmlspecialchars(
                                        strtoupper(
                                            substr(
                                                $comment['first_name'],
                                                0,
                                                1
                                            )
                                        )
                                    ) ?>
                                </div>

                                <strong>
                                    <?= htmlspecialchars(
                                        $comment['first_name']
                                    ) ?>
                                </strong>

                            </div>

                            <p class="comment-text">
                                <?= htmlspecialchars(
                                    $comment['comment']
                                ) ?>
                            </p>

                            <small class="comment-date">
                                <?= htmlspecialchars(
                                    $comment['date_time']
                                ) ?>
                            </small>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php
require_once BASE_PATH . '/views/layout/footer.php';
?>