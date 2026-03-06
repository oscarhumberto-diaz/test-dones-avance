<x-layouts.admin
    :title="'Detalle de '.$attempt->nombre_persona"
    :breadcrumb="[
        ['label' => 'Admin', 'url' => route('admin.dashboard')],
        ['label' => 'Historial', 'url' => route('admin.history.index')],
        ['label' => 'Detalle'],
    ]"
>
    <div class="flex flex-wrap items-center justify-between gap-2">
        <a href="{{ route('admin.history.index') }}" class="btn btn-ghost btn-sm sm:btn-md">← Volver al historial</a>
        <button onclick="window.print()" class="btn btn-outline btn-sm sm:btn-md hover:bg-base-200">Imprimir</button>
    </div>

    <div class="card border border-base-300/80 bg-base-100 shadow-sm">
        <div class="card-body gap-2">
            <h2 class="card-title">Datos del participante</h2>
            <div class="grid gap-2 text-sm sm:grid-cols-3 sm:text-base">
                <p><strong>Nombre:</strong> {{ $attempt->nombre_persona }}</p>
                <p><strong>Test:</strong> {{ $attempt->test?->nombre }}</p>
                <p><strong>Fecha:</strong> {{ $attempt->created_at?->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>

    <section>
        <h3 class="mb-3 text-lg font-semibold">Top 3 dones</h3>
        <div class="grid gap-3 md:grid-cols-3">
            @foreach($topThree as $index => $score)
                <div class="card border border-base-300/80 {{ $index === 0 ? 'bg-primary text-primary-content border-primary/20' : 'bg-base-100' }} shadow-sm">
                    <div class="card-body gap-2">
                        <p class="text-xs font-semibold uppercase tracking-wide opacity-80">#{{ $index + 1 }}</p>
                        <h4 class="card-title">{{ $score->gift->nombre }}</h4>
                        <p>Total: <strong>{{ $score->total }}</strong></p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <div class="card border border-base-300/80 bg-base-100 shadow-sm">
        <div class="card-body overflow-x-auto">
            <div class="mb-2 flex flex-wrap items-center justify-between gap-2">
                <h3 class="text-lg font-semibold">Ranking completo</h3>
                <span class="text-sm opacity-70">Exportación CSV/PDF: pendiente (estructura lista).</span>
            </div>
            <table class="table table-zebra">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Don</th>
                    <th>Suma</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($scores as $index => $score)
                    <tr>
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
