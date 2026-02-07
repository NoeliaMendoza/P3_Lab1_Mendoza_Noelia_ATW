<?php require __DIR__ . '/partials/header.php'; ?>

<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Sobre Este Proyecto</h1>

    <div class="bg-white shadow rounded p-6 space-y-4">
        <p class="text-gray-700">
            Este es un proyecto de práctica de Laboratorio para la asignatura de <strong>Aplicación de Tecnologías
                Web</strong>.
        </p>

        <p class="text-gray-700">
            Implementa un sistema CRUD (Crear, Leer, Actualizar, Eliminar) completo para gestionar productos,
            utilizando PHP, PostgreSQL y Tailwind CSS.
        </p>

        <div class="border-t pt-4 mt-4">
            <h2 class="font-semibold text-lg mb-2">Tecnologías utilizadas:</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>PHP 8+ (Backend)</li>
                <li>PostgreSQL (Base de datos)</li>
                <li>Tailwind CSS (Estilos)</li>
                <li>Arquitectura MVC personalizada</li>
            </ul>
        </div>

        <div class="border-t pt-4 mt-4">
            <h2 class="font-semibold text-lg mb-2">Características implementadas:</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>CRUD completo de productos con validaciones</li>
                <li>Sistema de autenticación (login/logout)</li>
                <li>Middleware para proteger rutas</li>
                <li>Mensajes flash de éxito/error</li>
                <li>Validación de formularios con errores específicos</li>
                <li>Soporte para métodos HTTP (GET, POST, PUT, DELETE)</li>
                <li>Router personalizado con soporte para middleware</li>
            </ul>
        </div>
    </div>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>