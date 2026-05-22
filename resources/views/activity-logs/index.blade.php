@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Activity Logs')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 space-y-6">

        <div
            class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-200 pb-5">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                    Activity Logs
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Monitoring seluruh rekam jejak aktivitas pengguna pada sistem KMS.
                </p>
            </div>

            <div
                class="bg-white border border-gray-200 rounded-xl px-4 py-2.5 shadow-sm min-w-[140px] flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                    <i class="fa-solid fa-database text-sm"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider leading-none">
                        Total Logs
                    </p>
                    <h3 class="text-lg font-bold text-gray-900 mt-1">
                        {{ number_format($activities->total()) }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200/80 rounded-xl shadow-sm p-4">
            <form method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">

                <div class="relative">
                    <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari aktivitas..."
                        class="w-full h-10 pl-9 pr-4 rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 placeholder:text-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all">
                </div>

                <div class="relative">
                    <select name="user_id"
                        class="w-full h-10 px-3 rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all appearance-none cursor-pointer">
                        <option value="">Semua Pengguna</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>

                <div>
                    <input type="date" name="date" value="{{ request('date') }}"
                        class="w-full h-10 px-3 rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all">
                </div>

                <button type="submit"
                    class="w-full h-10 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-sm shadow-blue-500/10 transition-colors flex items-center justify-center gap-2">
                    <i class="fa-solid fa-sliders text-xs"></i>
                    Filter Logs
                </button>

            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px] table-fixed">
                    <thead
                        class="bg-gray-50/70 text-gray-500 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                        <tr>
                            <th class="p-4 text-left w-1/4">User</th>
                            <th class="p-4 text-left w-5/12">Activity</th>
                            <th class="p-4 text-left w-2/12">Time</th>
                            <th class="p-4 text-center w-1/12">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($activities as $activity)
                            <tr class="hover:bg-gray-50/60 transition-colors">

                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-8 w-8 rounded-full bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center font-bold text-xs shrink-0">
                                            {{ strtoupper(substr($activity->user->name ?? 'S', 0, 1)) }}
                                        </div>
                                        <div class="truncate">
                                            <p class="font-semibold text-gray-800 truncate">
                                                {{ $activity->user->name ?? 'System' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="p-4">
                                    <div class="flex items-start gap-2.5">
                                        <div
                                            class="h-6 w-6 rounded bg-gray-100 text-gray-500 flex items-center justify-center shrink-0 mt-0.5 text-xs">
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                        </div>
                                        <p class="text-xs font-medium text-gray-600 leading-relaxed">
                                            {{ $activity->description }}
                                        </p>
                                    </div>
                                </td>

                                <td class="p-4 whitespace-nowrap">
                                    <p class="text-xs font-semibold text-gray-700">
                                        {{ $activity->created_at->format('d M Y') }}
                                    </p>
                                    <p class="text-[11px] text-gray-400 mt-0.5">
                                        {{ $activity->created_at->format('H:i:s') }}
                                    </p>
                                </td>

                                <td class="p-4 text-center whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded bg-green-50 text-green-700 border border-green-200">
                                        Recorded
                                    </span>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-12 text-center">
                                    <div
                                        class="w-12 h-12 mx-auto rounded-full bg-gray-50 flex items-center justify-center text-gray-400 mb-3">
                                        <i class="fa-solid fa-box-open text-lg"></i>
                                    </div>
                                    <h3 class="text-sm font-bold text-gray-700">Tidak ada aktivitas</h3>
                                    <p class="text-xs text-gray-400 mt-1">Belum ada rekam log data aktivitas pada filter
                                        ini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $activities->withQueryString()->links() }}
        </div>

    </div>
@endsection
