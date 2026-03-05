@php
    $navItems = [
        [
            'label' => 'Dashboard',
            'route' => 'admin.dashboard',
            'active' => request()->routeIs('admin.dashboard'),
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l9-9 9 9M5.25 9.75V20.25h13.5V9.75" />',
        ],
        [
            'label' => 'Historial de resultados',
            'route' => 'admin.history.index',
            'active' => request()->routeIs('admin.history.*'),
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.5 6.75h15m-15 5.25h15m-15 5.25h9" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.25 17.25l2.25 2.25" /><circle cx="14.75" cy="14.75" r="2.75" stroke-width="1.8"/>',
        ],
        [
            'label' => 'Cambiar contraseña',
            'route' => 'admin.profile.password.edit',
            'active' => request()->routeIs('admin.profile.*'),
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.5 10.5V7.875a4.5 4.5 0 10-9 0V10.5" /><rect x="4.5" y="10.5" width="15" height="9.75" rx="2" ry="2" stroke-width="1.8" fill="none"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14.25v2.25"/>',
        ],
    ];
@endphp

<aside class="min-h-full w-80 bg-base-100 border-r border-base-300/80 px-4 py-6">
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3">
        <div class="size-10 rounded-xl bg-primary/10 text-primary grid place-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="size-6 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5l7.5 4.125v6.75L12 19.5 4.5 15.375v-6.75L12 4.5z" />
            </svg>
        </div>
        <div>
            <p class="text-xs uppercase tracking-[0.2em] opacity-60">Panel admin</p>
            <p class="text-lg font-bold leading-tight">AVANCE 2020</p>
        </div>
    </a>

    <ul class="menu mt-6 w-full gap-1 rounded-box bg-base-200/50 p-2">
        @foreach($navItems as $item)
            <li>
                <a href="{{ route($item['route']) }}" @class(['active font-semibold', 'text-base-content/80' => ! $item['active']])>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="size-5 stroke-current">
                        {!! $item['icon'] !!}
                    </svg>
                    {{ $item['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
</aside>
