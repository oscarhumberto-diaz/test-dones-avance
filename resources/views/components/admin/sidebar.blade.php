@php
    $navItems = [
        [
            'label' => 'Dashboard',
            'route' => 'admin.dashboard',
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            'label' => 'Historial de resultados',
            'route' => 'admin.history.index',
            'active' => request()->routeIs('admin.history.*'),
        ],
        [
            'label' => 'Cambiar contraseña',
            'route' => 'admin.profile.password.edit',
            'active' => request()->routeIs('admin.profile.*'),
        ],
    ];
@endphp

<div class="flex h-full flex-col">
    <div class="flex items-center justify-between border-b border-base-300 px-4 py-4">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3" data-close-sidebar>
            <span class="grid size-10 place-items-center rounded-lg bg-primary/15 text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5l7.5 4.125v6.75L12 19.5 4.5 15.375v-6.75L12 4.5z"/>
                </svg>
            </span>
            <div>
                <p class="text-sm font-bold leading-tight">AVANCE 2020</p>
                <p class="text-xs text-base-content/60">Panel administrativo</p>
            </div>
        </a>

        <button
            type="button"
            class="btn btn-ghost btn-sm btn-square lg:hidden"
            data-close-sidebar
            aria-label="Cerrar navegación"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <nav class="flex-1 space-y-1 p-3" aria-label="Menú de administración">
        @foreach($navItems as $item)
            <a
                href="{{ route($item['route']) }}"
                data-close-sidebar
                @class([
                    'block rounded-lg px-3 py-2 text-sm font-medium transition-colors',
                    'bg-primary text-primary-content' => $item['active'],
                    'text-base-content/75 hover:bg-base-200 hover:text-base-content' => ! $item['active'],
                ])
            >
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>

    <p class="border-t border-base-300 px-4 py-3 text-xs text-base-content/60">
        Acceso restringido al equipo administrador.
    </p>
</div>
