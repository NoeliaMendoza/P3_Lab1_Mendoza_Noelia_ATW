<?php require __DIR__ . '/partials/header.php'; ?>

<div class="border-b border-gray-200 pb-8 mb-8">
    <h2 class="text-4xl font-semibold text-gray-900 sm:text-5xl">Publicaciones recientes</h2>

    <p class="mt-4 text-lg text-gray-600 w-full max-w-4xl">
        Bienvenido a nuestro sitio web. Aquí encontrarás las publicaciones más recientes sobre tecnología y desarrollo
        web.
    </p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-x-8 gap-y-16">
    <?php foreach ($posts as $post): ?>
        <article class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <h3 class="text-lg font-semibold text-gray-900 hover:text-gray-600 mb-3">
                <a href="/post?id=<?= $post['id'] ?>">
                    <?= e($post['title']) ?>
                </a>
            </h3>

            <p class="mt-2 text-sm text-gray-600">
                <?= e($post['excerpt']) ?>
            </p>

            <div class="mt-4">
                <a href="/post?id=<?= $post['id'] ?>" class="text-gray-800 hover:text-gray-600 text-sm font-medium">
                    Leer más →
                </a>
            </div>
        </article>
    <?php endforeach; ?>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>