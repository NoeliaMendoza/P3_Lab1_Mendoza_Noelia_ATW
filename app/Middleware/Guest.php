<?php

namespace App\Middleware;

use Framework\SessionManager;

class Guest
{
    /**
     * Maneja la solicitud
     */
    public function handle()
    {
        // Si el usuario ya está autenticado, redirigir al home
        if (SessionManager::isAuthenticated()) {
            redirect('/');
        }
    }
}