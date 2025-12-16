
<x-guest-layout>

    <div class="relative min-h-screen flex items-center justify-center bg-cover bg-center" 
         style="background-image: url('{{ asset('images/hanggar.png') }}');">
        
        <!-- Overlay -->
        <div class="absolute inset-0 bg-white bg-opacity-40"></div>

        <!-- Card Login -->
        <div class="relative bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
            <h2 class="text-blue-600 font-bold text-lg">LOGIN AKUN</h2>
            <h1 class="text-2xl font-bold text-gray-900">QUALITY AND SAFETY</h1>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Error Global -->
            @if (session('error'))
                <div class="bg-red-500 text-white p-2 rounded-md mt-2 text-sm">
                    {{ session('error') }}
                </div>
            @endif
            

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}" class="mt-4">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" 
                                  type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" 
                                  type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" 
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" 
                               name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Forgot Password -->
                <div class="flex justify-between text-sm mt-2">
                    @if (Route::has('password.request'))
                        <a class="text-blue-500 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Tidak punya akun? Daftar</a>
                </div>

                <!-- Tombol -->
                <div class="mt-6">
                    <button type="submit" 
                            class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700">
                        Login
                    </button>
                    <a href="{{ url('/') }}" 
                       class="w-full block mt-2 bg-green-600 text-white text-center font-semibold py-2 rounded-lg hover:bg-green-700">
                        HOME
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>