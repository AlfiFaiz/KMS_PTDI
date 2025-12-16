<table class="table-auto w-full text-gray-700">
    <tr>
        <td class="font-semibold w-40">Perusahaan</td>
        <td>{{ $user->pelanggan->company->name }}</td>
    </tr>
    <tr>
        <td class="font-semibold">Alamat</td>
        <td>{{ $user->pelanggan->alamat }}</td>
    </tr>
    <tr>
        <td class="font-semibold">No HP</td>
        <td>{{ $user->pelanggan->phone }}</td>
    </tr>
    <tr>
        <td class="font-semibold">Jabatan</td>
        <td>{{ $user->pelanggan->position }}</td>
    </tr>
</table>
