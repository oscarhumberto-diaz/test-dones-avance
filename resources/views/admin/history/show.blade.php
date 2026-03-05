<x-layouts.admin :title="'Detalle de '.$attempt->nombre_persona">
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('admin.history.index') }}" class="btn btn-ghost">← Volver al historial</a>
        <button onclick="window.print()" class="btn btn-outline">Imprimir</button>
    </div>

    <div class="card bg-base-100 shadow mb-6">
        <div class="card-body">
            <h2 class="card-title">Datos del participante</h2>
            <p><strong>Nombre:</strong> {{ $attempt->nombre_persona }}</p>
            <p><strong>Test:</strong> {{ $attempt->test?->nombre }}</p>
            <p><strong>Fecha:</strong> {{ $attempt->created_at?->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <section>
        <h3 class="text-lg font-semibold mb-3">Top 3 dones</h3>
        <div class="grid md:grid-cols-3 gap-4 mb-6">
            @foreach($topThree as $index => $score)
                <div class="card {{ $index === 0 ? 'bg-primary text-primary-content' : 'bg-base-100' }} shadow">
                    <div class="card-body">
                        <p class="text-sm uppercase opacity-80">#{{ $index + 1 }}</p>
                        <h4 class="card-title">{{ $score->gift->nombre }}</h4>
                        <p>Total: <strong>{{ $score->total }}</strong></p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <div class="card bg-base-100 shadow">
        <div class="card-body overflow-x-auto">
            <div class="flex justify-between items-center mb-2">
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
