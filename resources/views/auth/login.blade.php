<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión - Administración</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-gray-800 antialiased font-sans flex flex-col items-center justify-center min-h-screen py-10 px-4">

    <div class="max-w-md w-full bg-white rounded-xl shadow-2xl overflow-hidden border-t-4 border-red-600">
        
        <div class="bg-red-600 p-8 text-center relative">
            <h2 class="text-2xl font-bold text-white uppercase tracking-wider">Administración</h2>
            <p class="text-white mt-2 font-medium text-sm">CT Olof Palme</p>
        </div>

        <div class="p-8">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-bold text-gray-600 uppercase mb-1">Correo Electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-600 focus:ring focus:ring-red-600 focus:ring-opacity-50 py-2.5 px-4 border text-gray-700">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs font-semibold" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-gray-600 uppercase mb-1">Contraseña</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-600 focus:ring focus:ring-red-600 focus:ring-opacity-50 py-2.5 px-4 border text-gray-700">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs font-semibold" />
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-600" name="remember">
                        <span class="ms-2 text-sm text-gray-600 font-medium">Recordar sesión</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-red-600 hover:text-black font-semibold transition-colors" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-lg shadow-md text-base font-bold text-white bg-red-600 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 transition-colors">
                        Iniciar Sesión
                    </button>
                </div>
            </form>
        </div>
        
        <div class="bg-gray-50 p-4 text-center border-t border-gray-100">
            <a href="{{ route('welcome') }}" class="text-sm font-medium text-gray-500 hover:text-red-600 transition-colors">
                ← Volver al formulario de registro
            </a>
        </div>
    </div>

</body>
</html>