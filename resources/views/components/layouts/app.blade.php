<!doctype html>
<html lang="es" data-theme="cupcake">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Test de Dones Espirituales' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen flex flex-col">
    <nav class="navbar bg-base-100 shadow-md sticky top-0 z-20">
        <div class="container mx-auto px-4">
            <a href="{{ route('test.index') }}" class="text-lg font-bold text-primary">AVANCE 2020 · Test de Dones</a>
        </div>
    </nav>

    <main class="container mx-auto w-full px-4 py-8 flex-1">
        {{ $slot }}
    </main>

    <footer class="footer footer-center p-4 bg-base-300 text-base-content">
        <aside>
            <p>© {{ now()->year }} AVANCE 2020 · Evaluación orientativa de dones espirituales.</p>
        </aside>
    </footer>

    @livewireScripts
</body>
</html>
