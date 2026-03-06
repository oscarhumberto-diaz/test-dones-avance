@props([
    'title' => 'Panel de administración',
    'breadcrumb' => [],
])

<header class="sticky top-0 z-30 border-b border-base-300/80 bg-base-100/95 backdrop-blur">
    <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-3 px-4 py-3 lg:px-8">
        <div class="flex min-w-0 items-center gap-3">
            <button type="button" class="btn btn-ghost btn-square lg:hidden" data-open-sidebar aria-label="Abrir menú de navegación">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div class="min-w-0 space-y-0.5">
                @if(!empty($breadcrumb))
                    <div class="breadcrumbs hidden text-xs text-base-content/60 sm:block">
                        <ul>
                            @foreach($breadcrumb as $crumb)
                                <li>
                                    @if(!empty($crumb['url']))
                                        <a href="{{ $crumb['url'] }}" class="hover:text-base-content">{{ $crumb['label'] }}</a>
                                    @else
                                        <span>{{ $crumb['label'] }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1 class="truncate text-lg font-semibold tracking-tight sm:text-xl">{{ $title }}</h1>
            </div>
        </div>

        <div class="flex items-center gap-2 sm:gap-3">
            <a href="{{ route('admin.history.index') }}" class="btn btn-sm btn-outline hidden sm:inline-flex">Ver historial</a>

            <details class="dropdown dropdown-end" data-admin-user-dropdown>
                <summary class="btn btn-ghost btn-sm sm:btn-md gap-2 rounded-xl border border-transparent px-2.5 hover:border-base-300 hover:bg-base-200/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                    <div class="avatar placeholder">
                        <div class="size-8 rounded-full bg-primary/15 text-primary">
                            <span class="text-xs font-bold">{{ strtoupper(substr(auth()->user()->username, 0, 1)) }}</span>
                        </div>
                    </div>
                    <span class="hidden max-w-28 truncate text-sm sm:inline">{{ auth()->user()->username }}</span>
                </summary>

                <ul class="menu dropdown-content z-[60] mt-2 w-56 rounded-box border border-base-300 bg-base-100 p-2 shadow-xl">
                    <li class="menu-title"><span>Mi cuenta</span></li>
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.profile.password.edit') }}">Cambiar contraseña</a></li>
                    <li>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="w-full rounded-lg px-3 py-2 text-left text-error hover:bg-error/10">Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
            </details>
        </div>
    </div>
</header>
