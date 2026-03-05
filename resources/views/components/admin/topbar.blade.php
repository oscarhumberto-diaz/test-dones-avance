@props([
    'title' => 'Panel de administración',
    'breadcrumb' => [],
])

<header class="sticky top-0 z-20 border-b border-base-300/70 bg-base-100/95 backdrop-blur">
    <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-3 px-4 py-3 lg:px-6">
        <div class="flex min-w-0 items-center gap-3">
            <label for="admin-drawer" class="btn btn-primary lg:hidden" aria-label="Abrir menú de navegación">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                Menú
            </label>
            <div class="min-w-0">
                @if(!empty($breadcrumb))
                    <div class="breadcrumbs mb-1 hidden text-xs text-base-content/60 sm:block">
                        <ul>
                            @foreach($breadcrumb as $crumb)
                                <li>
                                    @if(!empty($crumb['url']))
                                        <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                                    @else
                                        <span>{{ $crumb['label'] }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1 class="truncate text-lg font-semibold sm:text-xl">{{ $title }}</h1>
            </div>
        </div>

        <div class="flex items-center gap-2 sm:gap-3">
            <a href="{{ route('admin.history.index') }}" class="btn btn-sm btn-outline">
                Ver historial
            </a>

            <div class="dropdown dropdown-end">
                <button tabindex="0" class="btn btn-sm sm:btn-md btn-ghost gap-2">
                    <div class="avatar placeholder">
                        <div class="size-8 rounded-full bg-primary/15 text-primary">
                            <span class="text-xs font-bold">{{ strtoupper(substr(auth()->user()->username, 0, 1)) }}</span>
                        </div>
                    </div>
                    <span class="hidden max-w-28 truncate sm:inline">{{ auth()->user()->username }}</span>
                </button>
                <ul tabindex="0" class="menu dropdown-content z-[30] mt-2 w-56 rounded-box border border-base-300 bg-base-100 p-2 shadow-xl">
                    <li class="menu-title px-2 pb-0">Cuenta</li>
                    <li><a href="{{ route('admin.profile.password.edit') }}">Perfil / Seguridad: Cambiar contraseña</a></li>
                    <li>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left">Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
