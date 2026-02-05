<?php
$title = "Editar Producto";
$erros = [];

// Obtener el producto por su id que viene en la URL
// Ejemplo: /products/edit?id=3
// $_GET['id'] obtiene el valor "3" de la URL
// firstOrFail() retorna el producto o muestra 404 si no existe
$product = $db->query(
    'SELECT * FROM products WHERE id = :id',
    ['id' => $_GET['id'] ?? null]
)->firstOrFail();

// Carga la plantilla del formulario de ediciÃ³n
// $product contiene los datos del producto para pre-llenar los campos
require __DIR__ . '/../../resources/products-edit.template.php';
