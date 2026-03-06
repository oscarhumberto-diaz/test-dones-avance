<x-layouts.admin
    title="Dashboard"
    :breadcrumb="[
        ['label' => 'Admin'],
        ['label' => 'Dashboard'],
    ]"
>
    @if(session('status'))
        <div class="alert alert-success border border-success/20 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    <section class="grid gap-4 xl:grid-cols-12">
        <article class="card border border-base-300/80 bg-base-100 shadow-sm xl:col-span-4">
            <div class="card-body gap-3">
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
                <p class="text-sm leading-relaxed text-base-content/60">Total acumulado de respuestas guardadas por participantes.</p>
            </div>
        </article>

        <article class="card border border-base-300/80 bg-base-100 shadow-sm xl:col-span-4">
            <div class="card-body gap-3">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-base-content/70">Último intento</p>
                        <p class="mt-2 text-2xl font-semibold leading-tight">
                            {{ $lastAttemptAt ? \Illuminate\Support\Carbon::parse($lastAttemptAt)->format('d/m/Y H:i') : 'Sin datos todavía' }}
                        </p>
                    </div>
                    <div class="rounded-xl bg-info/10 p-3 text-info">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v6l4 2m5-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm leading-relaxed text-base-content/60">Última actividad registrada dentro del sistema.</p>
            </div>
        </article>

        <article class="card border border-base-300/80 bg-base-100 shadow-sm xl:col-span-4">
            <div class="card-body gap-3">
                <h2 class="card-title">Accesos rápidos</h2>
                <p class="text-sm text-base-content/70">Atajos directos para gestión diaria del panel.</p>
                <div class="mt-2 grid gap-2 sm:grid-cols-2 xl:grid-cols-1">
                    <a href="{{ route('admin.history.index') }}" class="btn btn-primary justify-start">Ver historial de resultados</a>
                    <a href="{{ route('admin.profile.password.edit') }}" class="btn btn-outline justify-start">Cambiar contraseña</a>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost justify-start sm:col-span-2 xl:col-span-1">Ir a dashboard</a>
                </div>
            </div>
        </article>
    </section>

    <section class="card border border-base-300/80 bg-base-100 shadow-sm">
        <div class="card-body">
            <h2 class="card-title">Resumen del panel</h2>
            <p class="text-sm leading-relaxed text-base-content/70">Usa la navegación lateral para explorar historial, revisar resultados y administrar la seguridad de la cuenta.</p>
        </div>
    </section>
</x-layouts.admin>
