<?php
require_once __DIR__. '/../core/Controller.php';
require_once __DIR__. '/../models/User.php';

/**
 * Handles user registration, login and logout.
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

    /**
     * Handles user registration.
     *
     * @return void
     */
    public function register(){

        $firstName = trim($_POST['first_name'] ?? '');
        $lastName = trim($_POST['last_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $location = trim($_POST['location'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $occupation = trim($_POST['occupation'] ?? '');

        $errors = [];

        if ($firstName === '' || strlen($firstName) >50 || !preg_match('/^\p{L}+$/u', $firstName)) {
            $errors[] = "Invalid first name.";
        }

        if ($lastName === '' || strlen($lastName) >50 || !preg_match('/^\p{L}+$/u', $lastName)) {
            $errors[] = "Invalid Last name.";
        }

        if ($email === '' || strlen($email) > 100 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email.";
        }

        if ($password === '' || strlen($password) <8 ) {
            $errors[] = "Password must be at least 8 characters.";
        }

        if (strlen($location) > 100) {
            $errors[] = "Location is too long.";
        }

        if (strlen($occupation) > 100) {
            $errors[] = "Occupation is too long.";
        }
        if (strlen($description) > 5000) {
    $errors[] = "Description is too long.";
}

        if (!empty($errors)) {
            $this->view('auth/register', [
                'errors' => $errors
            ]);
            return;
        }

        // Hash password and create user
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $user = new User();

        if($user->findByEmail($email)){
            $this->view('auth/register', [
                'errors' => ['Email alreadyexist']
            ]);
            return;
        }
        else{
            $user->create(
                $firstName,
                $lastName,
                $email,
                $hashedPassword,
                $location,
                $description,
                $occupation
            );

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

    /**
     * Handles user login.
     *
     * @return void
     */
    public function login(){

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->view('auth/login', [
                'error' => 'Please enter a valid email address.'
            ]);
            return;
        }

        if ($password === '') {
            $this->view('auth/login', [
                'error' => 'Password is required.'
            ]);
            return;
        }

        $user = new User();
        $existingUser = $user->findByEmail($email);

        if (!$existingUser) {
            $this->view('auth/login', [
                'error' => 'Email or password is incorrect.'
            ]);
            return;
        }

        if (!password_verify($password, $existingUser['password'])) {
            $this->view('auth/login', [
                'error' => 'Email or password is incorrect.'
            ]);
            return;
        }
        session_regenerate_id(true);
        $_SESSION['user_id'] = $existingUser['id'];
        $_SESSION['first_name'] = $existingUser['first_name'];

        // Set last-login cookie (7 days)
        setcookie(
            'last_login',
            date('Y-m-d H:i:s'),
            time() + (7 * 24 * 60 * 60),
            '/'
        );

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