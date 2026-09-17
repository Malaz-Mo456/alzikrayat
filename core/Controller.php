 <?php
/**
 * Abstract base Controller for the Alzikrayat application.
 *
 * Provides common functionality that can be used by
 * the application's controllers.
 */
abstract class Controller{
protected function view($view,$data=[]){

extract ($data);
  // Build the path to the requested view file.
        $file = __DIR__ . '/../views/' . $view . '.php';

    // Check whether the requested view exists.
        if (file_exists($file)) {
            require_once $file;
        } else {
            die("Error: View file not found: " . $file);
        }
    }
      /**
     * Redirect to another URL.
     * 
     * @param string $url Target URL
     * @return void
     */
    protected function redirect($url) {
        header("Location: " . $url);
        exit;
    }
    
    /**
     * Ensure user is logged in, otherwise redirect to login.
     * 
     * @return void
     */
    protected function requireLogin() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/alzikrayat/public/login');
        }
    }
}
