<?php require __DIR__ . '/../partials/header.php'; ?>

<!-- Header -->
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold">Productos</h1>
    <?php if (auth()): ?>
        <a href="/products/create" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
            + Nuevo Producto
        </a>
    <?php endif; ?>
</div>

<!-- Tabla de productos -->
<?php if (empty($products)): ?>
    <div class="text-center py-12 bg-gray-50 rounded">
        <p class="text-gray-600 mb-4">No hay productos registrados</p>
        <?php if (auth()): ?>
            <a href="/products/create" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                Crear primer producto
            </a>
        <?php endif; ?>
    </div>
<?php else: ?>
    <div class="bg-white shadow rounded overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">SKU</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Precio</th>
                    <?php if (auth()): ?>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">
                                <?= e($product['name']) ?>
                            </div>
                            <?php if ($product['description']): ?>
                                <div class="text-sm text-gray-500">
                                    <?= e($product['description']) ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <?= e($product['sku']) ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            $
                            <?= number_format($product['price'], 2) ?>
                        </td>
                        <?php if (auth()): ?>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex gap-2">
                                    <a href="/products/edit?id=<?= $product['id'] ?>" class="text-blue-600 hover:text-blue-800">
                                        Editar
                                    </a>
                                    <form method="POST" action="/products/destroy" class="inline"
                                        onsubmit="return confirm('¿Eliminar este producto?')">
                                        <?= method_field('DELETE') ?>
                                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <p class="mt-4 text-gray-600">Total:
        <?= count($products) ?> productos
    </p>
<?php endif; ?>

<?php require __DIR__ . '/../partials/footer.php'; ?>