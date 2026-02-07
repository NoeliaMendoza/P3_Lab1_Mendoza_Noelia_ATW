<?php

namespace App\Controllers;

use Framework\Validator;
use Framework\SessionManager;

class ProductController
{
    /**
     * Muestra la lista de todos los productos.
     */
    public function index()
    {
        $products = db()->query('SELECT * FROM products ORDER BY id DESC')->get();

        echo view('products.index', [
            'products' => $products,
            'title' => 'Productos'
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     */
    public function create()
    {
        echo view('products.create', [
            'title' => 'Crear Producto'
        ]);
    }

    /**
     * Guarda un nuevo producto en la base de datos.
     */
    public function store()
    {
        // Validar los datos
        $validator = Validator::make($_POST, [
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric',
            'sku' => 'required|min:3|max:100',
        ]);

        // La validación se encarga de redirigir si falla
        $validator->validate();

        // Insertar el producto
        db()->query(
            'INSERT INTO products(name, description, price, sku) VALUES(:name, :description, :price, :sku)',
            [
                'name' => $_POST['name'],
                'description' => $_POST['description'] ?? null,
                'price' => $_POST['price'],
                'sku' => $_POST['sku'],
            ]
        );

        SessionManager::flash('alert', 'Producto creado correctamente.');

        return redirect('/products');
    }

    /**
     * Muestra el formulario para editar un producto existente.
     */
    public function edit()
    {
        $product = db()->query(
            'SELECT * FROM products WHERE id = :id',
            ['id' => $_GET['id'] ?? null]
        )->firstOrFail();

        echo view('products.edit', [
            'product' => $product,
            'title' => 'Editar Producto'
        ]);
    }

    /**
     * Actualiza un producto en la base de datos.
     */
    public function update()
    {
        // Validar los datos
        $validator = Validator::make($_POST, [
            'id' => 'required|numeric',
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric',
            'sku' => 'required|min:3|max:100',
        ]);

        $validator->validate();

        // Actualizar el producto
        db()->query(
            'UPDATE products SET name = :name, description = :description, price = :price, sku = :sku WHERE id = :id',
            [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'description' => $_POST['description'] ?? null,
                'price' => $_POST['price'],
                'sku' => $_POST['sku'],
            ]
        );

        SessionManager::flash('alert', 'Producto actualizado correctamente.');

        return redirect('/products/edit?id=' . $_POST['id']);
    }

    /**
     * Elimina un producto de la base de datos.
     */
    public function destroy()
    {
        // Validar que tenemos un ID
        $validator = Validator::make($_POST, [
            'id' => 'required|numeric'
        ]);

        $validator->validate();

        // Eliminar el producto
        db()->query('DELETE FROM products WHERE id = :id', [
            'id' => $_POST['id']
        ]);

        SessionManager::flash('alert', 'Producto eliminado correctamente.');

        return redirect('/products');
    }
}