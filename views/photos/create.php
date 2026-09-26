<?php 
// upload photo page
$pageTitle = 'Upload Photo';
$pageCss = 'upload.css';
$pageJs = 'upload.js';
require_once BASE_PATH . '/views/layout/header.php'; 
?>

<div class="upload-wrapper">

    <div class="row justify-content-center">
        <div class="col-md-7">

            <!-- header: page title and short description -->
            <div class="upload-header">
                <span class="upload-tag">SHARE A MEMORY</span>
                <h1 class="upload-title">Upload Photo</h1>
                <p class="upload-sub">Add a new memory to the gallery.</p>
            </div>

            <!-- error message from the server side (if any) -->
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <div class="upload-card">

                <!-- error message from the client side (javascript) -->
                <div id="uploadError" class="alert alert-danger" style="display: none;"></div>

                <form
                    method="POST"
                    action="/alzikrayat/public/photo/store"
                    enctype="multipart/form-data"
                    id="uploadForm"
                >

                    <!-- title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control"
                            maxlength="200"
                            placeholder="Give your photo a title"
                            required
                        >
                    </div>

                    <!-- description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            Description <span class="opt">(optional)</span>
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            class="form-control"
                            rows="4"
                            maxlength="5000"
                            placeholder="Tell the story behind this moment..."
                        ></textarea>
                    </div>

                    <!-- tag people: list of all users except yourself -->
                    <div class="mb-3">
                        <label for="tagged_users" class="form-label">
                            Tag People <span class="opt">(optional)</span>
                        </label>

                        <select
                            name="tagged_users[]"
                            id="tagged_users"
                            class="form-control"
                            multiple
                        >
                            <?php foreach ($users as $user): ?>
                                <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                    <option value="<?= $user['id'] ?>">
                                        <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>

                        <small class="form-hint">
                            Hold Ctrl and select more than one person.
                        </small>
                    </div>

                    <!-- photo file -->
                    <div class="mb-4">
                        <label for="photo" class="form-label">
                            Choose Photo
                        </label>

                        <input
                            type="file"
                            name="photo"
                            id="photo"
                            class="form-control"
                            accept="image/jpeg,image/png,image/gif,image/webp"
                            required
                        >

                        <small class="form-hint">JPG, PNG, GIF or WEBP — max 5MB</small>
                    </div>

                    <!-- buttons -->
                    <div class="form-actions">
                        <a
                            href="/alzikrayat/public/photos"
                            class="btn-cancel"
                        >
                            Cancel
                        </a>

                        <button type="submit" class="btn-submit" id="submitBtn">
                            Upload Photo
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

</div>

<?php require_once BASE_PATH . '/views/layout/footer.php'; ?>