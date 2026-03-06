<x-layouts.admin
    title="Historial de resultados"
    :breadcrumb="[
        ['label' => 'Admin', 'url' => route('admin.dashboard')],
        ['label' => 'Historial'],
    ]"
>
    <section class="card border border-base-300 bg-base-100 shadow-sm">
        <div class="card-body gap-5">
            <div>
                <h2 class="card-title">Filtros de búsqueda</h2>
                <p class="text-sm text-base-content/70">Refina por fechas, participante, test o don principal.</p>
            </div>

            <form method="GET" action="{{ route('admin.history.index') }}" class="grid gap-3 md:grid-cols-2 xl:grid-cols-5">
                <label class="form-control">
                    <span class="label-text">Desde</span>
                    <input type="date" name="from" value="{{ request('from') }}" class="input input-bordered focus:border-primary focus:outline-none" />
                </label>

                <label class="form-control">
                    <span class="label-text">Hasta</span>
                    <input type="date" name="to" value="{{ request('to') }}" class="input input-bordered focus:border-primary focus:outline-none" />
                </label>

                <label class="form-control">
                    <span class="label-text">Participante</span>
                    <input type="text" name="participant" value="{{ request('participant') }}" class="input input-bordered focus:border-primary focus:outline-none" placeholder="Nombre" />
                </label>

                <label class="form-control">
                    <span class="label-text">Test</span>
                    <select name="test_id" class="select select-bordered focus:border-primary focus:outline-none">
                        <option value="">Todos</option>
                        @foreach($tests as $test)
                            <option value="{{ $test->id }}" @selected((string) request('test_id', $selectedTestId) === (string) $test->id)>{{ $test->nombre }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="form-control">
                    <span class="label-text">Don principal</span>
                    <select name="top_gift_id" class="select select-bordered focus:border-primary focus:outline-none">
                        <option value="">Todos</option>
                        @foreach($gifts as $gift)
                            <option value="{{ $gift->id }}" @selected((string) request('top_gift_id') === (string) $gift->id)>{{ $gift->nombre }}</option>
                        @endforeach
                    </select>
                </label>

                <div class="flex flex-wrap gap-2 pt-1 md:col-span-2 xl:col-span-5">
                    <button class="btn btn-primary">Aplicar filtros</button>
                    <a href="{{ route('admin.history.index') }}" class="btn btn-outline">Limpiar</a>
                </div>
            </form>
        </div>
    </section>

    <section class="card border border-base-300 bg-base-100 shadow-sm">
        <div class="card-body p-0">
            <div class="flex items-center justify-between border-b border-base-300 px-5 py-4">
                <h3 class="text-base font-semibold">Resultados registrados</h3>
                <span class="text-xs text-base-content/60">{{ $attempts->total() }} registros</span>
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra [--tblr:theme(colors.base-300)]">
                    <thead class="bg-base-200 text-base-content">
                        <tr>
                            <th>Fecha/hora</th>
                            <th>Participante</th>
                            <th>Top 3 dones</th>
                            <th class="text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($attempts as $attempt)
                        <tr>
                            <td class="whitespace-nowrap">{{ $attempt->created_at?->format('d/m/Y H:i') }}</td>
                            <td>
                                <p class="font-medium">{{ $attempt->nombre_persona }}</p>
                                <p class="text-xs opacity-70">{{ $attempt->test?->nombre }}</p>
                            </td>
                            <td>
                                <ol class="ml-4 list-decimal text-sm">
                                    @foreach($attempt->giftScores->take(3) as $score)
                                        <li>{{ $score->gift->nombre }} ({{ $score->total }})</li>
                                    @endforeach
                                </ol>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('admin.history.show', $attempt) }}" class="btn btn-sm btn-outline hover:bg-primary hover:text-primary-content">Ver detalle</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center opacity-70">No hay resultados para los filtros seleccionados.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-base-300 px-4 py-3">
                {{ $attempts->links() }}
            </div>
        </div>
    </section>
</x-layouts.admin>
