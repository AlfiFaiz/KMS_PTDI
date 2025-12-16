@extends('layouts.' . auth()->user()->role)

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-extrabold mb-6 text-gray-800 flex items-center">
            <i class="fa-solid fa-bell text-yellow-500 mr-3"></i> Notifikasi
        </h1>

        <div class="space-y-4">
            @forelse ($notifications as $notif)
                <div class="bg-white shadow-md rounded-lg p-4 flex justify-between items-center hover:bg-gray-50 transition">
                    <div>
                        <p class="text-gray-700 font-medium">
                            {{ $notif->message }}
                        </p>
                        <span class="text-xs text-gray-500">
                            {{ $notif->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <div>
                        @if (!$notif->read_at)
                            <form action="{{ route('notifications.read', $notif->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button
                                    class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                    Tandai dibaca
                                </button>
                            </form>
                        @else
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">
                                Sudah dibaca
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 p-4 rounded">
                    Belum ada notifikasi.
                </div>
            @endforelse
        </div>
    </div>
@endsection
