@props([
    'title' => 'Panel de administración',
    'breadcrumb' => [],
])

<header class="sticky top-0 z-30 border-b border-base-300 bg-base-100/95 backdrop-blur">
    <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
        <div class="min-w-0">
            <div class="flex items-center gap-2">
                <button
                    type="button"
                    class="btn btn-ghost btn-square btn-sm lg:hidden"
                    data-open-sidebar
                    aria-label="Abrir navegación"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <h1 class="truncate text-lg font-semibold">{{ $title }}</h1>
            </div>

            @if(!empty($breadcrumb))
                <div class="mt-1 hidden text-xs text-base-content/60 sm:block">
                    @foreach($breadcrumb as $crumb)
                        @if(! $loop->first)
                            <span class="mx-1">/</span>
                        @endif

                        @if(!empty($crumb['url']))
                            <a href="{{ $crumb['url'] }}" class="hover:text-base-content">{{ $crumb['label'] }}</a>
                        @else
                            <span>{{ $crumb['label'] }}</span>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <div class="relative" data-user-dropdown>
            <button
                type="button"
                class="btn btn-ghost gap-2 border border-base-300 bg-base-100 px-2"
                data-user-dropdown-button
                aria-expanded="false"
                aria-haspopup="true"
            >
                <span class="avatar placeholder">
                    <span class="size-8 rounded-full bg-primary/15 text-xs font-semibold text-primary">
                        {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                    </span>
                </span>
                <span class="hidden text-sm sm:inline">{{ auth()->user()->username }}</span>
            </button>

            <div class="absolute right-0 z-50 mt-2 hidden w-56 rounded-lg border border-base-300 bg-base-100 p-2 shadow" data-user-dropdown-menu>
                <a href="{{ route('admin.profile.password.edit') }}" class="block rounded px-3 py-2 text-sm hover:bg-base-200">Cambiar contraseña</a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="mt-1 w-full rounded px-3 py-2 text-left text-sm text-error hover:bg-error/10">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </div>
</header>
