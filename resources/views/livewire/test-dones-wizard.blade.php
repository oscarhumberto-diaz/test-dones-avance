<div class="mx-auto w-full max-w-5xl rounded-3xl border border-base-300 bg-base-100 shadow-xl">
    <div class="space-y-6 p-4 sm:p-6 lg:p-8">
        <header class="space-y-2 border-b border-base-200 pb-5">
            <p class="text-xs font-semibold uppercase tracking-widest text-primary">MVP · Evaluación guiada</p>
            <h1 class="text-2xl font-bold text-base-content sm:text-3xl">Test de Dones Espirituales</h1>
            <p class="text-sm text-base-content/70 sm:text-base">Responde 60 preguntas en 6 pasos rápidos para conocer tus dones predominantes.</p>
        </header>

        <section class="rounded-2xl border border-info/20 bg-info/5 p-4 sm:p-5">
            <h2 class="text-sm font-bold uppercase tracking-wide text-info">Instrucciones</h2>
            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-base-content/80">
                <li>Usa la escala: <strong>0</strong> Nunca, <strong>1</strong> Rara vez, <strong>2</strong> Frecuentemente, <strong>3</strong> Siempre.</li>
                <li>Contesta de forma honesta según tu experiencia actual.</li>
                <li>"Guardar y continuar" solo mantiene tus respuestas en memoria durante esta sesión.</li>
            </ul>
        </section>

        <section class="space-y-3">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <h3 class="text-sm font-semibold text-base-content/80">Progreso del wizard</h3>
                <span class="badge badge-primary badge-lg">{{ $currentPage }}/{{ $totalPages }}</span>
            </div>
            <progress class="progress progress-primary h-3 w-full" value="{{ $currentPage }}" max="{{ $totalPages }}"></progress>
            <ul class="steps steps-horizontal w-full overflow-x-auto text-xs">
                @for($step = 1; $step <= $totalPages; $step++)
                    <li class="step {{ $step <= $currentPage ? 'step-primary' : '' }} whitespace-nowrap">Paso {{ $step }}</li>
                @endfor
            </ul>
        </section>

        @if($statusMessage)
            <div class="alert alert-success text-sm">
                <span>{{ $statusMessage }}</span>
            </div>
        @endif

        <label class="form-control w-full">
            <div class="label px-1"><span class="label-text font-semibold">Nombre *</span></div>
            <input
                type="text"
                wire:model.blur="nombre_persona"
                class="input input-bordered w-full focus:input-primary"
                placeholder="Ej: Ana Pérez"
            >
            @error('nombre_persona')
                <span class="mt-2 px-1 text-sm font-medium text-error">{{ $message }}</span>
            @enderror
        </label>

        <div class="space-y-4">
            @foreach($questionsForPage as $question)
                <article class="rounded-2xl border border-base-300 bg-base-100 p-4 transition hover:border-primary/40 hover:shadow-md focus-within:border-primary/70 focus-within:shadow-md sm:p-5">
                    <p class="text-sm font-semibold text-base-content/90 sm:text-base">{{ $question->numero }}. {{ $question->texto }}</p>
                    <div class="mt-4 grid grid-cols-1 gap-2 sm:grid-cols-2 xl:grid-cols-4">
                        @foreach([0 => 'Nunca', 1 => 'Rara vez', 2 => 'Frecuentemente', 3 => 'Siempre'] as $score => $label)
                            <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-base-300 bg-base-200 px-3 py-3 transition hover:border-primary/50 hover:bg-base-100">
                                <input
                                    type="radio"
                                    class="radio radio-primary"
                                    wire:model="answers.{{ $question->id }}"
                                    value="{{ $score }}"
                                >
                                <span class="text-sm"><strong>{{ $score }}</strong> · {{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('answers.'.$question->id)
                        <p class="mt-2 text-sm font-medium text-error">Falta respuesta en esta pregunta.</p>
                    @enderror
                </article>
            @endforeach
        </div>

        <div class="flex flex-col gap-3 border-t border-base-200 pt-4 sm:flex-row sm:items-center sm:justify-between">
            <button
                class="btn btn-secondary btn-outline w-full sm:w-auto"
                wire:click="previousPage"
                wire:loading.attr="disabled"
                @disabled($pageIndex === 0)
            >
                Anterior
            </button>

            <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">
                @if($pageIndex < ($totalPages - 1))
                    <button class="btn btn-primary w-full sm:w-auto" wire:click="saveAndContinue" wire:loading.attr="disabled">Guardar y continuar</button>
                    <button class="btn btn-ghost w-full sm:w-auto" wire:click="nextPage" wire:loading.attr="disabled">Siguiente sin guardar</button>
                @else
                    <button class="btn btn-primary w-full sm:w-auto" wire:click="submit" wire:loading.attr="disabled">Enviar respuestas</button>
                @endif
            </div>
        </div>
    </div>
</div>
