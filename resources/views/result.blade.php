<x-layouts.app :title="'Resultado del Test'">
    <div class="max-w-5xl mx-auto space-y-6">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h1 class="text-2xl font-bold">Resultado de {{ $attempt->nombre_persona }}</h1>
                <p class="opacity-70">Puntaje total: <span class="font-semibold">{{ $scores->sum('total') }}</span></p>
            </div>
        </div>

        <section>
            <h2 class="text-xl font-semibold mb-3">Top 3 dones destacados</h2>
            <div class="grid md:grid-cols-3 gap-4">
                @foreach($topThree as $index => $score)
                    <div class="card {{ $index === 0 ? 'bg-primary text-primary-content' : 'bg-base-100' }} shadow-md">
                        <div class="card-body">
                            <p class="text-sm uppercase opacity-80">#{{ $index + 1 }}</p>
                            <h3 class="card-title">{{ $score->gift->nombre }}</h3>
                            <p>Puntaje final: <strong>{{ $score->total }}</strong></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="card bg-base-100 shadow-xl">
            <div class="card-body overflow-x-auto">
                <h2 class="text-xl font-semibold mb-2">Tabla completa</h2>
                <table class="table table-zebra">
                    <thead>
                    <tr>
                        <th>Don</th>
                        <th>Suma (0..9)</th>
                        <th>Total final (x3)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($scores as $score)
                        <tr>
                            <td>{{ $score->gift->nombre }}</td>
                            <td>{{ $score->suma }}</td>
                            <td>{{ $score->total }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-layouts.app>
