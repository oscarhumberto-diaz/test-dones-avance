<x-layouts.admin title="Dashboard">
    <div class="grid md:grid-cols-2 gap-4">
        <div class="stats shadow bg-base-100">
            <div class="stat">
                <div class="stat-title">Intentos registrados</div>
                <div class="stat-value text-primary">{{ number_format($attemptsCount) }}</div>
            </div>
        </div>

        <div class="stats shadow bg-base-100">
            <div class="stat">
                <div class="stat-title">Último intento</div>
                <div class="stat-value text-lg">
                    {{ $lastAttemptAt ? \Illuminate\Support\Carbon::parse($lastAttemptAt)->format('d/m/Y H:i') : 'Sin datos' }}
                </div>
            </div>
        </div>
    </div>

    <div class="card bg-base-100 shadow mt-6">
        <div class="card-body">
            <h2 class="card-title">Acceso rápido</h2>
            <p>Revisa y filtra resultados en el historial consolidado del test AVANCE 2020.</p>
            <div class="card-actions">
                <a href="{{ route('admin.history.index') }}" class="btn btn-primary">Ver historial</a>
            </div>
        </div>
    </div>
</x-layouts.admin>
