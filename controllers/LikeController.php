<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Like.php';
require_once __DIR__ . '/../models/Photo.php';

/**
 * Handles photo likes.
 */
class LikeController extends Controller
{
    /**
     * Adds or removes the current user's like on a photo.
     * JavaScript requests get the new like state without refreshing the page.
     *
     * @param int $photoId Photo ID from the route.
     * @return void
     */
    public function toggle($photoId)
    {
        $this->requireLogin();

        $photoId = (int) $photoId;

        $isAjax =
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])
            === 'xmlhttprequest';

        if ($photoId < 1) {

            if ($isAjax) {
                $this->jsonResponse(
                    false,
                    ['message' => 'Invalid photo.'],
                    400
                );
            }

            $this->redirect('/alzikrayat/public/photos');
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

            $this->redirect('/alzikrayat/public/photos');
        }

        $like = new Like();

        $status = $like->toggle(
            $_SESSION['user_id'],
            $photoId
        );

        $likeCount = $like->countByPhoto($photoId);

        if ($isAjax) {
            $this->jsonResponse(
                true,
                [
                    'liked' => $status === 'liked',
                    'likeCount' => $likeCount
                ]
            );
        }

        $this->redirect(
            '/alzikrayat/public/photo/' . $photoId
        );
    }
}