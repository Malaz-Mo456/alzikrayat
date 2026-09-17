<?php
require_once __DIR__. '/../core/Controller.php';
require_once __DIR__. '/../models/User.php';
/**
 * Handel user registration and loginand logout
 */
class AuthController extends Controller{
     /**
     * Display the registration form.
     * 
     * @return void
     */
    public function registerForm() {
        $this->view('auth/register');
    }
public function register(){
$firstName = trim( $_POST['first_name']);
$lastName =trim( $_POST['last_name']);
$email =trim( $_POST['email']);
$password = $_POST['password'];
$location =trim( $_POST['location']);
$description =trim( $_POST['description']);
$occupation = trim($_POST['occupation']);
if ($firstName === '' || strlen($firstName) >50 || !preg_match('/^\p{L}+$/u', $firstName)) {
    echo "Invalid first name.";
    return;
}
if ($lastName  === '' || strlen($lastName ) >50 || !preg_match('/^\p{L}+$/u', $lastName )) {
    echo "Invalid Last name.";
    return;
}
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email.";
    return;
}
if ($password  === '' || strlen($password ) <8 ) {
    echo "password must be at least 8 characters";
    return;
}
if (strlen($location) > 100) {
    echo "Location is too long.";
    return;
}

if (strlen($occupation) > 100) {
    echo "Occupation is too long.";
    return;
}
   // Hash password and create user
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $user=new User();
    if($user->findByEmail($email)){
         echo 'Email alreadyexist';
return;
    }
    else{
          $user->create($firstName, $lastName, $email, $hashedPassword, $location, $description, $occupation);

        // Redirect to login
    $this->redirect('/alzikrayat/public/login');
          
    }


}
   /**
     * Display the login form.
     * 
     * @return void
     */
    public function loginForm() {
        $this->view('auth/login');
    }
public function login(){

$email =trim( $_POST['email']);
$password = $_POST['password'];
   $user=new User();
   $existingUser=$user->findByEmail($email);
   if (!$existingUser) {
    echo "Email or password is incorrect.";
    return;
}
if (!password_verify($password, $existingUser['password'])) {
    echo "Email or password is incorrect.";
    return;
}
$_SESSION['user_id']= $existingUser['id'];
$_SESSION['first_name']= $existingUser['first_name'];
  // Set last-login cookie (7 days)
        setcookie('last_login', date('Y-m-d H:i:s'), time() + (7 * 24 * 60 * 60), '/');

        // Redirect to gallery
       $this->redirect('/alzikrayat/public/photos');
    }

    /**
     * Handle user logout.
     * Destroys session and redirects to login.
     * 
     * @return void
     */
    public function logout() {
        session_destroy();
     $this->redirect('/alzikrayat/public/login');
    }

}
