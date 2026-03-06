<x-layouts.admin
    :title="'Detalle de '.$attempt->nombre_persona"
    :breadcrumb="[
        ['label' => 'Admin', 'url' => route('admin.dashboard')],
        ['label' => 'Historial', 'url' => route('admin.history.index')],
        ['label' => 'Detalle'],
    ]"
>
    <div class="flex flex-wrap items-center justify-between gap-2">
        <a href="{{ route('admin.history.index') }}" class="btn btn-ghost btn-sm border border-transparent hover:border-base-300/80 sm:btn-md">← Volver al historial</a>
        <button onclick="window.print()" class="btn btn-outline btn-sm border-base-300/80 sm:btn-md hover:bg-base-200">Imprimir</button>
    </div>

    <div class="card border border-base-300/80 bg-base-100 shadow-sm">
        <div class="card-body gap-2 p-5">
            <h2 class="text-base font-semibold tracking-tight">Datos del participante</h2>
            <div class="grid gap-2 text-sm sm:grid-cols-3">
                <p><strong>Nombre:</strong> {{ $attempt->nombre_persona }}</p>
                <p><strong>Test:</strong> {{ $attempt->test?->nombre }}</p>
                <p><strong>Fecha:</strong> {{ $attempt->created_at?->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>

    <section>
        <h3 class="mb-3 text-sm font-semibold uppercase tracking-[0.08em] text-base-content/70">Top 3 dones</h3>
        <div class="grid gap-3 md:grid-cols-3">
            @foreach($topThree as $index => $score)
                <div class="card border border-base-300/80 {{ $index === 0 ? 'border-primary/20 bg-primary text-primary-content' : 'bg-base-100' }} shadow-sm">
                    <div class="card-body gap-2 p-5">
                        <p class="text-xs font-semibold uppercase tracking-wide opacity-80">#{{ $index + 1 }}</p>
                        <h4 class="text-base font-semibold leading-tight">{{ $score->gift->nombre }}</h4>
                        <p class="text-sm">Total: <strong>{{ $score->total }}</strong></p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <div class="card border border-base-300/80 bg-base-100 shadow-sm">
        <div class="card-body overflow-x-auto p-5">
            <div class="mb-2 flex flex-wrap items-center justify-between gap-2">
                <h3 class="text-base font-semibold tracking-tight">Ranking completo</h3>
                <span class="text-xs text-base-content/60">Exportación CSV/PDF: pendiente (estructura lista).</span>
            </div>
            <table class="table table-zebra [--tblr:theme(colors.base-300)]">
                <thead class="bg-base-200/60 text-[11px] uppercase tracking-[0.1em] text-base-content/70">
                <tr>
                    <th>#</th>
                    <th>Don</th>
                    <th>Suma</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($scores as $index => $score)
                    <tr class="hover">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $score->gift->nombre }}</td>
                        <td>{{ $score->suma }}</td>
                        <td>{{ $score->total }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
