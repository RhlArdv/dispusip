@extends('layouts.app')

@section('title', 'Kelola Infografis')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Kelola Infografis</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Manajemen banner hero carousel untuk E-Perpus</p>
    </div>
    <a href="{{ route('infografis.create') }}"
       class="flex items-center gap-2 px-4 py-2.5 bg-sky-500 hover:bg-sky-600
              text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-sky-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Infografis
    </a>
</div>
@endsection

@section('content')
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-[13px] text-gray-600">
            <thead class="bg-gray-50/80 text-gray-500 font-medium">
                <tr>
                    <th class="px-6 py-4">Urutan</th>
                    <th class="px-6 py-4">Gambar / Judul</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($infografis as $info)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $info->order }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            @if($info->image)
                            <div class="w-24 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                                <img src="{{ Storage::url($info->image) }}" class="w-full h-full object-cover">
                            </div>
                            @endif
                            <div>
                                <p class="font-medium text-gray-900 line-clamp-1">{{ $info->title }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($info->is_active)
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-600 ring-1 ring-inset ring-emerald-500/10">Aktif</span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-50 text-gray-600 ring-1 ring-inset ring-gray-500/10">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('infografis.edit', $info->id) }}"
                               class="p-2 text-sky-600 hover:bg-sky-50 rounded-lg transition-colors"
                               title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </a>
                            
                            <form action="{{ route('infografis.destroy', $info->id) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus infografis ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium">Belum ada data infografis</p>
                            <p class="text-sm text-gray-400 mt-1">Mulai dengan menambahkan infografis baru</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
