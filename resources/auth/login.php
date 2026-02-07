<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="max-w-md mx-auto mt-12">
    <div class="bg-white shadow rounded-lg p-8">
        <h2 class="text-2xl font-bold text-center mb-6">Iniciar Sesión</h2>

        <form method="POST" action="/login">

            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-medium mb-2">
                    Usuario
                </label>
                <input type="text" id="username" name="username" value="<?= old('username') ?>"
                    class="w-full px-3 py-2 border <?= hasErrors('username') ? 'border-red-500' : 'border-gray-300' ?> rounded focus:outline-none focus:ring-2 focus:ring-gray-500"
                    placeholder="Ingresa tu usuario">
                <?php if (hasErrors('username')): ?>
                    <?php foreach (errors('username') as $error): ?>
                        <p class="text-red-600 text-sm mt-1">
                            <?= e($error) ?>
                        </p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-medium mb-2">
                    Contraseña
                </label>
                <input type="password" id="password" name="password"
                    class="w-full px-3 py-2 border <?= hasErrors('password') ? 'border-red-500' : 'border-gray-300' ?> rounded focus:outline-none focus:ring-2 focus:ring-gray-500"
                    placeholder="Ingresa tu contraseña">
                <?php if (hasErrors('password')): ?>
                    <?php foreach (errors('password') as $error): ?>
                        <p class="text-red-600 text-sm mt-1">
                            <?= e($error) ?>
                        </p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <button type="submit"
                class="w-full bg-gray-800 text-white py-2 rounded hover:bg-gray-700 transition font-medium">
                Ingresar
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                ¿No tienes cuenta? Contacta al administrador
            </p>
        </div>

        <div class="mt-6 p-4 bg-blue-50 rounded">
            <p class="text-sm text-gray-700 font-semibold mb-2">Credenciales de prueba:</p>
            <p class="text-sm text-gray-600">Usuario: <code class="bg-gray-200 px-1 rounded">admin</code></p>
            <p class="text-sm text-gray-600">Contraseña: <code class="bg-gray-200 px-1 rounded">admin123</code></p>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>