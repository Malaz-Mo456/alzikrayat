<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Comment.php';
require_once __DIR__ . '/../models/Photo.php';

/**
 * Handles comment-related requests.
 */
class CommentController extends Controller
{
  /**
     * Stores a new comment for a photo.
     *
     * Checks the user login status and validates
     * the comment before saving it to the database.
     *
     * @return void
     */
    public function store()
    {
        $this->requireLogin();

        $photoId = filter_input(INPUT_POST, 'photo_id', FILTER_VALIDATE_INT);
        $commentText = trim($_POST['comment'] ?? '');

        if (!$photoId || $photoId < 1) {
            echo "Invalid photo.";
            return;
        }

        if ($commentText === '') {
            echo "Comment is required.";
            return;
        }

        if (strlen($commentText) > 1000) {
            echo "Comment is too long.";
            return;
        }

        $photo = new Photo();

        if (!$photo->findById($photoId)) {
            echo "Photo not found.";
            return;
        }

        $comment = new Comment();

        $comment->create(
            $photoId,
            $_SESSION['user_id'],
            $commentText
        );

        $this->redirect('/alzikrayat/public/photo/' . $photoId);
    }
}