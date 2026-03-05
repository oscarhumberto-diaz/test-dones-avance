<x-layouts.app title="Ingreso administrativo">
    <div class="max-w-md mx-auto mt-10">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h1 class="text-2xl font-bold">Acceso a administración</h1>
                <p class="text-sm opacity-70">Inicia sesión para gestionar consultas y resultados.</p>

                <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-4 mt-4">
                    @csrf

                    <label class="form-control">
                        <span class="label-text">Usuario</span>
                        <input type="text" name="username" value="{{ old('username') }}" class="input input-bordered" required autofocus>
                        @error('username')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="form-control">
                        <span class="label-text">Contraseña</span>
                        <input type="password" name="password" class="input input-bordered" required>
                        @error('password')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="label cursor-pointer justify-start gap-2">
                        <input type="checkbox" name="remember" value="1" class="checkbox checkbox-sm" />
                        <span class="label-text">Recordarme</span>
                    </label>

                    <button class="btn btn-primary w-full">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
