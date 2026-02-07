<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="mb-4">
    <a href="/products" class="text-gray-600 hover:text-gray-800">← Volver a productos</a>
</div>

<h1 class="text-3xl font-bold mb-6">Editar Producto</h1>

<div class="max-w-2xl bg-white shadow rounded p-6">
    <form method="POST" action="/products/update">
        <?= method_field('PUT') ?>
        <input type="hidden" name="id" value="<?= e($product['id']) ?>">

        <!-- Nombre -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">
                Nombre *
            </label>
            <input type="text" id="name" name="name" value="<?= e($product['name']) ?>"
                class="w-full px-3 py-2 border <?= hasErrors('name') ? 'border-red-500' : 'border-gray-300' ?> rounded focus:outline-none focus:ring-2 focus:ring-gray-500">
            <?php if (hasErrors('name')): ?>
                <?php foreach (errors('name') as $error): ?>
                    <p class="text-red-600 text-sm mt-1">
                        <?= e($error) ?>
                    </p>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Descripción -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">
                Descripción
            </label>
            <textarea id="description" name="description" rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-500"><?= e($product['description'] ?? '') ?></textarea>
        </div>

        <!-- Precio y SKU en fila -->
        <div class="grid grid-cols-2 gap-4 mb-4">

            <!-- Precio -->
            <div>
                <label for="price" class="block text-gray-700 font-medium mb-2">
                    Precio *
                </label>
                <input type="text" id="price" name="price" value="<?= e($product['price']) ?>"
                    class="w-full px-3 py-2 border <?= hasErrors('price') ? 'border-red-500' : 'border-gray-300' ?> rounded focus:outline-none focus:ring-2 focus:ring-gray-500">
                <?php if (hasErrors('price')): ?>
                    <?php foreach (errors('price') as $error): ?>
                        <p class="text-red-600 text-sm mt-1">
                            <?= e($error) ?>
                        </p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- SKU -->
            <div>
                <label for="sku" class="block text-gray-700 font-medium mb-2">
                    SKU *
                </label>
                <input type="text" id="sku" name="sku" value="<?= e($product['sku']) ?>"
                    class="w-full px-3 py-2 border <?= hasErrors('sku') ? 'border-red-500' : 'border-gray-300' ?> rounded focus:outline-none focus:ring-2 focus:ring-gray-500">
                <?php if (hasErrors('sku')): ?>
                    <?php foreach (errors('sku') as $error): ?>
                        <p class="text-red-600 text-sm mt-1">
                            <?= e($error) ?>
                        </p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <p class="text-sm text-gray-600 mb-6">* Campos obligatorios</p>

        <!-- Botones -->
        <div class="flex gap-2">
            <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded hover:bg-gray-700 transition">
                Actualizar
            </button>

            <a href="/products"
                class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400 transition inline-block">
                Cancelar
            </a>
        </div>
    </form>

    <!-- Eliminar -->
    <div class="mt-8 pt-6 border-t border-gray-300">
        <h3 class="text-lg font-semibold text-red-600 mb-2">Eliminar Producto</h3>
        <p class="text-gray-600 mb-4">Esta acción no se puede deshacer.</p>
        <form method="POST" action="/products/destroy"
            onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
            <?= method_field('DELETE') ?>
            <input type="hidden" name="id" value="<?= e($product['id']) ?>">
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition">
                Eliminar Producto
            </button>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>