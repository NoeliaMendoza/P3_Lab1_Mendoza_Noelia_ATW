<?php

// Solo permitir eliminacion si el metodo es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtener el id del producto a eliminar
    $id = $_POST['id'] ?? null;

    // Solo eliminar si el id existe
    if ($id !== null) {
        $db->query('DELETE FROM products WHERE id = :id', ['id' => $id]);
    }

    // Redirigir a la lista de productos
    header('Location: /products');
    exit;
}

// Si alguien intenta acceder por GET
header('Location: /products');
