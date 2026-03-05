<!doctype html>
<html lang="es" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Panel de administración' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-200 min-h-screen">
<div class="drawer lg:drawer-open">
    <input id="admin-drawer" type="checkbox" class="drawer-toggle" />

    <div class="drawer-content flex flex-col min-h-screen">
        <header class="navbar bg-base-100 border-b border-base-300 px-4 lg:px-6">
            <div class="flex-none lg:hidden">
                <label for="admin-drawer" class="btn btn-square btn-ghost" aria-label="Abrir menú">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-5 w-5 stroke-current" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </label>
            </div>
            <div class="flex-1">
                <h1 class="text-lg font-semibold">{{ $title ?? 'Panel de administración' }}</h1>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm opacity-70">{{ auth()->user()->username }}</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-outline">Cerrar sesión</button>
                </form>
            </div>
        </header>

        <main class="p-4 lg:p-6 flex-1">
            {{ $slot }}
        </main>
    </div>

    <div class="drawer-side z-30">
        <label for="admin-drawer" aria-label="Cerrar menú" class="drawer-overlay"></label>
        <aside class="w-80 bg-base-100 border-r border-base-300 min-h-full p-4">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-primary">AVANCE 2020 Admin</a>

            <ul class="menu mt-6 w-full gap-1">
                <li><a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')])>Dashboard</a></li>
                <li class="menu-title"><span>Consultas</span></li>
                <li><a href="{{ route('admin.history.index') }}" @class(['active' => request()->routeIs('admin.history.*')])>Historial de resultados</a></li>
                <li class="menu-title"><span>Perfil / Seguridad</span></li>
                <li><a href="{{ route('admin.profile.password.edit') }}" @class(['active' => request()->routeIs('admin.profile.*')])>Cambiar contraseña</a></li>
            </ul>
        </aside>
    </div>
</div>
</body>
</html>
