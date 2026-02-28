<x-layouts.app :title="'Resultados de '.$attempt->nombre_persona">
    <div class="max-w-5xl mx-auto space-y-6">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h1 class="text-3xl font-bold">Resultados de {{ $attempt->nombre_persona }}</h1>
                <p class="opacity-70">Aquí tienes el resumen de tus dones ordenados por puntaje total.</p>
                <div class="card-actions justify-end gap-2 mt-2">
                    <a href="{{ route('test.index') }}" class="btn btn-outline">Hacer otro test</a>
                    <button class="btn btn-primary" onclick="window.print()">Imprimir</button>
                </div>
            </div>
        </div>

        <section>
            <h2 class="text-xl font-semibold mb-3">Top 3 dones</h2>
            <div class="grid md:grid-cols-3 gap-4">
                @foreach($topThree as $index => $score)
                    <div class="card {{ $index === 0 ? 'bg-primary text-primary-content' : 'bg-base-100' }} shadow-md">
                        <div class="card-body">
                            <p class="text-sm uppercase opacity-80">#{{ $index + 1 }}</p>
                            <h3 class="card-title">{{ $score->gift->nombre }}</h3>
                            <p>Suma: <strong>{{ $score->suma }}</strong></p>
                            <p>Total: <strong>{{ $score->total }}</strong></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="card bg-base-100 shadow-xl">
            <div class="card-body overflow-x-auto">
                <h2 class="text-xl font-semibold mb-2">Ranking completo de 20 dones</h2>
                <table class="table table-zebra">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Don</th>
                        <th>Suma (0..9)</th>
                        <th>Total (x3)</th>
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
        </section>
    </div>
</x-layouts.app>
