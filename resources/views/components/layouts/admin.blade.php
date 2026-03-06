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
<body class="bg-base-200 text-base-content antialiased">
<div class="min-h-screen" data-admin-shell>
    <div class="fixed inset-0 z-40 hidden bg-base-content/30 lg:hidden" data-sidebar-overlay></div>

    <aside
        class="fixed inset-y-0 left-0 z-50 w-72 -translate-x-full border-r border-base-300 bg-base-100 transition-transform duration-300 lg:translate-x-0"
        data-admin-sidebar
        aria-label="Navegación del panel"
    >
        <x-admin.sidebar />
    </aside>

    <div class="lg:pl-72">
        <x-admin.topbar :title="$title" :breadcrumb="$breadcrumb" />

        <main class="p-4 sm:p-6 lg:p-8">
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
    const dropdown = shell.querySelector('[data-user-dropdown]');
    const dropdownButton = shell.querySelector('[data-user-dropdown-button]');
    const dropdownMenu = shell.querySelector('[data-user-dropdown-menu]');

    const setSidebarOpen = (open) => {
        if (!sidebar || !overlay) {
            return;
        }

        if (window.innerWidth >= 1024) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            return;
        }

        sidebar.classList.toggle('-translate-x-full', !open);
        overlay.classList.toggle('hidden', !open);
        document.body.classList.toggle('overflow-hidden', open);
    };

    const closeDropdown = () => {
        if (!dropdownButton || !dropdownMenu) {
            return;
        }

        dropdownButton.setAttribute('aria-expanded', 'false');
        dropdownMenu.classList.add('hidden');
    };

    const toggleDropdown = () => {
        if (!dropdownButton || !dropdownMenu) {
            return;
        }

        const isOpen = dropdownButton.getAttribute('aria-expanded') === 'true';
        dropdownButton.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
        dropdownMenu.classList.toggle('hidden', isOpen);
    };

    openButton?.addEventListener('click', () => setSidebarOpen(true));
    overlay?.addEventListener('click', () => setSidebarOpen(false));
    closeButtons.forEach((button) => button.addEventListener('click', () => setSidebarOpen(false)));

    dropdownButton?.addEventListener('click', (event) => {
        event.preventDefault();
        toggleDropdown();
    });

    document.addEventListener('click', (event) => {
        if (dropdown && event.target instanceof Node && !dropdown.contains(event.target)) {
            closeDropdown();
        }
    });

    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            setSidebarOpen(false);
            closeDropdown();
        }
    });

    window.addEventListener('resize', () => setSidebarOpen(false));

    setSidebarOpen(false);
    closeDropdown();
})();
</script>
</body>
</html>
