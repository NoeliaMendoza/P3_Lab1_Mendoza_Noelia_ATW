<?php

namespace App\Controllers;

use Framework\Validator;
use Framework\SessionManager;

class AuthController
{
    /**
     * Muestra el formulario de login
     */
    public function loginForm()
    {
        echo view('auth.login', [
            'title' => 'Iniciar Sesión'
        ]);
    }

    /**
     * Procesa el login
     */
    public function login()
    {
        $validator = Validator::make($_POST, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $validator->validate();

        // Buscar usuario
        $user = db()->query(
            'SELECT * FROM users WHERE username = :username',
            ['username' => $_POST['username']]
        )->first();

        // Verificar credenciales
        if ($user && password_verify($_POST['password'], $user['password'])) {
            SessionManager::login($user);
            SessionManager::flash('alert', '¡Bienvenido de nuevo!');
            return redirect('/');
        }

        SessionManager::flash('error', 'Credenciales incorrectas.');
        return redirect('/login');
    }

    /**
     * Cierra sesión
     */
    public function logout()
    {
        SessionManager::logout();
        SessionManager::flash('alert', 'Sesión cerrada correctamente.');
        return redirect('/');
    }
}