<x-layouts.admin
    title="Cambiar contraseña"
    :breadcrumb="[
        ['label' => 'Admin', 'url' => route('admin.dashboard')],
        ['label' => 'Perfil / Seguridad'],
    ]"
>
    <div class="mx-auto w-full max-w-3xl space-y-4">
        @if(session('status'))
            <div class="alert alert-success border border-success/20 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error border border-error/20 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Revisa los campos marcados para continuar.</span>
            </div>
        @endif

        <div class="card border border-base-300/80 bg-base-100 shadow-sm">
            <div class="card-body gap-6">
                <div>
                    <h2 class="card-title">Seguridad de la cuenta</h2>
                    <p class="text-sm text-base-content/70">Actualiza tu contraseña regularmente para mantener tu cuenta protegida.</p>
                </div>

                <div class="rounded-xl border border-base-300 bg-base-200/70 p-4 text-sm leading-relaxed">
                    <p class="font-semibold">Recomendaciones de contraseña:</p>
                    <ul class="mt-2 list-disc space-y-1 pl-5 text-base-content/80">
                        <li>Usa mínimo 8 caracteres.</li>
                        <li>Combina mayúsculas, minúsculas, números y símbolos.</li>
                        <li>Evita datos personales o contraseñas reutilizadas.</li>
                    </ul>
                </div>

                <form method="POST" action="{{ route('admin.profile.password.update') }}" class="space-y-4" onsubmit="const btn=this.querySelector('[data-loading-btn]'); if(btn){btn.disabled=true; btn.classList.add('btn-disabled'); btn.querySelector('[data-loading-spinner]').classList.remove('hidden'); btn.querySelector('[data-loading-text]').textContent='Actualizando...';}">
                    @csrf
                    @method('PUT')

                    <label class="form-control">
                        <span class="label-text">Contraseña actual</span>
                        <input type="password" name="current_password" class="input input-bordered focus:border-primary focus:outline-none" required>
                        @error('current_password')
                            <span class="mt-1 text-sm text-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="form-control">
                        <span class="label-text">Nueva contraseña</span>
                        <input type="password" name="new_password" class="input input-bordered focus:border-primary focus:outline-none" required>
                        @error('new_password')
                            <span class="mt-1 text-sm text-error">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="form-control">
                        <span class="label-text">Confirmar nueva contraseña</span>
                        <input type="password" name="new_password_confirmation" class="input input-bordered focus:border-primary focus:outline-none" required>
                    </label>

                    <button class="btn btn-primary min-w-48" data-loading-btn>
                        <span class="loading loading-spinner loading-xs hidden" data-loading-spinner></span>
                        <span data-loading-text>Actualizar contraseña</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
