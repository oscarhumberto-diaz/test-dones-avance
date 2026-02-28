<div class="card bg-base-100 shadow-xl">
    <div class="card-body">
        <div class="flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
            <div>
                <h2 class="card-title text-2xl">Test de Dones Espirituales</h2>
                <p class="text-sm opacity-75">Marca cada afirmación del 0 al 3: 0 = Nunca, 1 = Rara vez, 2 = Frecuentemente, 3 = Siempre.</p>
            </div>
            <span class="badge badge-primary badge-lg">Página {{ $currentPage }} / {{ $totalPages }}</span>
        </div>

        <label class="form-control w-full mt-4">
            <div class="label"><span class="label-text font-semibold">Nombre *</span></div>
            <input type="text" wire:model.blur="nombre_persona" class="input input-bordered w-full" placeholder="Ej: Ana Pérez">
            @error('nombre_persona') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
        </label>

        <div class="space-y-4 mt-2">
            @foreach($questionsForPage as $question)
                <div class="card bg-base-200 border border-base-300">
                    <div class="card-body p-4">
                        <p class="font-medium">{{ $question->numero }}. {{ $question->texto }}</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 mt-3">
                            @foreach([0 => 'Nunca', 1 => 'Rara vez', 2 => 'Frecuentemente', 3 => 'Siempre'] as $score => $label)
                                <label class="label cursor-pointer justify-start gap-3 rounded-lg bg-base-100 px-3 py-2 border border-base-300">
                                    <input type="radio" class="radio radio-primary" wire:model="answers.{{ $question->id }}" value="{{ $score }}">
                                    <span><strong>{{ $score }}</strong> · {{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('answers.'.$question->id) <span class="text-error text-sm">Debes responder esta pregunta con un valor entre 0 y 3.</span> @enderror
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6 flex items-center justify-between">
            <button class="btn btn-outline" wire:click="previousPage" @disabled($pageIndex === 0)>Anterior</button>

            @if($pageIndex < ($totalPages - 1))
                <button class="btn btn-primary" wire:click="nextPage">Siguiente</button>
            @else
                <button class="btn btn-success" wire:click="submit">Enviar</button>
            @endif
        </div>
    </div>
</div>
