<div class="mx-auto w-full max-w-5xl rounded-3xl border border-base-300 bg-base-100 shadow-xl">
    <div class="space-y-6 p-4 sm:p-6 lg:p-8">
        <header class="space-y-2 border-b border-base-200 pb-5">
            <p class="text-xs font-semibold uppercase tracking-widest text-primary">MVP · Sin login</p>
            <h1 class="text-2xl font-bold text-base-content sm:text-3xl">Test de Dones Espirituales</h1>
            <p class="text-sm text-base-content/70 sm:text-base">Responde 60 preguntas (10 por página) para conocer tus dones predominantes.</p>
        </header>

        <div class="flex items-center justify-between">
            <span class="text-sm font-semibold">Página {{ $currentPage }} de {{ $totalPages }}</span>
            <span class="badge badge-primary">{{ $currentPage }}/{{ $totalPages }}</span>
        </div>

        <progress class="progress progress-primary h-3 w-full" value="{{ $currentPage }}" max="{{ $totalPages }}"></progress>

        <label class="form-control w-full">
            <div class="label px-1"><span class="label-text font-semibold">Nombre *</span></div>
            <input type="text" wire:model.blur="nombre_persona" class="input input-bordered w-full" placeholder="Ej: Ana Pérez">
            @error('nombre_persona')
                <span class="mt-2 px-1 text-sm font-medium text-error">{{ $message }}</span>
            @enderror
        </label>

        <div class="space-y-4">
            @foreach($questionsForPage as $question)
                <article class="rounded-2xl border border-base-300 bg-base-100 p-4 sm:p-5">
                    <p class="text-sm font-semibold sm:text-base">{{ $question->numero }}. {{ $question->texto }}</p>
                    <div class="mt-4 grid grid-cols-1 gap-2 sm:grid-cols-2 xl:grid-cols-4">
                        @foreach([0 => 'Nunca', 1 => 'Rara vez', 2 => 'Frecuentemente', 3 => 'Siempre'] as $score => $label)
                            <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-base-300 bg-base-200 px-3 py-3">
                                <input type="radio" class="radio radio-primary" wire:model="answers.{{ $question->id }}" value="{{ $score }}">
                                <span class="text-sm"><strong>{{ $score }}</strong> · {{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('answers.'.$question->id)
                        <p class="mt-2 text-sm font-medium text-error">Debes responder esta pregunta.</p>
                    @enderror
                </article>
            @endforeach
        </div>

        <div class="flex flex-col gap-3 border-t border-base-200 pt-4 sm:flex-row sm:items-center sm:justify-between">
            <button class="btn btn-outline w-full sm:w-auto" wire:click="previousPage" @disabled($pageIndex === 0)>Anterior</button>
            <div>
                @if($pageIndex < ($totalPages - 1))
                    <button class="btn btn-primary w-full sm:w-auto" wire:click="nextPage">Siguiente</button>
                @else
                    <button class="btn btn-primary w-full sm:w-auto" wire:click="submit">Enviar</button>
                @endif
            </div>
        </div>
    </div>
</div>
