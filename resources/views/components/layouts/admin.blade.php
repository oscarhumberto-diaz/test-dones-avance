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
<div class="relative min-h-screen" data-admin-shell>
    <div class="fixed inset-0 z-40 hidden bg-base-content/35 backdrop-blur-sm lg:hidden" data-sidebar-overlay></div>

    <aside
        class="fixed inset-y-0 left-0 z-50 w-72 -translate-x-full border-r border-base-300 bg-base-100 transition-transform duration-300 ease-out lg:translate-x-0"
        data-admin-sidebar
        aria-label="Navegación de administración"
    >
        <x-admin.sidebar />
    </aside>

    <div class="relative min-h-screen lg:ml-72">
        <x-admin.topbar :title="$title" :breadcrumb="$breadcrumb" />

        <main class="px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
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

    const closeDropdown = () => {
        if (!dropdown || !dropdownMenu || !dropdownButton) {
            return;
        }

        dropdownMenu.classList.add('hidden');
        dropdownButton.setAttribute('aria-expanded', 'false');
    };

    const openDropdown = () => {
        if (!dropdown || !dropdownMenu || !dropdownButton) {
            return;
        }

        dropdownMenu.classList.remove('hidden');
        dropdownButton.setAttribute('aria-expanded', 'true');
    };

    const toggleDropdown = () => {
        if (!dropdownMenu || dropdownMenu.classList.contains('hidden')) {
            openDropdown();
            return;
        }

        closeDropdown();
    };

    const openSidebar = () => {
        sidebar?.classList.remove('-translate-x-full');
        overlay?.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    };

    const closeSidebar = () => {
        if (window.innerWidth >= 1024) {
            return;
        }

        sidebar?.classList.add('-translate-x-full');
        overlay?.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    };

    const closeSidebarAndDropdown = () => {
        closeSidebar();
        closeDropdown();
    };

    closeDropdown();
    closeSidebar();

    openButton?.addEventListener('click', openSidebar);
    overlay?.addEventListener('click', closeSidebarAndDropdown);
    closeButtons.forEach((button) => button.addEventListener('click', closeSidebar));

    dropdownButton?.addEventListener('click', (event) => {
        event.preventDefault();
        toggleDropdown();
    });

    document.addEventListener('click', (event) => {
        const target = event.target;

        if (dropdown && target instanceof Node && !dropdown.contains(target)) {
            closeDropdown();
        }
    });

    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeSidebarAndDropdown();
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            sidebar?.classList.remove('-translate-x-full');
            overlay?.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            return;
        }

        sidebar?.classList.add('-translate-x-full');
    });
})();
</script>
</body>
</html>
