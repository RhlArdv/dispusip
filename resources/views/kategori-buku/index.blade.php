@extends('layouts.app')

@section('title', 'Kategori Buku')

@section('content')
<div class="p-6 lg:p-8">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Kategori Buku</h1>
            <p class="text-sm text-gray-500 mt-0.5">Kelola kategori untuk koleksi buku</p>
        </div>
        <a href="{{ route('kategori-buku.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white
                  text-sm font-medium rounded-xl transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Kategori
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Deskripsi
                        </th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Urutan
                        </th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Jumlah Buku
                        </th>
                        <th class="px-6 py-3.5 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($kategoriBuku as $kategori)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-50 to-teal-50
                                            flex items-center justify-center">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $kategori->nama }}</div>
                                    <div class="text-xs text-gray-400">{{ $kategori->slug }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-600 max-w-xs">
                                {{ Str::limit($kategori->deskripsi ?? '-', 80) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg
                                         bg-gray-100 text-gray-700 text-sm font-medium">
                                {{ $kategori->urutan }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($kategori->is_active)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold
                                             text-emerald-700 bg-emerald-50 border border-emerald-100 rounded-full">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold
                                             text-gray-700 bg-gray-50 border border-gray-100 rounded-full">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center px-2.5 py-1 text-xs font-semibold
                                         bg-indigo-50 text-indigo-700 rounded-lg">
                                {{ $kategori->buku()->count() }} buku
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('kategori-buku.edit', $kategori) }}"
                                   class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors"
                                   title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('kategori-buku.destroy', $kategori) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kategori \"{{ $kategori->nama }}\"?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                            title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                <div class="text-gray-500 font-medium">Belum ada kategori buku</div>
                                <div class="text-sm text-gray-400 mt-1">Mulai dengan menambahkan kategori baru</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
