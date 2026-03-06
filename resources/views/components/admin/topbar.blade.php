@props([
    'title' => 'Panel de administración',
    'breadcrumb' => [],
])

<header class="sticky top-0 z-30 border-b border-base-300/80 bg-base-100/90 backdrop-blur-md">
    <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
        <div class="flex min-w-0 items-center gap-3">
            <button type="button" class="btn btn-ghost btn-square text-base-content/75 hover:bg-base-200 hover:text-base-content lg:hidden" data-open-sidebar aria-label="Abrir menú de navegación">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div class="min-w-0">
                @if(!empty($breadcrumb))
                    <div class="breadcrumbs mb-1 hidden text-[11px] font-medium text-base-content/55 sm:block">
                        <ul>
                            @foreach($breadcrumb as $crumb)
                                <li>
                                    @if(!empty($crumb['url']))
                                        <a href="{{ $crumb['url'] }}" class="transition-colors hover:text-base-content">{{ $crumb['label'] }}</a>
                                    @else
                                        <span>{{ $crumb['label'] }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1 class="truncate text-lg font-semibold tracking-tight sm:text-[1.35rem]">{{ $title }}</h1>
            </div>
        </div>

        <div class="relative" data-user-dropdown>
            <button
                type="button"
                class="btn btn-ghost h-auto min-h-0 gap-2 rounded-xl border border-base-300/80 bg-base-100 px-2.5 py-1.5 hover:border-base-300 hover:bg-base-200/70 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
                data-user-dropdown-button
                aria-haspopup="true"
                aria-expanded="false"
                aria-label="Abrir menú de usuario"
            >
                <div class="avatar placeholder">
                    <div class="size-8 rounded-full bg-primary/12 text-primary">
                        <span class="text-xs font-bold">{{ strtoupper(substr(auth()->user()->username, 0, 1)) }}</span>
                    </div>
                </div>
                <div class="hidden text-left sm:block">
                    <p class="max-w-28 truncate text-sm font-semibold leading-tight">{{ auth()->user()->username }}</p>
                    <p class="text-[11px] text-base-content/55">Administrador</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-base-content/60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div class="absolute right-0 z-[60] mt-2 hidden w-60 rounded-2xl border border-base-300/80 bg-base-100 p-2 shadow-xl shadow-base-content/10" data-user-dropdown-menu>
                <p class="px-3 pb-2 pt-1 text-[11px] font-semibold uppercase tracking-[0.12em] text-base-content/55">Mi cuenta</p>
                <ul class="menu gap-1 p-0">
                    <li><a href="{{ route('admin.dashboard') }}" class="rounded-lg transition-colors hover:bg-base-200">Mi cuenta / Seguridad</a></li>
                    <li><a href="{{ route('admin.profile.password.edit') }}" class="rounded-lg transition-colors hover:bg-base-200">Cambiar contraseña</a></li>
                    <li>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="w-full rounded-lg px-3 py-2 text-left text-error transition-colors hover:bg-error/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-error">Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
