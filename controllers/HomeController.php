<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Photo.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Comment.php';

/**
 * Handles the home page.
 */
class HomeController extends Controller
{
    /**
     * Displays the home page with website statistics and recent photos.
     *
     * @return void
     */
    public function index()
    {
        $photo = new Photo();
        $user = new User();
        $comment = new Comment();

        $total = $photo->getCount();
        $users = $user->getCount();
        $comments = $comment->getCount();
        $recent = $photo->getRecent(6);

        $this->view('home/index', [
            'total' => $total,
            'users' => $users,
            'comments' => $comments,
            'recent' => $recent
        ]);
    }
    /**
     * Displays the about page.
     *
     * @return void
     */
    public function about()
    {
        $this->view('home/about');
    }
}