<?php

use Framework\Database;
use Framework\SessionManager;

/**
 * Funciones auxiliares para el framework
 */

/**
 * Obtiene la instancia de la base de datos
 */
function db()
{
    global $db;
    return $db;
}

/**
 * Renderiza una vista
 */
function view($template, $data = [])
{
    extract($data);

    $templatePath = __DIR__ . '/../resources/' . str_replace('.', '/', $template) . '.php';

    if (!file_exists($templatePath)) {
        throw new \Exception("Vista no encontrada: {$template}");
    }

    ob_start();
    require $templatePath;
    return ob_get_clean();
}

/**
 * Redirige a una URL
 */
function redirect($url)
{
    header("Location: $url");
    exit;
}

/**
 * Obtiene el valor anterior de un campo del formulario
 */
function old($key, $default = '')
{
    SessionManager::start();
    $value = $_SESSION['old'][$key] ?? $default;
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * Muestra los errores de validación
 */
function errors($key = null)
{
    SessionManager::start();

    if ($key === null) {
        return $_SESSION['errors'] ?? [];
    }

    return $_SESSION['errors'][$key] ?? [];
}

/**
 * Verifica si hay errores
 */
function hasErrors($key = null)
{
    SessionManager::start();

    if ($key === null) {
        return !empty($_SESSION['errors']);
    }

    return !empty($_SESSION['errors'][$key]);
}

/**
 * Limpia los datos de sesión antiguos
 */
function cleanOldSessionData()
{
    SessionManager::start();
    unset($_SESSION['errors']);
    unset($_SESSION['old']);
}

/**
 * Obtiene un mensaje flash y lo elimina
 */
function flash($key, $default = null)
{
    return SessionManager::get($key, $default);
}

/**
 * Verifica si el usuario está autenticado
 */
function auth()
{
    return SessionManager::isAuthenticated();
}

/**
 * Obtiene el usuario autenticado
 */
function user()
{
    return SessionManager::user();
}

/**
 * Escapa HTML
 */
function e($value)
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Genera una URL del asset
 */
function asset($path)
{
    return '/' . ltrim($path, '/');
}

/**
 * Genera un token CSRF
 */
function csrf_token()
{
    SessionManager::start();

    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

/**
 * Genera un campo oculto con el token CSRF
 */
function csrf_field()
{
    return '<input type="hidden" name="_token" value="' . csrf_token() . '">';
}

/**
 * Genera un campo oculto para method spoofing
 */
function method_field($method)
{
    return '<input type="hidden" name="_method" value="' . strtoupper($method) . '">';
}

/**
 * Verifica si la ruta actual es la indicada
 */
function is_route($route)
{
    return $_SERVER['REQUEST_URI'] === $route ||
        strpos($_SERVER['REQUEST_URI'], $route) === 0;
}