<x-layouts.admin title="Cambiar contraseña">
    <div class="max-w-2xl">
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <h2 class="card-title">Seguridad de la cuenta</h2>

                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('admin.profile.password.update') }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <label class="form-control">
                        <span class="label-text">Contraseña actual</span>
                        <input type="password" name="current_password" class="input input-bordered" required>
                        @error('current_password')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="form-control">
                        <span class="label-text">Nueva contraseña</span>
                        <input type="password" name="new_password" class="input input-bordered" required>
                        @error('new_password')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="form-control">
                        <span class="label-text">Confirmar nueva contraseña</span>
                        <input type="password" name="new_password_confirmation" class="input input-bordered" required>
                    </label>

                    <button class="btn btn-primary">Actualizar contraseña</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
