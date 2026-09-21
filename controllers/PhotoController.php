<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Photo.php';
require_once __DIR__ . '/../models/Comment.php';



/**
 * Handles photo-related requests.
 */
class PhotoController extends Controller{
    /**
     * Displays all photos.
     */
    public function index(){
        $photo=new Photo();
$allPhotos=$photo->getAll();
$this->view('photos/index', ['photos' => $allPhotos]);
    }
    

    /**
     * Displays one photo with its comments.
     */
    public function show($id){
        $photo=new Photo();
    $comment = new Comment();
$photoData=$photo->findById($id);
$allComments=$comment->getByPhoto($id);
$this->view('photos/show',['photo' => $photoData ,'comments'=>$allComments]);
    }
    /**
 * Displays the photo upload form.
 *
 * @return void
 */
public function create()
{
    $this->requireLogin();
    $this->view('photos/create');
}

    /**
     * Displays the photo upload form.
     */
  

    /**
     * Handles photo upload.
     */
   
        /**
 * Handles photo upload.
 *
 * @return void
 */
public function store()
{
    $this->requireLogin();

    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($title === '') {
        echo "Title is required.";
        return;
    }

    if (strlen($title) > 200) {
        echo "Title is too long.";
        return;
    }

    if (strlen($description) > 5000) {
        echo "Description is too long.";
        return;
    }

    if (!isset($_FILES['photo'])) {
        echo "Please choose a photo.";
        return;
    }

    if ($_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        echo "There was an error uploading the photo.";
        return;
    }

    $file = $_FILES['photo'];

    if ($file['size'] > 5 * 1024 * 1024) {
        echo "Photo size must not exceed 5 MB.";
        return;
    }

    $allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp'
    ];

    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($fileInfo, $file['tmp_name']);
    finfo_close($fileInfo);

    if (!in_array($mimeType, $allowedTypes, true)) {
        echo "Invalid photo type.";
        return;
    }

    $extensions = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp'
    ];

    $extension = $extensions[$mimeType];

    $fileName = uniqid('photo_', true) . '.' . $extension;

    $uploadDirectory = __DIR__ . '/../public/images/uploads/';
    $filePath = $uploadDirectory . $fileName;

    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0755, true);
    }

    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
        echo "Failed to save the photo.";
        return;
    }

    try {
        $photo = new Photo();

        $photo->create(
            $_SESSION['user_id'],
            $fileName,
            $title,
            $description
        );

        $this->redirect('/alzikrayat/public/photos');

    } catch (Exception $e) {

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        echo "Failed to save photo information.";
    }
}

    
    /**
     * Deletes a photo owned by the logged-in user.
     */
    public function delete($id){
        $this->requireLogin();

    $photo = new Photo();
    $photoData = $photo->findById($id);

    if (!$photoData) {
        echo "Photo not found.";
        return;
    }

    if ($_SESSION['user_id'] != $photoData['user_id']) {
        echo "You are not allowed to delete this photo.";
        return;
    }

    $filePath = __DIR__ . '/../public/images/uploads/' . $photoData['file_name'];

    if (file_exists($filePath)) {
        unlink($filePath);
    }

    $photo->delete($id);

    $this->redirect('/alzikrayat/public/photos');

    }

}