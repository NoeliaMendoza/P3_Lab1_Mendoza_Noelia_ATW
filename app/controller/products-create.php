<?php

$title = "Crear Producto";

// Procesar si el método es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtener los datos enviados por el formulario
    $name        = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price       = $_POST['price'] ?? '';
    $sku         = $_POST['sku'] ?? '';

    $errors = [];

    //Validaciones
    // Validar nombre
    if (empty($name)) {
        $errors['name'][] = "El nombre es obligatorio.";
    } elseif (strlen($name) < 3) {
        $errors['name'][] = "El nombre debe tener al menos 3 caracteres.";
    } elseif (strlen($name) > 255) {
        $errors['name'][] = "El nombre no puede tener más de 255 caracteres.";
    }

    // Validar precio
    if (empty($price)) {
        $errors['price'][] = "El precio es obligatorio.";
    } elseif (!is_numeric($price)) {
        $errors['price'][] = "El precio debe ser un número válido.";
    } elseif ($price < 0) {
        $errors['price'][] = "El precio no puede ser negativo.";
    }

    // Validar SKU
    if (empty($sku)) {
        $errors['sku'][] = "El SKU es obligatorio.";
    } elseif (strlen($sku) < 3) {
        $errors['sku'][] = "El SKU debe tener al menos 3 caracteres.";
    } elseif (strlen($sku) > 100) {
        $errors['sku'][] = "El SKU no puede tener más de 100 caracteres.";
    }

    // Inserta si no hay errores
    if (empty($errors)) {
        // Insertar el producto en la base de datos
        $db->query(
            'INSERT INTO products(name, description, price, sku) VALUES(:name, :description, :price, :sku)',
            [
                'name' => $name,
                'description' => ($description !== '') ? $description : null,
                'price' => $price,
                'sku' => $sku,
            ]
        );

        // Guardar mensaje de éxito en sesión
        session_start();
        $_SESSION['flash']['alert'] = 'Producto creado correctamente.';

        // Redirigir a la lista de productos
        header('Location: /products');
        exit;
    } else {
        // Guardar errores en sesión para mostrarlos
        session_start();
        $_SESSION['errors'] = $errors;
        $_SESSION['old']    = $_POST;
    }
}

// Cargar la plantilla del formulario
require __DIR__ . '/../../resources/products-create.template.php';
