<?php

$title  = "Editar Producto";
$errors = [];

// Solo procesar si el método es POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtener los datos enviados por el formulario de edición
    $id          = $_POST['id'] ?? '';
    $name        = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price       = $_POST['price'] ?? '';
    $sku         = $_POST['sku'] ?? '';

    // ---- Validaciones (mismas que en crear) ----

    // Validar ID
    if (empty($id) || !is_numeric($id)) {
        $errors['id'][] = "El ID del producto no es válido.";
    }

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
        $errors['price'][] = "El precio debe ser un número válido (ej: 29.99).";
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

    // ---- UPDATE solo si no hay errores ----
    if (empty($errors)) {
        // Actualizar el producto en la base de datos
        // WHERE id = :id indica qué producto actualizar
        $db->query(
            'UPDATE products SET name = :name, description = :description, price = :price, sku = :sku WHERE id = :id',
            [
                'id' => $id,
                'name' => $name,
                'description' => ($description !== '') ? $description : null,
                'price' => $price,
                'sku' => $sku,
            ]
        );

        // Guardar mensaje de éxito en sesión
        session_start();
        $_SESSION['flash']['alert'] = 'Producto actualizado correctamente.';

        // Redirigir al mismo formulario de edición del producto actualizado
        header('Location: /products/edit?id=' . $id);
        exit;
    } else {
        // Guardar errores en sesión para mostrarlos
        session_start();
        $_SESSION['errors'] = $errors;
    }
}

// Si hay errores de validación, volver a cargar el producto
// para mostrar el formulario con los datos actuales
$product = $db->query(
    'SELECT * FROM products WHERE id = :id',
    ['id' => $_POST['id'] ?? $_GET['id'] ?? null]
)->firstOrFail();

// Carga la plantilla del formulario de edición (misma que products-edit)
require __DIR__ . '/../../resources/products-edit.template.php';
