<x-layouts.admin title="Historial de resultados">
    <div class="card bg-base-100 shadow mb-6">
        <div class="card-body">
            <h2 class="card-title">Filtros</h2>
            <form method="GET" action="{{ route('admin.history.index') }}" class="grid md:grid-cols-5 gap-3">
                <label class="form-control">
                    <span class="label-text">Desde</span>
                    <input type="date" name="from" value="{{ request('from') }}" class="input input-bordered">
                </label>

                <label class="form-control">
                    <span class="label-text">Hasta</span>
                    <input type="date" name="to" value="{{ request('to') }}" class="input input-bordered">
                </label>

                <label class="form-control">
                    <span class="label-text">Participante</span>
                    <input type="text" name="participant" value="{{ request('participant') }}" class="input input-bordered" placeholder="Nombre">
                </label>

                <label class="form-control">
                    <span class="label-text">Test</span>
                    <select name="test_id" class="select select-bordered">
                        <option value="">Todos</option>
                        @foreach($tests as $test)
                            <option value="{{ $test->id }}" @selected((string) request('test_id', $selectedTestId) === (string) $test->id)>{{ $test->nombre }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="form-control">
                    <span class="label-text">Don principal</span>
                    <select name="top_gift_id" class="select select-bordered">
                        <option value="">Todos</option>
                        @foreach($gifts as $gift)
                            <option value="{{ $gift->id }}" @selected((string) request('top_gift_id') === (string) $gift->id)>{{ $gift->nombre }}</option>
                        @endforeach
                    </select>
                </label>

                <div class="md:col-span-5 flex gap-2">
                    <button class="btn btn-primary">Aplicar filtros</button>
                    <a href="{{ route('admin.history.index') }}" class="btn btn-ghost">Limpiar</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card bg-base-100 shadow">
        <div class="card-body overflow-x-auto">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>Fecha/hora</th>
                        <th>Participante</th>
                        <th>Top 3 dones</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @forelse($attempts as $attempt)
                    <tr>
                        <td>{{ $attempt->created_at?->format('d/m/Y H:i') }}</td>
                        <td>
                            <p class="font-medium">{{ $attempt->nombre_persona }}</p>
                            <p class="text-xs opacity-70">{{ $attempt->test?->nombre }}</p>
                        </td>
                        <td>
                            <ol class="list-decimal ml-4 text-sm">
                                @foreach($attempt->giftScores->take(3) as $score)
                                    <li>{{ $score->gift->nombre }} ({{ $score->total }})</li>
                                @endforeach
                            </ol>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('admin.history.show', $attempt) }}" class="btn btn-sm btn-outline">Ver detalle</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-8 opacity-70">No hay resultados para los filtros seleccionados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $attempts->links() }}
            </div>
        </div>
    </div>
</x-layouts.admin>
