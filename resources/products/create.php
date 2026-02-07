<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="mb-4">
    <a href="/products" class="text-gray-600 hover:text-gray-800">← Volver a productos</a>
</div>

<h1 class="text-3xl font-bold mb-6">Crear Nuevo Producto</h1>

<div class="max-w-2xl bg-white shadow rounded p-6">
    <form method="POST" action="/products">

        <!-- Nombre -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">
                Nombre *
            </label>
            <input type="text" id="name" name="name" value="<?= old('name') ?>"
                class="w-full px-3 py-2 border <?= hasErrors('name') ? 'border-red-500' : 'border-gray-300' ?> rounded focus:outline-none focus:ring-2 focus:ring-gray-500"
                placeholder="Ej: Laptop Dell">
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
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-500"
                placeholder="Descripción del producto..."><?= old('description') ?></textarea>
        </div>

        <!-- Precio y SKU en fila -->
        <div class="grid grid-cols-2 gap-4 mb-4">

            <!-- Precio -->
            <div>
                <label for="price" class="block text-gray-700 font-medium mb-2">
                    Precio *
                </label>
                <input type="text" id="price" name="price" value="<?= old('price') ?>"
                    class="w-full px-3 py-2 border <?= hasErrors('price') ? 'border-red-500' : 'border-gray-300' ?> rounded focus:outline-none focus:ring-2 focus:ring-gray-500"
                    placeholder="0.00">
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
                <input type="text" id="sku" name="sku" value="<?= old('sku') ?>"
                    class="w-full px-3 py-2 border <?= hasErrors('sku') ? 'border-red-500' : 'border-gray-300' ?> rounded focus:outline-none focus:ring-2 focus:ring-gray-500"
                    placeholder="PROD-001">
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
                Guardar
            </button>

            <a href="/products"
                class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400 transition inline-block">
                Cancelar
            </a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>