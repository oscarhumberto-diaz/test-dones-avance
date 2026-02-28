<x-layouts.app :title="'Test de Dones Espirituales'">
    <div class="max-w-5xl mx-auto space-y-6">
        <section class="hero rounded-2xl bg-primary text-primary-content">
            <div class="hero-content text-center py-10">
                <div class="max-w-2xl space-y-3">
                    <h1 class="text-3xl font-bold">Descubre tus dones espirituales</h1>
                    <p>
                        Lee cada afirmación y selecciona la opción que mejor te describa.
                        El test tiene 60 preguntas distribuidas en 6 páginas.
                    </p>
                    <ul class="text-left list-disc list-inside opacity-95">
                        <li>Escala: 0 Nunca, 1 Rara vez, 2 Frecuentemente, 3 Siempre.</li>
                        <li>Responde con honestidad para obtener un resultado útil.</li>
                        <li>Al finalizar verás tu top 3 de dones y el detalle completo.</li>
                    </ul>
                </div>
            </div>
        </section>

        @livewire('test-dones-wizard')
    </div>
</x-layouts.app>
