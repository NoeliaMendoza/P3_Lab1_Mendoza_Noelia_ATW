<?php

namespace App\Middleware;

use Framework\SessionManager;

class Authenticated
{
    /**
     * Maneja la solicitud
     */
    public function handle()
    {
        // Verificar si el usuario está autenticado
        if (!SessionManager::isAuthenticated()) {
            SessionManager::flash('error', 'Debes iniciar sesión para acceder a esta página.');
            redirect('/login');
        }
    }
}