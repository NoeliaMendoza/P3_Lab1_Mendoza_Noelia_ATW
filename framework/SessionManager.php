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

    /**
     * Elimina un valor de la sesión
     */
    public static function forget($key)
    {
        self::start();
        unset($_SESSION[$key]);
    }

    /**
     * Verifica si el usuario está autenticado
     */
    public static function isAuthenticated()
    {
        self::start();
        return isset($_SESSION['user_id']);
    }

    /**
     * Obtiene el ID del usuario autenticado
     */
    public static function userId()
    {
        self::start();
        return $_SESSION['user_id'] ?? null;
    }

    /**
     * Obtiene el usuario autenticado
     */
    public static function user()
    {
        self::start();
        return $_SESSION['user'] ?? null;
    }

    /**
     * Inicia sesión de usuario
     */
    public static function login($user)
    {
        self::start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user'] = $user;
    }

    /**
     * Cierra sesión de usuario
     */
    public static function logout()
    {
        self::start();
        unset($_SESSION['user_id']);
        unset($_SESSION['user']);
    }
}