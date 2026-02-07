<?php

/**
 * Punto de entrada de la aplicación
 */

// Cargar autoloader de clases
spl_autoload_register(function ($class) {

    $base_dir = __DIR__ . '/../';

    // Mapear namespaces a carpetas reales
    $prefixes = [
        'Framework\\' => 'framework/',
        'App\\'       => 'app/',
    ];

    foreach ($prefixes as $prefix => $dir) {
        if (strpos($class, $prefix) === 0) {
            $relative = str_replace($prefix, $dir, $class);
            $file = $base_dir . str_replace('\\', '/', $relative) . '.php';

            if (file_exists($file)) {
                require $file;
                return;
            }
        }
    }
});


// Cargar funciones helper
require __DIR__ . '/../framework/helpers.php';

// Iniciar sesión
use Framework\SessionManager;
SessionManager::start();

// Limpiar datos antiguos de sesión después de renderizar
cleanOldSessionData();

// Crear instancia de base de datos
use Framework\Database;
$db = new Database();

// Crear router y cargar rutas
use Framework\Router;
$router = new Router();

require __DIR__ . '/../routes/web.php';

// Despachar la ruta
$router->dispatch();