<div class="max-w-5xl mx-auto space-y-6">
    @if (session('success'))
        <div class="alert alert-success shadow-sm">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h1 class="card-title text-2xl">Test de Dones Espirituales (AVANCE 2020)</h1>
            <p class="text-sm opacity-75">Responde cada afirmación con una escala de 0 a 3, donde 0 = Nunca y 3 = Siempre.</p>

            <label class="form-control w-full mt-4">
                <div class="label"><span class="label-text font-semibold">Nombre completo *</span></div>
                <input type="text" wire:model.blur="full_name" class="input input-bordered w-full" placeholder="Ej: Ana Pérez García">
                @error('full_name') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
            </label>

            <div class="divider">Página {{ $currentPage }} de {{ $totalPages }}</div>

            <div class="space-y-4">
                @foreach($questions as $question)
                    <div class="card bg-base-200 border border-base-300">
                        <div class="card-body p-4">
                            <p class="font-medium">{{ $question->numero }}. {{ $question->texto }}</p>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 mt-3">
                                @for($score = 0; $score <= 3; $score++)
                                    <label class="label cursor-pointer justify-start gap-2 bg-base-100 rounded-lg px-3 py-2">
                                        <input type="radio" class="radio radio-primary" wire:model="answers.{{ $question->id }}" value="{{ $score }}">
                                        <span>{{ $score }}</span>
                                    </label>
                                @endfor
                            </div>
                            @error('answers.'.$question->id) <span class="text-error text-sm">Debes seleccionar una opción para esta pregunta.</span> @enderror
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex items-center justify-between mt-6">
                <button class="btn btn-outline" wire:click="prevPage" @disabled($currentPage === 1)>Anterior</button>

                @if($currentPage < $totalPages)
                    <button class="btn btn-primary" wire:click="nextPage">Siguiente</button>
                @else
                    <button class="btn btn-success" wire:click="submit">Enviar</button>
                @endif
            </div>
        </div>
    </div>
</div>
