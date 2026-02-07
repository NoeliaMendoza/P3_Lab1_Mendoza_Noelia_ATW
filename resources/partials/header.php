<!DOCTYPE html>
<html lang="es" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Mi Aplicación') ?></title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="h-full flex flex-col">

    <?php require __DIR__ . '/navbar.php'; ?>

    <div class="container mx-auto p-4 flex-grow">

        <?php
        // Mostrar mensajes flash
        $alert = flash('alert');
        $error = flash('error');
        ?>
        <?php if ($alert): ?>
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline"><?= e($alert) ?></span>
            </div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline"><?= e($error) ?></span>
            </div>
        <?php endif; ?>