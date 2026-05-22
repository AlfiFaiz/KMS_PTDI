<x-guest-layout>
    <div class="relative min-h-screen flex items-center justify-center bg-cover bg-center px-4 sm:px-6 py-12 selection:bg-blue-500 selection:text-white"
        style="background-image: url('{{ asset('images/hanggar.png') }}');">

        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        <div
            class="relative w-full max-w-md bg-white shadow-2xl rounded-2xl border border-gray-100 p-8 sm:p-10 transform transition-all duration-300 hover:shadow-blue-900/20">

            <div class="text-center mb-7">
                <div
                    class="inline-flex items-center justify-center w-40 h-16 bg-slate-50 rounded-xl border border-slate-100 p-2 shadow-sm ring-4 ring-slate-50 mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo KMS" class="w-full h-full object-contain"
                        onerror="this.onerror=null; this.src='https://placehold.co/300x120/f8fafc/1e3a8a?text=KMS+LOGS';">
                </div>

                <div>
                    <span
                        class="inline-block text-[10px] font-bold text-blue-600 uppercase tracking-[0.25em] bg-blue-50 px-3 py-1 rounded-full mb-3">
                        System Portal
                    </span>
                    <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Login Akun</h2>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight mt-1">Quality & Safety KMS</h1>
                </div>
            </div>

            <x-auth-session-status
                class="mb-4 text-sm font-medium text-green-600 bg-green-50 p-3 rounded-xl border border-green-100"
                :status="session('status')" />

            @if (session('error'))
                <div
                    class="bg-red-50 border border-red-100 text-red-600 p-3 rounded-xl mb-4 text-sm font-medium flex items-center space-x-2">
                    <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email"
                        class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Email Address
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">

                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus autocomplete="username"
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 focus:outline-none transition-all duration-200"
                            placeholder="name@company.com" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-500 font-medium" />
                </div>

                <div>
                    <label for="password"
                        class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Password
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">

                        </span>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 focus:outline-none transition-all duration-200"
                            placeholder="••••••••" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-500 font-medium" />
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500/30 focus:ring-offset-0 cursor-pointer">
                        <span class="ms-2 font-semibold text-slate-600 hover:text-slate-800 transition-colors">
                            {{ __('Remember me') }}
                        </span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="font-bold text-blue-600 hover:text-blue-700 hover:underline transition-colors"
                            href="{{ route('password.request') }}">
                            {{ __('Lupa Password?') }}
                        </a>
                    @endif
                </div>

                <div class="space-y-3 pt-3">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-700 to-blue-600 text-white font-bold text-xs uppercase tracking-widest py-3 rounded-xl shadow-lg shadow-blue-600/20 hover:from-blue-600 hover:to-blue-500 hover:scale-[1.01] active:scale-[0.99] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                        Sign In Portal
                    </button>

                    <a href="{{ url('/') }}"
                        class="block w-full text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs uppercase tracking-widest py-3 rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-slate-300">
                        <i class="fa-solid fa-arrow-left text-[10px] me-1.5"></i> Kembali ke Home
                    </a>
                </div>

                <div class="text-center pt-4 border-t border-slate-100 text-xs font-medium text-slate-500">
                    Belum memiliki akses?
                    <a href="{{ route('register') }}"
                        class="font-bold text-blue-600 hover:text-blue-700 hover:underline transition-colors ms-1">
                        Hubungi Admin / Daftar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
