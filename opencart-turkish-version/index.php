<?php
// Entry point for the Turkish OpenCart version
// Basic router to handle requests

// Autoload classes
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/system/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Load config
require_once __DIR__ . '/config.php';

// Simple routing based on query parameter 'route'
$route = $_GET['route'] ?? 'common/home';

$parts = explode('/', $route);
$controllerName = ucfirst($parts[0]) . 'Controller';
$action = $parts[1] ?? 'index';

$controllerFile = __DIR__ . '/controller/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName();
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Action not found.";
    }
} else {
    echo "Controller not found.";
}
?>
