<?php
//Funciones auxiliares para el framework

function db()
{
    global $db;
    return $db;
}

//Renderiza una vista
function view($template, $data = [])
{
    extract($data);
    require __DIR__ . '/../resources/' . str_replace('.', '/', $template) . '.php';
}

//Redirige a una URL
function redirect($url)
{
    header("Location: $url");
    exit;
}

//Obtiene el valor anterior de un campo del formulario
function old($key, $default = '')
{
    return $_SESSION['old'][$key] ?? $default;
}

//Muestra los errores de validación
function errors($key = null)
{
    if ($key === null) {
        return $_SESSION['errors'] ?? [];
    }
    return $_SESSION['errors'][$key] ?? [];
}

//Verifica si hay errores
function hasErrors($key = null)
{
    if ($key === null) {
        return !empty($_SESSION['errors']);
    }
    return !empty($_SESSION['errors'][$key]);
}

//Limpia los datos de sesión antiguos

function cleanOldSessionData()
{
    unset($_SESSION['errors']);
    unset($_SESSION['old']);
}
