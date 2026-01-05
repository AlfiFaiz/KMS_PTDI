@extends('layouts.pelanggan')

@section('title', 'Informasi')

@section('content')
<div class="bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('images/hanggar.png') }}'); background-attachment: fixed;">
    <div class="min-h-screen py-16" style="background-color: rgba(0, 0, 0, 0.7);">
        <br>
        <div class="container mx-auto px-4 lg:px-20">
            <div class="mb-12" style="max-width: 700px; margin-left: auto; margin-right: auto; text-align: center;">
                <h1 style="color: #ffffff; font-size: 3rem; font-weight: 900; text-transform: uppercase; letter-spacing: -1px; line-height: 1; margin-bottom: 8px;">
                    Informasi <span style="color: #3b82f6;">Terbaru</span>
                </h1>
                <div style="width: 60px; height: 5px; background-color: #3b82f6; margin: 0 auto 15px auto; border-radius: 10px;"></div>
                <p style="color: #94a3b8; font-weight: 600; font-size: 14px; letter-spacing: 3px; text-transform: uppercase;">
                    Updates & Announcements
                </p>
            </div>
            <br>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($infos as $info)
                    <div class="rounded-2xl overflow-hidden shadow-2xl cursor-pointer transition-transform hover:scale-105"
                         style="background-color: #0f172a; border: 1px solid rgba(255,255,255,0.1); display: flex; flex-direction: column;"
                         onclick="openModal({{ $info->id }})">
                        
                        <div style="width: 100%; height: 240px; background-color: #ffffff; display: flex; align-items: center; justify-content: center; padding: 10px;">
                            @if($info->image_path)
                                <img src="{{ asset('storage/' . $info->image_path) }}" 
                                     style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            @else
                                <div style="text-align: center; color: #cbd5e1;">
                                    <i class="fa-solid fa-newspaper" style="font-size: 40px;"></i>
                                    <p style="font-size: 10px; margin-top: 5px;">NO IMAGE</p>
                                </div>
                            @endif
                        </div>

                        <div class="p-6" style="background-color: #0f172a;">
                            <span style="color: #3b82f6; font-size: 12px; font-weight: bold; letter-spacing: 1px;">
                                {{ $info->created_at->format('d M Y') }}
                            </span>
                            <h2 class="text-xl font-bold text-white mt-2 mb-3 uppercase leading-tight" style="color: #ffffff;">
                                {{ $info->title }}
                            </h2>
                            <div style="color: #94a3b8; font-size: 14px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-style: italic;">
                                {!! strip_tags($info->content) !!}
                            </div>
                        </div>
                    </div>

                    <div id="modal-{{ $info->id }}" 
                         class="fixed inset-0 hidden items-center justify-center z-[100] p-4" 
                         style="background-color: rgba(0, 0, 0, 0.9); backdrop-filter: blur(8px);">
                        
                        <div class="rounded-3xl shadow-2xl overflow-hidden flex flex-col" 
                             style="background-color: #0f172a; width: 100%; max-width: 700px; border: 1px solid rgba(255,255,255,0.2); max-height: 90vh;">
                            
                            <div class="p-4 flex justify-between items-center" style="background-color: rgba(0,0,0,0.3); border-bottom: 1px solid rgba(255,255,255,0.1);">
                                <span style="color: #60a5fa; font-weight: bold; font-size: 12px; letter-spacing: 2px;">DETAIL INFORMASI</span>
                                <button onclick="closeModal({{ $info->id }})" style="color: #ffffff; font-size: 24px; cursor: pointer;">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </button>
                            </div>

                            <div style="overflow-y: auto;">
                                @if($info->image_path)
                                    <div style="background-color: #ffffff; width: 100%; display: flex; justify-content: center; padding: 20px;">
                                        <img src="{{ asset('storage/' . $info->image_path) }}" 
                                             style="max-width: 100%; height: auto; max-height: 350px; border-radius: 10px;">
                                    </div>
                                @endif

                                <div class="p-8">
                                    <h2 style="color: #ffffff; font-size: 28px; font-weight: 900; text-transform: uppercase; margin-bottom: 10px;">
                                        {{ $info->title }}
                                    </h2>
                                    <p style="color: #64748b; font-size: 14px; margin-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 10px;">
                                        Dipublikasikan pada: {{ $info->created_at->format('d F Y') }}
                                    </p>
                                    
                                    <div style="color: #e2e8f0; font-size: 16px; line-height: 1.6;">
                                        {!! $info->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(id) {
        const modal = document.getElementById('modal-' + id);
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    function closeModal(id) {
        const modal = document.getElementById('modal-' + id);
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
</script>
@endsection