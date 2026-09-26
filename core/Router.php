<?php

/**
 * Small manual router used to connect URLs with controller methods.
 * It uses regular expressions for routes that contain IDs.
 */
class Router
{
    private $routes = [];

    /**
     * Adds a route to the list of available routes.
     *
     * @param string $method HTTP method such as GET or POST.
     * @param string $path Route path, for example /photo/{id}.
     * @param array $handler Controller name and method name.
     * @return void
     */
    public function add($method, $path, $handler)
    {
        $this->routes[] = [$method, $path, $handler];
    }

    /**
     * Finds the route that matches the current request and calls its controller.
     * Dynamic route values are captured using regular expressions.
     *
     * @return void
     */
    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $path = parse_url(
            $_SERVER['REQUEST_URI'],
            PHP_URL_PATH
        );

        // Remove the project folder and /public from the requested URL.
        $basePath = '/alzikrayat';

        if (strpos($path, $basePath) === 0) {
            $path = substr($path, strlen($basePath));
        }

        if (strpos($path, '/public') === 0) {
            $path = substr($path, strlen('/public'));
        }

        if ($path === '' || $path === false) {
            $path = '/';
        }

        foreach ($this->routes as $route) {

            if ($route[0] !== $method) {
                continue;
            }

            // Convert /photo/{id} into a regular expression that captures the ID.
            $pattern = preg_replace(
                '/\{([a-zA-Z]+)\}/',
                '([^/]+)',
                $route[1]
            );

            $pattern = '#^' . $pattern . '$#';

            if (!preg_match($pattern, $path, $matches)) {
                continue;
            }

            $handler = $route[2];

            $controllerName = $handler[0];
            $methodName = $handler[1];

            $controllerFile =
                __DIR__ . '/../controllers/' . $controllerName . '.php';

            if (!file_exists($controllerFile)) {
                die('Error: Controller file not found.');
            }

            require_once $controllerFile;

            $controller = new $controllerName();

            if (!method_exists($controller, $methodName)) {
                die('Error: Controller method not found.');
            }

            // Remove the full match and keep only the route parameters.
            $params = array_slice($matches, 1);

            call_user_func_array(
                [$controller, $methodName],
                $params
            );

            return;
        }

        http_response_code(404);

        require_once BASE_PATH . '/views/errors/404.php';
    }
}