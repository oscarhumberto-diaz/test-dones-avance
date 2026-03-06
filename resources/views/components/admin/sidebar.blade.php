@php
    $navItems = [
        [
            'label' => 'Dashboard',
            'route' => 'admin.dashboard',
            'active' => request()->routeIs('admin.dashboard'),
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 9.75L12 3l8.25 6.75v9.75a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V9.75z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 21V12.75h6V21"/>',
        ],
        [
            'label' => 'Historial de resultados',
            'route' => 'admin.history.index',
            'active' => request()->routeIs('admin.history.*'),
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.5 6.75h15m-15 5.25h15m-15 5.25h7.5"/><circle cx="16.5" cy="16.5" r="3" stroke-width="1.8" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18.75 18.75L21 21"/>',
        ],
        [
            'label' => 'Cambiar contraseña',
            'route' => 'admin.profile.password.edit',
            'active' => request()->routeIs('admin.profile.*'),
            'icon' => '<rect x="4.5" y="10.5" width="15" height="10.5" rx="2" ry="2" stroke-width="1.8" fill="none" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.25 10.5V7.875a3.75 3.75 0 0 1 7.5 0V10.5M12 14.25v3"/>',
        ],
    ];
@endphp

<div class="flex h-full flex-col px-4 py-5">
    <div class="flex items-start justify-between gap-3 border-b border-base-300/80 pb-5">
        <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3 rounded-xl" data-close-sidebar>
            <div class="grid size-11 place-items-center rounded-2xl bg-primary/10 text-primary transition-colors duration-200 group-hover:bg-primary/15">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="size-6 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5l7.5 4.125v6.75L12 19.5 4.5 15.375v-6.75L12 4.5z" />
                </svg>
            </div>
            <div>
                <p class="text-base font-extrabold leading-tight tracking-tight">AVANCE 2020</p>
                <p class="text-[11px] font-medium uppercase tracking-[0.14em] text-base-content/55">Test de Dones</p>
            </div>
        </a>

        <button type="button" class="btn btn-ghost btn-sm btn-square text-base-content/70 hover:bg-base-200 hover:text-base-content lg:hidden" data-close-sidebar aria-label="Cerrar menú">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <nav class="mt-5 flex-1" aria-label="Menú principal de administración">
        <ul class="space-y-1.5">
            @foreach($navItems as $item)
                <li>
                    <a
                        href="{{ route($item['route']) }}"
                        data-close-sidebar
                        @class([
                            'group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-150 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary',
                            'border border-primary/10 bg-primary text-primary-content shadow-sm hover:bg-primary/90 active:scale-[0.99]' => $item['active'],
                            'border border-transparent text-base-content/75 hover:border-base-300 hover:bg-base-200 hover:text-base-content active:bg-base-300/60' => ! $item['active'],
                        ])
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="size-5 shrink-0 stroke-current">
                            {!! $item['icon'] !!}
                        </svg>
                        <span>{{ $item['label'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

    <div class="rounded-xl border border-base-300/80 bg-base-200/80 px-3 py-2.5 text-xs leading-relaxed text-base-content/70">
        Administración interna · acceso restringido.
    </div>
</div>
