<?php

$title = "Productos";

// Consulta para obtener los productos de la base de datos
$products = $db->query('SELECT * FROM products ORDER BY id DESC')->get();

// Carga la plantilla de la tabla de productos
require __DIR__ . '/../../resources/products.template.php';
