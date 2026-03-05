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
<div class="drawer lg:drawer-open">
    <input id="admin-drawer" type="checkbox" class="drawer-toggle" />

    <div class="drawer-content flex min-h-screen flex-col">
        <x-admin.topbar :title="$title" :breadcrumb="$breadcrumb" />

        <main class="flex-1 px-4 py-6 lg:px-6 lg:py-8">
            <div class="mx-auto w-full max-w-6xl space-y-6">
                {{ $slot }}
            </div>
        </main>
    </div>

    <div class="drawer-side z-30">
        <label for="admin-drawer" aria-label="Cerrar menú" class="drawer-overlay"></label>
        <x-admin.sidebar />
    </div>
</div>
</body>
</html>
