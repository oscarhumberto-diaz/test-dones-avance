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

    <section class="grid gap-4 lg:grid-cols-2 xl:grid-cols-4">
        <article class="card border border-base-300 bg-base-100 shadow-sm lg:col-span-1 xl:col-span-1">
            <div class="card-body gap-2">
                <div class="flex items-center justify-between gap-3">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.1em] text-base-content/65">Intentos registrados</h2>
                    <span class="rounded-lg bg-primary/10 p-2 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 17v-6m3 6V7m3 10v-4m3 4V5M3 19h18" />
                        </svg>
                    </span>
                </div>
                <p class="text-4xl font-bold tracking-tight text-primary">{{ number_format($attemptsCount) }}</p>
                <p class="text-sm text-base-content/70">Total acumulado de respuestas procesadas por el sistema.</p>
            </div>
        </article>

        <article class="card border border-base-300 bg-base-100 shadow-sm lg:col-span-1 xl:col-span-1">
            <div class="card-body gap-2">
                <div class="flex items-center justify-between gap-3">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.1em] text-base-content/65">Último intento</h2>
                    <span class="rounded-lg bg-info/10 p-2 text-info">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v6l4 2m5-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </div>
                <p class="text-xl font-semibold leading-tight">
                    {{ $lastAttemptAt ? \Illuminate\Support\Carbon::parse($lastAttemptAt)->format('d/m/Y H:i') : 'Sin datos todavía' }}
                </p>
                <p class="text-sm text-base-content/70">Marca de tiempo de la última actividad registrada.</p>
            </div>
        </article>

        <article class="card border border-base-300 bg-base-100 shadow-sm lg:col-span-2 xl:col-span-2">
            <div class="card-body gap-4">
                <div>
                    <h2 class="card-title">Accesos rápidos</h2>
                    <p class="text-sm text-base-content/70">Atajos para las tareas más frecuentes del panel administrativo.</p>
                </div>
                <div class="grid gap-3 sm:grid-cols-2">
                    <a href="{{ route('admin.history.index') }}" class="group rounded-xl border border-base-300 bg-base-100 p-4 transition hover:-translate-y-0.5 hover:border-primary/30 hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                        <p class="font-semibold text-base-content group-hover:text-primary">Historial de resultados</p>
                        <p class="mt-1 text-sm text-base-content/65">Consulta intentos, filtros y detalle de resultados.</p>
                    </a>
                    <a href="{{ route('admin.profile.password.edit') }}" class="group rounded-xl border border-base-300 bg-base-100 p-4 transition hover:-translate-y-0.5 hover:border-primary/30 hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                        <p class="font-semibold text-base-content group-hover:text-primary">Cambiar contraseña</p>
                        <p class="mt-1 text-sm text-base-content/65">Actualiza credenciales y fortalece la seguridad.</p>
                    </a>
                </div>
            </div>
        </article>
    </section>

    <section class="card border border-base-300 bg-base-100 shadow-sm">
        <div class="card-body gap-2">
            <h2 class="card-title">Estado del panel</h2>
            <p class="text-sm leading-relaxed text-base-content/70">
                Este panel centraliza la revisión de resultados del Test de Dones y la gestión básica de la cuenta administradora.
            </p>
        </div>
    </section>
</x-layouts.admin>
