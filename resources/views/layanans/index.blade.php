@extends('layouts.app')

@section('title', 'Kelola Layanan E-Perpus')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Kelola Layanan E-Perpus</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Manajemen layanan yang ditampilkan di halaman E-Perpus</p>
    </div>
    @if(auth()->user()->hasPermission('create_layanan'))
    <a href="{{ route('layanans.create') }}"
       class="flex items-center gap-2 px-4 py-2.5 bg-sky-500 hover:bg-sky-600
              text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-sky-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Layanan
    </a>
    @endif
</div>
@endsection

@section('content')

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-4 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 flex items-center gap-3 px-4 py-3 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- Section Utama (Bento Grid) --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="text-sm font-bold text-gray-900">Layanan Utama (Bento Grid)</h2>
                <p class="text-[12px] text-gray-500 mt-0.5">5 item tetap — hanya bisa diedit URL & teksnya. Tidak bisa ditambah atau dihapus agar tampilan publik tetap terjaga.</p>
            </div>
            <span class="text-[11px] bg-amber-100 text-amber-700 font-semibold px-2.5 py-1 rounded-full">Edit Only</span>
        </div>
        <div class="p-5">
            <table class="w-full text-sm">
                <thead>
                    <tr>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3 w-8">#</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Judul</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">URL</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Tipe</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Status</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($layananUtama as $i => $layanan)
                        <tr class="hover:bg-gray-50/50">
                            <td class="py-3 text-gray-400 text-xs">{{ $i + 1 }}</td>
                            <td class="py-3 font-semibold text-gray-800">{{ $layanan->title }}</td>
                            <td class="py-3 text-gray-500 text-xs max-w-[200px] truncate">{{ $layanan->url }}</td>
                            <td class="py-3">
                                @if($layanan->link_type === 'external')
                                    <span class="inline-flex items-center gap-1 text-[11px] bg-blue-50 text-blue-700 font-semibold px-2 py-0.5 rounded-full">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        Eksternal
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[11px] bg-green-50 text-green-700 font-semibold px-2 py-0.5 rounded-full">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        Internal
                                    </span>
                                @endif
                            </td>
                            <td class="py-3">
                                @if($layanan->is_active)
                                    <span class="text-[11px] bg-green-100 text-green-700 font-semibold px-2 py-0.5 rounded-full">Aktif</span>
                                @else
                                    <span class="text-[11px] bg-gray-100 text-gray-500 font-semibold px-2 py-0.5 rounded-full">Nonaktif</span>
                                @endif
                            </td>
                            <td class="py-3">
                                @if(auth()->user()->hasPermission('edit_layanan'))
                                <a href="{{ route('layanans.edit', $layanan) }}"
                                   class="inline-flex items-center gap-1 text-xs font-medium text-sky-600 hover:text-sky-700 bg-sky-50 hover:bg-sky-100 px-3 py-1.5 rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-8 text-center text-gray-400 text-sm">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Section Sekunder (Layanan Perpustakaan) --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="text-sm font-bold text-gray-900">Layanan Perpustakaan (Grid)</h2>
                <p class="text-[12px] text-gray-500 mt-0.5">Item dinamis — bisa ditambah, diedit, dan dihapus.</p>
            </div>
            <span class="text-[11px] bg-sky-100 text-sky-700 font-semibold px-2.5 py-1 rounded-full">Full CRUD</span>
        </div>
        <div class="p-5">
            <table class="w-full text-sm">
                <thead>
                    <tr>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3 w-8">#</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Judul</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">URL</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Tipe</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Urutan</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Status</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($layananSekunder as $i => $layanan)
                        <tr class="hover:bg-gray-50/50">
                            <td class="py-3 text-gray-400 text-xs">{{ $i + 1 }}</td>
                            <td class="py-3 font-semibold text-gray-800">{{ $layanan->title }}</td>
                            <td class="py-3 text-gray-500 text-xs max-w-[200px] truncate">{{ $layanan->url }}</td>
                            <td class="py-3">
                                @if($layanan->link_type === 'external')
                                    <span class="inline-flex items-center gap-1 text-[11px] bg-blue-50 text-blue-700 font-semibold px-2 py-0.5 rounded-full">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        Eksternal
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[11px] bg-green-50 text-green-700 font-semibold px-2 py-0.5 rounded-full">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        Internal
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 text-gray-500 text-xs">{{ $layanan->order_number }}</td>
                            <td class="py-3">
                                @if($layanan->is_active)
                                    <span class="text-[11px] bg-green-100 text-green-700 font-semibold px-2 py-0.5 rounded-full">Aktif</span>
                                @else
                                    <span class="text-[11px] bg-gray-100 text-gray-500 font-semibold px-2 py-0.5 rounded-full">Nonaktif</span>
                                @endif
                            </td>
                            <td class="py-3">
                                <div class="flex items-center gap-2">
                                    @if(auth()->user()->hasPermission('edit_layanan'))
                                    <a href="{{ route('layanans.edit', $layanan) }}"
                                       class="inline-flex items-center gap-1 text-xs font-medium text-sky-600 hover:text-sky-700 bg-sky-50 hover:bg-sky-100 px-2.5 py-1.5 rounded-lg transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        Edit
                                    </a>
                                    @endif
                                    @if(auth()->user()->hasPermission('delete_layanan'))
                                    <button onclick="confirmDelete({{ $layanan->id }}, '{{ addslashes($layanan->title) }}')"
                                            class="inline-flex items-center gap-1 text-xs font-medium text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded-lg transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="py-8 text-center text-gray-400 text-sm">Belum ada layanan perpustakaan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div id="modal-hapus" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40"
         onclick="if(event.target===this) document.getElementById('modal-hapus').classList.add('hidden')">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm mx-4 p-6 text-center">
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <h3 class="font-bold text-gray-900 mb-1">Hapus Layanan?</h3>
            <p class="text-sm text-gray-500 mb-6">
                Layanan <span id="nama-hapus" class="font-semibold text-gray-800"></span> akan dihapus permanen.
            </p>
            <div class="flex gap-3">
                <button onclick="document.getElementById('modal-hapus').classList.add('hidden')"
                        class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
                    Batal
                </button>
                <form id="form-hapus" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-full px-4 py-2 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-xl transition-colors">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function confirmDelete(id, nama) {
        document.getElementById('nama-hapus').textContent = nama;
        document.getElementById('form-hapus').action = '/menu/layanans/' + id;
        const modal = document.getElementById('modal-hapus');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
</script>
@endpush
