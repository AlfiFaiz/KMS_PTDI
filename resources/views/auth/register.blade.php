<x-guest-layout>
<div class="relative min-h-screen flex items-center justify-center bg-cover bg-center"  
     style="background-image: url('{{ asset('images/hanggar.png') }}');">

    <!-- Overlay warna gelap -->
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <div class="absolute inset-0 bg-white bg-opacity-40"></div>

        <div class="relative bg-white shadow-lg rounded-lg w-full max-w-3xl p-10">

            <h2 class="text-blue-600 font-bold text-xl mb-2">DAFTAR AKUN</h2>
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Quality and Safety</h1>
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <!-- PILIH ROLE -->
            <div class="flex gap-4 mb-6">
                <button id="btnPelanggan"
                    class="flex-1 bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700">
                    Pelanggan
                </button>

                <button id="btnStaff"
                    class="flex-1 bg-gray-300 text-gray-800 py-2 rounded-lg font-semibold hover:bg-gray-400">
                    Manajemen / Inspektor
                </button>
            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('register') }}" id="registerForm" class="space-y-6"
                enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="role" id="roleInput" value="pelanggan">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Nama -->
                    <div>
                        <x-input-label for="name" value="Nama Lengkap" />
                        <x-text-input id="name" class="w-full mt-1" type="text" name="name" required />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" class="w-full mt-1" type="email" name="email" required />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" value="Password" />
                        <x-text-input id="password" class="w-full mt-1" type="password" name="password" required />
                    </div>

                    <!-- Konfirmasi -->
                    <div>
                        <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                        <x-text-input id="password_confirmation" class="w-full mt-1" type="password"
                            name="password_confirmation" required />
                    </div>

                    <!-- FORM PELANGGAN -->
                    <div class="pelanggan-field">
                        <x-input-label for="company_id" value="Perusahaan" />

                        <select id="company_id" name="company_id" class="w-full mt-1 border rounded-lg p-2">
                            <option value="">-- Pilih Perusahaan --</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}"
                                    {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('company_id')" class="mt-2" />

                    </div>

                    <div class="pelanggan-field">
                        <x-input-label for="position" value="Posisi / Jabatan" />
                        <x-text-input id="position" class="w-full mt-1" type="text" name="position" />
                    </div>

                    <div class="pelanggan-field">
                        <x-input-label for="phone" value="Nomor Telepon" />
                        <x-text-input id="phone" class="w-full mt-1" type="text" name="phone" />
                    </div>
                    <div class="pelanggan-field">
                        <x-input-label for="alamat" value="Alamat" />
                        <textarea id="alamat" name="alamat" rows="2" class="w-full mt-1 border rounded-lg p-2"></textarea>
                    </div>


                    <!-- FORM STAFF -->
                    <div class="staff-field hidden">
                        <x-input-label for="role_detail" value="Daftar Sebagai" />
                        <select name="role_detail" id="role_detail" class="w-full mt-1 border rounded-lg p-2">
                            <option value="manajemen">Manajemen</option>
                            <option value="inspektor">Inspektor</option>
                        </select>
                    </div>

                    <div class="staff-field hidden">
                        <x-input-label for="departemen" value="Departemen" />
                        <x-text-input id="departemen" class="w-full mt-1" type="text" name="departemen" />
                    </div>

                    <div class="staff-field hidden">
                        <x-input-label for="posisi" value="Posisi / Jabatan" />
                        <x-text-input id="posisi" class="w-full mt-1" type="text" name="posisi" />
                    </div>

                    <div class="staff-field hidden">
                        <x-input-label for="nomor_pegawai" value="Nomor Pegawai" />
                        <x-text-input id="nomor_pegawai" class="w-full mt-1" type="text" name="nomor_pegawai" />
                    </div>

                    <div>
                        <x-input-label for="foto" value="Foto Profil" />

                        <input type="file" id="foto" name="foto" accept="image/*"
                            class="w-full mt-1 border rounded-lg p-2" onchange="previewImage(event)">

                        <img id="previewFoto" class="mt-3 w-32 h-32 object-cover rounded-lg border hidden">
                    </div>



                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                    Daftar
                </button>

                <a href="{{ route('login') }}"
                    class="block text-center bg-gray-300 py-2 rounded-lg hover:bg-gray-400">
                    Sudah punya akun? Login
                </a>

            </form>
        </div>
    </div>

    <!-- SCRIPT SWITCH FORM -->
    <script>
        const btnPelanggan = document.getElementById('btnPelanggan');
        const btnStaff = document.getElementById('btnStaff');
        const roleInput = document.getElementById('roleInput');

        const pelangganFields = document.querySelectorAll('.pelanggan-field');
        const staffFields = document.querySelectorAll('.staff-field');

        btnPelanggan.onclick = () => {
            roleInput.value = 'pelanggan';

            btnPelanggan.classList.add('bg-blue-600', 'text-white');
            btnPelanggan.classList.remove('bg-gray-300', 'text-gray-800');

            btnStaff.classList.add('bg-gray-300', 'text-gray-800');
            btnStaff.classList.remove('bg-blue-600', 'text-white');

            pelangganFields.forEach(f => f.classList.remove('hidden'));
            staffFields.forEach(f => f.classList.add('hidden'));
        };

        btnStaff.onclick = () => {
            roleInput.value = 'staff';

            btnStaff.classList.add('bg-blue-600', 'text-white');
            btnStaff.classList.remove('bg-gray-300', 'text-gray-800');

            btnPelanggan.classList.add('bg-gray-300', 'text-gray-800');
            btnPelanggan.classList.remove('bg-blue-600', 'text-white');

            pelangganFields.forEach(f => f.classList.add('hidden'));
            staffFields.forEach(f => f.classList.remove('hidden'));
        };

        btnPelanggan.onclick = () => {
            roleInput.value = 'pelanggan';

            pelangganFields.forEach(f => {
                f.classList.remove('hidden');
                f.querySelectorAll('input, select, textarea').forEach(i => i.disabled = false);
            });

            staffFields.forEach(f => {
                f.classList.add('hidden');
                f.querySelectorAll('input, select, textarea').forEach(i => i.disabled = true);
            });
        };

        btnStaff.onclick = () => {
            roleInput.value = document.getElementById('role_detail').value;


            staffFields.forEach(f => {
                f.classList.remove('hidden');
                f.querySelectorAll('input, select, textarea').forEach(i => i.disabled = false);
            });

            pelangganFields.forEach(f => {
                f.classList.add('hidden');
                f.querySelectorAll('input, select, textarea').forEach(i => i.disabled = true);
            });
        };
    </script>
    <script>
        function previewImage(event) {
            const img = document.getElementById('previewFoto');
            img.src = URL.createObjectURL(event.target.files[0]);
            img.classList.remove('hidden');
        }
    </script>


</x-guest-layout>
