<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Comment.php';
require_once __DIR__ . '/../models/Photo.php';

/**
 * Handles adding comments to photos.
 */
class CommentController extends Controller
{
    /**
     * Adds a new comment to a photo.
     * Normal form submissions return to the photo page.
     * JavaScript requests receive the new comment as JSON.
     *
     * @return void
     */
    public function store()
    {
        $this->requireLogin();

        $photoId = filter_input(
            INPUT_POST,
            'photo_id',
            FILTER_VALIDATE_INT
        );

        $commentText = trim(
            $_POST['comment'] ?? ''
        );

        $isAjax =
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])
            === 'xmlhttprequest';

        if (!$photoId || $photoId < 1) {

            if ($isAjax) {
                $this->jsonResponse(
                    false,
                    ['message' => 'Invalid photo.'],
                    400
                );
            }

            echo 'Invalid photo.';
            return;
        }

        if ($commentText === '') {

            if ($isAjax) {
                $this->jsonResponse(
                    false,
                    ['message' => 'Comment is required.'],
                    400
                );
            }

            echo 'Comment is required.';
            return;
        }

        if (mb_strlen($commentText) > 1000) {

            if ($isAjax) {
                $this->jsonResponse(
                    false,
                    ['message' => 'Comment is too long.'],
                    400
                );
            }

            echo 'Comment is too long.';
            return;
        }

        $photo = new Photo();

        if (!$photo->findById($photoId)) {

            if ($isAjax) {
                $this->jsonResponse(
                    false,
                    ['message' => 'Photo not found.'],
                    404
                );
            }

            echo 'Photo not found.';
            return;
        }

        $comment = new Comment();

        $comment->create(
            $photoId,
            $_SESSION['user_id'],
            $commentText
        );

        if ($isAjax) {
            $this->jsonResponse(
                true,
                [
                    'comment' => [
                        'first_name' => $_SESSION['first_name'],
                        'comment' => $commentText,
                        'date_time' => date('Y-m-d H:i:s')
                    ]
                ]
            );
        }

        $this->redirect(
            '/alzikrayat/public/photo/' . $photoId
        );
    }
}