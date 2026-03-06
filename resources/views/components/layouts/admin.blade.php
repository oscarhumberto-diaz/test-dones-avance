@props([
    'title' => 'Panel de administración',
    'breadcrumb' => [],
])

<!doctype html>
<html lang="es" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-base-200 text-base-content antialiased">
<div class="relative min-h-screen lg:pl-80" data-admin-shell>
    <div class="fixed inset-0 z-40 hidden bg-base-content/45 backdrop-blur-[1px] lg:hidden" data-sidebar-overlay></div>

    <aside
        class="fixed inset-y-0 left-0 z-50 w-80 -translate-x-full transform border-r border-base-300 bg-base-100 transition-transform duration-300 ease-out lg:translate-x-0"
        data-admin-sidebar
        aria-label="Navegación de administración"
    >
        <x-admin.sidebar />
    </aside>

    <div class="relative flex min-h-screen flex-col">
        <x-admin.topbar :title="$title" :breadcrumb="$breadcrumb" />

        <main class="flex-1 px-4 py-6 lg:px-8 lg:py-8">
            <div class="mx-auto w-full max-w-7xl space-y-6">
                {{ $slot }}
            </div>
        </main>
    </div>
</div>

<script>
(() => {
    const shell = document.querySelector('[data-admin-shell]');

    if (!shell) {
        return;
    }

    const sidebar = shell.querySelector('[data-admin-sidebar]');
    const overlay = shell.querySelector('[data-sidebar-overlay]');
    const openButton = shell.querySelector('[data-open-sidebar]');
    const closeButtons = shell.querySelectorAll('[data-close-sidebar]');

    const openSidebar = () => {
        sidebar?.classList.remove('-translate-x-full');
        overlay?.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    };

    const closeSidebar = () => {
        sidebar?.classList.add('-translate-x-full');
        overlay?.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    };

    openButton?.addEventListener('click', openSidebar);
    overlay?.addEventListener('click', closeSidebar);
    closeButtons.forEach((button) => button.addEventListener('click', closeSidebar));

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            overlay?.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            sidebar?.classList.remove('-translate-x-full');
            return;
        }

        sidebar?.classList.add('-translate-x-full');
    });
})();
</script>
</body>
</html>
