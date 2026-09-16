

<?php  
/**  
 * Router for handling the application routes between fiels
 * Maps incoming HTTP requests to the appropriate controller actions
 * using Regular Expressions for dynamic parameter extraction.  
 *  
 */  
class Router{  
    /**  
    * Registered routes collection.
     * Each element is an array: [HTTP_method, path_pattern, handler]
     * 
     * @var array
     *  
     * */  
private $routes=[];  
    /**
     * Register a new route in the router.
     * 
     * @param string $HTTP_method  HTTP method (GET or POST)
     * @param string $path         URL pattern, may contain parameters like /photo/{id}
     * @param array  $handler      [ControllerName, methodName]
     * @return void
     */
public function add($HTTP_method,$path,$handler){  
 $this->routes[]=[$HTTP_method,$path,$handler];  
}  
  /**
     * Match the current request against registered routes and dispatch it.
     * 
     * Reads the HTTP method and URI, strips the project base path,
     * converts route patterns into regular expressions, and invokes
     * the matched controller method with extracted parameters.
     * 
     * @return void
     */
public function dispatch()  
{  
 $method = $_SERVER['REQUEST_METHOD'];  
  
 $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 
 // Strip project base path from URI
// /alzikrayat/public/photo/25  →  /photo/25 
$basePath = '/alzikrayat';
if (strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}
 // Strip /public segment if present

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
 // Convert route pattern to regex
 $pattern = preg_replace(  
 '/\{([a-zA-Z]+)\}/',  
 '([^/]+)',  
 $route[1]  
 );  
  
 $pattern = '#' . '^' . $pattern . '$' . '#';  
  
 if (preg_match($pattern, $path, $matches)) {  
 $handler = $route[2];  
  
 $controllerName = $handler[0];  
 $methodName = $handler[1];  
  
 $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';  
  
if (!file_exists($controllerFile)) {  
 die("Error: Controller file not found.");  
 }  
  
 require_once $controllerFile;  
  
 $controller = new $controllerName();  
  
 if (!method_exists($controller, $methodName)) {  
 die("Error: Controller method not found.");  
 }  
    // Remove full match, keep only captured parameters
 $params = array_slice($matches, 1);  
  
 call_user_func_array(  
 [$controller, $methodName],  
 $params  
 );  
  
 return;  
 }  
 }  
  
 http_response_code(404);  
 echo "404 - Page Not Found";  
}  
}