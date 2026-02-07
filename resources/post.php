<?php require __DIR__ . '/partials/header.php'; ?>

<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="/" class="text-gray-600 hover:text-gray-800">← Volver a inicio</a>
    </div>

    <article class="bg-white shadow rounded-lg p-8">
        <div class="border-b border-gray-200 pb-6 mb-6">
            <h1 class="text-4xl font-semibold text-gray-900 mb-4">
                <?= e($post['title']) ?>
            </h1>

            <p class="text-xl text-gray-600">
                <?= e($post['excerpt']) ?>
            </p>
        </div>

        <div class="prose max-w-none">
            <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">
                <?= e($post['content']) ?>
            </p>
        </div>
    </article>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>