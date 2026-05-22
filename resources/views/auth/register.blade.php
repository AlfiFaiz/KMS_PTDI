<x-guest-layout>
    <div class="relative min-h-screen flex items-center justify-center bg-cover bg-center px-4 sm:px-6 py-12 selection:bg-blue-500 selection:text-white"
        style="background-image: url('{{ asset('images/hanggar.png') }}');">

        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        <div
            class="relative w-full max-w-3xl bg-white shadow-2xl rounded-2xl border border-gray-100 p-8 sm:p-10 transform transition-all duration-300">

            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center w-40 h-16 bg-slate-50 rounded-xl border border-slate-100 p-2 shadow-sm ring-4 ring-slate-50 mb-5">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo KMS" class="w-full h-full object-contain"
                        onerror="this.onerror=null; this.src='https://placehold.co/300x120/f8fafc/1e3a8a?text=KMS+LOGS';">
                </div>

                <div>
                    <span
                        class="inline-block text-[10px] font-bold text-blue-600 uppercase tracking-[0.25em] bg-blue-50 px-3 py-1 rounded-full mb-3">
                        Registration Portal
                    </span>
                    <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Daftar Akun Baru</h2>
                    <h1 class="text-3xl font-black text-slate-800 tracking-tight mt-1">Quality & Safety KMS</h1>
                </div>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-100 text-red-600 p-4 rounded-xl mb-8 text-sm">
                    <div class="flex items-center space-x-2 font-bold mb-1">
                        <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                        <span>Periksa kembali inputan Anda:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-0.5 pl-2 font-medium opacity-90">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="p-1.5 bg-slate-100 rounded-xl flex gap-2 mb-8">
                <button id="btnPelanggan" type="button"
                    class="flex-1 bg-white text-blue-600 py-2.5 px-4 rounded-lg text-xs font-bold uppercase tracking-wider shadow-sm transition-all duration-200 focus:outline-none">
                    <i class="fa-solid fa-user-tie me-1.5 text-sm"></i> Pelanggan
                </button>

                <button id="btnStaff" type="button"
                    class="flex-1 text-slate-600 py-2.5 px-4 rounded-lg text-xs font-bold uppercase tracking-wider hover:text-slate-800 transition-all duration-200 focus:outline-none">
                    <i class="fa-solid fa-shield-halved me-1.5 text-sm"></i> Manajemen / Inspektor
                </button>
            </div>

            <form method="POST" action="{{ route('register') }}" id="registerForm" class="space-y-6"
                enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="role" id="roleInput" value="pelanggan">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">

                    <div>
                        <label for="name"
                            class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Nama Lengkap
                        </label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required
                            autofocus
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 focus:outline-none transition-all duration-200"
                            placeholder="Nama Lengkap Anda" />
                    </div>

                    <div>
                        <label for="email"
                            class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Email Resmi
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 focus:outline-none transition-all duration-200"
                            placeholder="name@company.com" />
                    </div>

                    <div>
                        <label for="password"
                            class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Password
                        </label>
                        <input id="password" type="password" name="password" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 focus:outline-none transition-all duration-200"
                            placeholder="••••••••" />
                    </div>

                    <div>
                        <label for="password_confirmation"
                            class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Konfirmasi Password
                        </label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 focus:outline-none transition-all duration-200"
                            placeholder="••••••••" />
                    </div>

                    <div class="pelanggan-field">
                        <label for="company_id"
                            class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Perusahaan
                        </label>
                        <select id="company_id" name="company_id"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 focus:outline-none transition-all duration-200">
                            <option value="">-- Pilih Perusahaan --</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}"
                                    {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="pelanggan-field">
                        <label for="position"
                            class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Posisi / Jabatan
                        </label>
                        <input id="position" type="text" name="position" value="{{ old('position') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 focus:outline-none transition-all duration-200"
                            placeholder="Contoh: Manager Operasional" />
                    </div>

                    <div class="pelanggan-field">
                        <label for="phone"
                            class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Nomor Telepon
                        </label>
                        <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 focus:outline-none transition-all duration-200"
                            placeholder="0812xxxxxxx" />
                    </div>

                    <div class="pelanggan-field">
                        <label for="alamat"
                            class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Alamat Instansi
                        </label>
                        <textarea id="alamat" name="alamat" rows="1"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 focus:outline-none transition-all duration-200"
                            placeholder="Alamat lengkap instansi/perusahaan"></textarea>
                    </div>

                    <div class="staff-field hidden">
                        <label for="role_detail"
                            class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Daftar Sebagai
                        </label>
                        <select name="role_detail" id="role_detail"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 focus:outline-none transition-all duration-200">
                            <option value="manajemen">Manajemen</option>
                            <option value="inspektor">Inspektor</option>
                        </select>
                    </div>

                    <div class="staff-field hidden">
                        <label for="departemen"
                            class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Departemen
                        </label>
                        <input id="departemen" type="text" name="departemen" value="{{ old('departemen') }}"
                            disabled
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 focus:outline-none transition-all duration-200"
                            placeholder="Contoh: Quality Assurance" />
                    </div>

                    <div class="staff-field hidden">
                        <label for="posisi"
                            class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Posisi / Jabatan Staff
                        </label>
                        <input id="posisi" type="text" name="posisi" value="{{ old('posisi') }}" disabled
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 focus:outline-none transition-all duration-200"
                            placeholder="Contoh: Auditor Utama" />
                    </div>

                    <div class="staff-field hidden">
                        <label for="nomor_pegawai"
                            class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Nomor Pegawai (NIP)
                        </label>
                        <input id="nomor_pegawai" type="text" name="nomor_pegawai"
                            value="{{ old('nomor_pegawai') }}" disabled
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 focus:outline-none transition-all duration-200"
                            placeholder="Contoh: KMS-2026xxx" />
                    </div>

                    <div
                        class="md:col-span-2 grid grid-cols-1 sm:grid-cols-3 gap-6 items-center p-5 bg-slate-50 rounded-xl border border-slate-100 mt-4">
                        <div class="sm:col-span-2">
                            <label for="foto"
                                class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Unggah Foto Profil
                            </label>
                            <p class="text-[11px] text-slate-400 mb-3">Gunakan format persegi (JPG/PNG) maks 2MB.</p>
                            <input type="file" id="foto" name="foto" accept="image/*"
                                onchange="previewImage(event)"
                                class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                        </div>
                        <div class="flex justify-center sm:justify-end">
                            <img id="previewFoto"
                                class="w-24 h-24 object-cover rounded-xl border-2 border-white shadow-md hidden"
                                alt="Preview Foto">
                        </div>
                    </div>

                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-6 border-t border-slate-100 mt-6">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-700 to-blue-600 text-white font-bold text-xs uppercase tracking-widest py-3.5 rounded-xl shadow-lg shadow-blue-600/20 hover:from-blue-600 hover:to-blue-500 hover:scale-[1.01] active:scale-[0.99] transition-all duration-200 focus:outline-none">
                        Daftarkan Akun
                    </button>

                    <a href="{{ route('login') }}"
                        class="block w-full text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs uppercase tracking-widest py-3.5 rounded-xl transition-all duration-200">
                        Sudah punya akun? Login
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btnPelanggan = document.getElementById('btnPelanggan');
            const btnStaff = document.getElementById('btnStaff');
            const roleInput = document.getElementById('roleInput');
            const roleDetail = document.getElementById('role_detail');

            const pelangganFields = document.querySelectorAll('.pelanggan-field');
            const staffFields = document.querySelectorAll('.staff-field');

            btnPelanggan.addEventListener('click', () => {
                roleInput.value = 'pelanggan';
                btnPelanggan.className =
                    "flex-1 bg-white text-blue-600 py-2.5 px-4 rounded-lg text-xs font-bold uppercase tracking-wider shadow-sm transition-all duration-200 focus:outline-none";
                btnStaff.className =
                    "flex-1 text-slate-600 py-2.5 px-4 rounded-lg text-xs font-bold uppercase tracking-wider hover:text-slate-800 transition-all duration-200 focus:outline-none";

                pelangganFields.forEach(f => {
                    f.classList.remove('hidden');
                    f.querySelectorAll('input, select, textarea').forEach(i => i.disabled = false);
                });
                staffFields.forEach(f => {
                    f.classList.add('hidden');
                    f.querySelectorAll('input, select, textarea').forEach(i => i.disabled = true);
                });
            });

            btnStaff.addEventListener('click', () => {
                roleInput.value = roleDetail.value;
                btnStaff.className =
                    "flex-1 bg-white text-blue-600 py-2.5 px-4 rounded-lg text-xs font-bold uppercase tracking-wider shadow-sm transition-all duration-200 focus:outline-none";
                btnPelanggan.className =
                    "flex-1 text-slate-600 py-2.5 px-4 rounded-lg text-xs font-bold uppercase tracking-wider hover:text-slate-800 transition-all duration-200 focus:outline-none";

                staffFields.forEach(f => {
                    f.classList.remove('hidden');
                    f.querySelectorAll('input, select, textarea').forEach(i => i.disabled = false);
                });
                pelangganFields.forEach(f => {
                    f.classList.add('hidden');
                    f.querySelectorAll('input, select, textarea').forEach(i => i.disabled = true);
                });
            });

            roleDetail.addEventListener('change', () => {
                if (roleInput.value !== 'pelanggan') {
                    roleInput.value = roleDetail.value;
                }
            });
        });

        function previewImage(event) {
            const img = document.getElementById('previewFoto');
            if (event.target.files.length > 0) {
                img.src = URL.createObjectURL(event.target.files[0]);
                img.classList.remove('hidden');
            }
        }
    </script>
</x-guest-layout>
