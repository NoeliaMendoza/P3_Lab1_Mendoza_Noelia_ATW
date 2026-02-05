<?php
session_start();
require __DIR__ . '/partials/header.php';

// Obtener errores y datos antiguos de la sesión
$errors = $_SESSION['errors'] ?? [];
$old    = $_SESSION['old'] ?? [];

// Limpiar datos de sesión
unset($_SESSION['errors']);
unset($_SESSION['old']);
?>

<div class="mb-4">
    <a href="/products" class="text-gray-600 hover:text-gray-800">← Volver a productos</a>
</div>

<h1 class="text-3xl font-bold mb-6">Crear Nuevo Producto</h1>

<div class="max-w-2xl bg-white shadow rounded p-6">
    <form method="POST" action="/products/create">

        <!-- Nombre -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">
                Nombre *
            </label>
            <input
                type="text"
                id="name"
                name="name"
                value="<?= htmlspecialchars($old['name'] ?? '') ?>"
                class="w-full px-3 py-2 border <?= isset($errors['name']) ? 'border-red-500' : 'border-gray-300' ?> rounded"
                placeholder="Ej: Laptop Dell"
            >
            <?php if (isset($errors['name'])): ?>
                <?php foreach ($errors['name'] as $error): ?>
                    <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Descripción -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">
                Descripción
            </label>
            <textarea
                id="description"
                name="description"
                rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded"
                placeholder="Descripción del producto..."
            ><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
        </div>

        <!-- Precio y SKU en fila -->
        <div class="grid grid-cols-2 gap-4 mb-4">

            <!-- Precio -->
            <div>
                <label for="price" class="block text-gray-700 font-medium mb-2">
                    Precio *
                </label>
                <input
                    type="text"
                    id="price"
                    name="price"
                    value="<?= htmlspecialchars($old['price'] ?? '') ?>"
                    class="w-full px-3 py-2 border <?= isset($errors['price']) ? 'border-red-500' : 'border-gray-300' ?> rounded"
                    placeholder="0.00"
                >
                <?php if (isset($errors['price'])): ?>
                    <?php foreach ($errors['price'] as $error): ?>
                        <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- SKU -->
            <div>
                <label for="sku" class="block text-gray-700 font-medium mb-2">
                    SKU *
                </label>
                <input
                    type="text"
                    id="sku"
                    name="sku"
                    value="<?= htmlspecialchars($old['sku'] ?? '') ?>"
                    class="w-full px-3 py-2 border <?= isset($errors['sku']) ? 'border-red-500' : 'border-gray-300' ?> rounded"
                    placeholder="PROD-001"
                >
                <?php if (isset($errors['sku'])): ?>
                    <?php foreach ($errors['sku'] as $error): ?>
                        <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <p class="text-sm text-gray-600 mb-6">* Campos obligatorios</p>

        <!-- Botones -->
        <div class="flex gap-2">
            <button
                type="submit"
                class="bg-gray-800 text-white px-6 py-2 rounded hover:bg-gray-700"
            >
                Guardar
            </button>

            <a
                href="/products"
                class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400"
            >
                Cancelar
            </a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>