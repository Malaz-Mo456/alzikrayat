<?php

/**
 * Base controller used by the other controllers.
 * It keeps common view, redirect, login, and JSON response code in one place.
 */
abstract class Controller
{
    /**
     * Loads a view and sends data to it.
     *
     * @param string $view View path inside the views folder.
     * @param array $data Data that the view needs.
     * @return void
     */
    protected function view($view, $data = [])
    {
        extract($data);

        $file = __DIR__ . '/../views/' . $view . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }

        die('Error: View file not found: ' . $file);
    }

    /**
     * Redirects the user to another page.
     *
     * @param string $url Target URL.
     * @return void
     */
    protected function redirect($url)
    {
        header('Location: ' . $url);
        exit;
    }

    /**
     * Checks whether a user is logged in.
     * If not, the user is sent to the login page.
     *
     * @return void
     */
    protected function requireLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/alzikrayat/public/login');
        }
    }

    /**
     * Sends a JSON response for actions handled with JavaScript.
     *
     * @param bool $success Whether the action worked.
     * @param array $data Data to send back to the browser.
     * @param int $statusCode HTTP response status code.
     * @return void
     */
    protected function jsonResponse($success, $data = [], $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');

        echo json_encode(
            array_merge(['success' => $success], $data)
        );

        exit;
    }
}