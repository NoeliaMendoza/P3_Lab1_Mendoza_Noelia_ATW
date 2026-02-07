<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4">
        <div class="flex h-16 items-center justify-between">
            <!-- Enlaces de navegación -->
            <div class="flex gap-4">
                <a href="/"
                    class="<?= is_route('/') && $_SERVER['REQUEST_URI'] === '/' ? 'bg-gray-900' : '' ?> text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                    Inicio
                </a>
                <a href="/about"
                    class="<?= is_route('/about') ? 'bg-gray-900' : '' ?> text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                    Acerca de
                </a>
                <a href="/links"
                    class="<?= is_route('/links') ? 'bg-gray-900' : '' ?> text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                    Proyectos
                </a>
                <a href="/products"
                    class="<?= is_route('/products') ? 'bg-gray-900' : '' ?> text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                    Productos
                </a>
            </div>

            <!-- Usuario autenticado -->
            <div class="flex items-center gap-4">
                <?php if (auth()): ?>
                    <span class="text-gray-300 text-sm">
                        Hola, <?= e(user()['username']) ?>
                    </span>
                    <form method="POST" action="/logout" class="inline">
                        <?= method_field('POST') ?>
                        <button type="submit"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                            Cerrar Sesión
                        </button>
                    </form>
                <?php else: ?>
                    <a href="/login"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                        Iniciar Sesión
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>