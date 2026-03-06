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
    <div class="fixed inset-0 z-40 hidden bg-base-content/40 backdrop-blur-sm lg:hidden" data-sidebar-overlay></div>

    <aside
        class="fixed inset-y-0 left-0 z-50 w-80 -translate-x-full transform border-r border-base-300/90 bg-base-100 transition-transform duration-300 ease-out lg:translate-x-0"
        data-admin-sidebar
        aria-label="Navegación de administración"
    >
        <x-admin.sidebar />
    </aside>

    <div class="relative flex min-h-screen flex-col">
        <x-admin.topbar :title="$title" :breadcrumb="$breadcrumb" />

        <main class="flex-1 px-4 py-5 lg:px-8 lg:py-7">
            <div class="mx-auto w-full max-w-7xl space-y-5 lg:space-y-6">
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
    const dropdowns = shell.querySelectorAll('details.dropdown');

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

    const closeDropdowns = () => {
        dropdowns.forEach((dropdown) => {
            dropdown.removeAttribute('open');
        });
    };

    closeDropdowns();

    openButton?.addEventListener('click', openSidebar);
    overlay?.addEventListener('click', () => {
        closeSidebar();
        closeDropdowns();
    });
    closeButtons.forEach((button) => button.addEventListener('click', () => {
        closeSidebar();
        closeDropdowns();
    }));

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            overlay?.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            sidebar?.classList.remove('-translate-x-full');
            closeDropdowns();
            return;
        }

        sidebar?.classList.add('-translate-x-full');
    });
})();
</script>
</body>
</html>
