<?php
session_start();
require __DIR__ . '/partials/header.php';

// Obtener mensaje flash si existe
$alert = $_SESSION['flash']['alert'] ?? null;
unset($_SESSION['flash']['alert']);
?>

<!-- Mensaje de éxito -->
<?php if ($alert): ?>
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
        <?= htmlspecialchars($alert) ?>
    </div>
<?php endif; ?>

<!-- Header -->
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold">Productos</h1>
    <a href="/products/create" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
        + Nuevo Producto
    </a>
</div>

<!-- Tabla de productos -->
<?php if (empty($products)): ?>
    <div class="text-center py-12 bg-gray-50 rounded">
        <p class="text-gray-600 mb-4">No hay productos registrados</p>
        <a href="/products/create" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
            Crear primer producto
        </a>
    </div>
<?php else: ?>
    <div class="bg-white shadow rounded overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">SKU</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Precio</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900"><?= htmlspecialchars($product['name']) ?></div>
                            <?php if ($product['description']): ?>
                                <div class="text-sm text-gray-500"><?= htmlspecialchars($product['description']) ?></div>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <?= $product['sku'] ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            $<?= number_format($product['price'], 2) ?>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex gap-2">
                                <a href="/products/edit?id=<?= $product['id'] ?>" class="text-blue-600 hover:text-blue-800">
                                    Editar
                                </a>
                                <form method="POST" action="/products/delete" class="inline" onsubmit="return confirm('¿Eliminar este producto?')">
                                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <p class="mt-4 text-gray-600">Total: <?= count($products) ?> productos</p>
<?php endif; ?>

<?php require __DIR__ . '/partials/footer.php'; ?>