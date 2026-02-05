<?php

namespace Framework;

class SessionManager
{
    /**
     * Inicia la sesión si no está iniciada
     */
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Guarda un mensaje flash en la sesión
     */
    public static function flash($key, $message)
    {
        self::start();
        $_SESSION['flash'][$key] = $message;
    }

    /**
     * Obtiene y elimina un mensaje flash
     */
    public static function get($key, $default = null)
    {
        self::start();

        if (isset($_SESSION['flash'][$key])) {
            $value = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $value;
        }

        return $default;
    }

    /**
     * Verifica si existe un mensaje flash
     */
    public static function has($key)
    {
        self::start();
        return isset($_SESSION['flash'][$key]);
    }

    /**
     * Guarda datos antiguos del formulario
     */
    public static function flashOld($data)
    {
        self::start();
        $_SESSION['old'] = $data;
    }

    /**
     * Guarda errores de validación
     */
    public static function flashErrors($errors)
    {
        self::start();
        $_SESSION['errors'] = $errors;
    }

    /**
     * Destruye la sesión
     */
    public static function destroy()
    {
        self::start();
        session_destroy();
    }

    /**
     * Establece un valor en la sesión
     */
    public static function set($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    /**
     * Obtiene un valor de la sesión sin eliminarlo
     */
    public static function getSession($key, $default = null)
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }
}
