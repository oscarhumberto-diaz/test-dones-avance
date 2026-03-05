<x-layouts.admin
    title="Dashboard"
    :breadcrumb="[
        ['label' => 'Admin'],
        ['label' => 'Dashboard'],
    ]"
>
    @if(session('status'))
        <div class="alert alert-success shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        <article class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-base-content/70">Intentos registrados</p>
                        <p class="mt-2 text-4xl font-bold text-primary">{{ number_format($attemptsCount) }}</p>
                    </div>
                    <div class="rounded-xl bg-primary/10 p-3 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 17v-6m3 6V7m3 10v-4m3 4V5M3 19h18" />
                        </svg>
                    </div>
                </div>
            </div>
        </article>

        <article class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <p class="text-sm font-medium text-base-content/70">Último intento</p>
                <p class="mt-2 text-2xl font-semibold">
                    {{ $lastAttemptAt ? \Illuminate\Support\Carbon::parse($lastAttemptAt)->format('d/m/Y H:i') : 'Sin datos todavía' }}
                </p>
                <p class="text-sm text-base-content/60">Última actividad registrada en el sistema.</p>
            </div>
        </article>

        <article class="card bg-base-100 shadow-sm md:col-span-2 xl:col-span-1">
            <div class="card-body">
                <h2 class="card-title">Accesos rápidos</h2>
                <p class="text-sm text-base-content/70">Navega a las acciones más usadas del panel.</p>
                <div class="mt-2 flex flex-wrap gap-2">
                    <a href="{{ route('admin.history.index') }}" class="btn btn-primary btn-sm">Ver historial</a>
                    <a href="{{ route('admin.profile.password.edit') }}" class="btn btn-outline btn-sm">Cambiar contraseña</a>
                </div>
            </div>
        </article>
    </section>
</x-layouts.admin>
