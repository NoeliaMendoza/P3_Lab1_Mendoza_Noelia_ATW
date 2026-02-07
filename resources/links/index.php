<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="border-b border-gray-200 pb-8 mb-8">
    <h2 class="text-4xl font-semibold text-gray-900 sm:text-5xl">Mis proyectos recientes</h2>

    <p class="mt-4 text-lg text-gray-600 w-full max-w-4xl">
        Aquí encontrarás enlaces a proyectos interesantes y recursos útiles para el desarrollo web.
    </p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-x-8 gap-y-16">
    <?php foreach ($links as $link): ?>
        <article class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <h3 class="text-lg font-semibold text-gray-900 hover:text-gray-600 mb-3">
                <a href="<?= e($link['url']) ?>" target="_blank" rel="noopener noreferrer">
                    <?= e($link['title']) ?>
                </a>
            </h3>

            <p class="mt-2 text-sm text-gray-600"><?= e($link['description']) ?></p>

            <div class="mt-4">
                <a href="<?= e($link['url']) ?>" target="_blank" rel="noopener noreferrer"
                    class="text-gray-800 hover:text-gray-600 text-sm font-medium">
                    Visitar enlace →
                </a>
            </div>
        </article>
    <?php endforeach; ?>
</div>

<?php if (auth()): ?>
    <div class="mt-12 text-center">
        <a href="/links/create" class="bg-gray-800 text-white px-6 py-3 rounded hover:bg-gray-700 inline-block">
            + Registrar nuevo proyecto
        </a>
    </div>
<?php endif; ?>

<?php require __DIR__ . '/../partials/footer.php'; ?>