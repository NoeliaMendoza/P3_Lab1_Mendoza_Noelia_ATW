<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="max-w-2xl mx-auto">
    <div class="mb-4">
        <a href="/links" class="text-gray-600 hover:text-gray-800">← Volver a proyectos</a>
    </div>

    <div class="border-b border-gray-200 pb-8 mb-8">
        <h2 class="text-3xl font-semibold text-gray-900 text-center">Crea un enlace o proyecto</h2>
    </div>

    <div class="bg-white shadow rounded p-6">
        <form method="POST" action="/links">

            <div class="mb-4">
                <label for="title" class="block text-sm font-semibold text-gray-900 mb-2">Título *</label>
                <input type="text" id="title" name="title"
                    class="w-full outline outline-1 outline-gray-300 rounded-md px-3 py-2 text-gray-900 focus:outline-2 focus:outline-gray-500"
                    value="<?= old('title') ?>">
                <?php if (hasErrors('title')): ?>
                    <?php foreach (errors('title') as $error): ?>
                        <p class="text-red-600 text-sm mt-1">
                            <?= e($error) ?>
                        </p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="url" class="block text-sm font-semibold text-gray-900 mb-2">URL *</label>
                <input type="text" id="url" name="url"
                    class="w-full outline outline-1 outline-gray-300 rounded-md px-3 py-2 text-gray-900 focus:outline-2 focus:outline-gray-500"
                    value="<?= old('url') ?>" placeholder="https://ejemplo.com">
                <?php if (hasErrors('url')): ?>
                    <?php foreach (errors('url') as $error): ?>
                        <p class="text-red-600 text-sm mt-1">
                            <?= e($error) ?>
                        </p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-semibold text-gray-900 mb-2">Descripción *</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full outline outline-1 outline-gray-300 rounded-md px-4 py-2 text-gray-900 focus:outline-2 focus:outline-gray-500"><?= old('description') ?></textarea>
                <?php if (hasErrors('description')): ?>
                    <?php foreach (errors('description') as $error): ?>
                        <p class="text-red-600 text-sm mt-1">
                            <?= e($error) ?>
                        </p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <p class="text-sm text-gray-600 mb-6">* Campos obligatorios</p>

            <div class="flex gap-2">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-2 rounded text-sm font-semibold transition">
                    Crear Proyecto
                </button>

                <a href="/links"
                    class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400 transition inline-block">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>