@extends('layouts.app')

@section('title', 'Kelola Pejabat')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Kelola Pejabat</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Manajemen data pimpinan dan pejabat instansi</p>
    </div>
    <a href="{{ route('admin.pejabat.create') }}"
       class="flex items-center gap-2 px-4 py-2.5 bg-sky-500 hover:bg-sky-600
              text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-sky-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Pejabat
    </a>
</div>
@endsection

@section('content')

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <p class="text-[13px] text-gray-500">Daftar pejabat diurutkan berdasarkan nomor urut. Kepala Dinas isi nomor urut 1 agar tampil paling atas.</p>
        </div>

        <div class="p-5">
            <table id="tabel-pejabat" class="w-full text-sm" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">#</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Foto</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Nama & Jabatan</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">NIP</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Urut</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Status</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pejabats as $i => $pejabat)
                    <tr class="border-b border-gray-50 hover:bg-sky-50/40">
                        <td class="py-3 text-gray-500">{{ $i + 1 }}</td>
                        <td class="py-3">
                            @if($pejabat->image)
                                <img src="{{ asset('storage/' . $pejabat->image) }}"
                                     class="w-12 h-12 rounded-xl object-cover border border-gray-100">
                            @else
                                <div class="w-12 h-12 rounded-xl bg-navy-100 flex items-center justify-center text-navy-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="py-3">
                            <p class="font-semibold text-gray-900">{{ $pejabat->nama }}</p>
                            <p class="text-xs text-gray-500">{{ $pejabat->jabatan }}</p>
                        </td>
                        <td class="py-3 text-gray-600 text-xs">{{ $pejabat->nip ?? '-' }}</td>
                        <td class="py-3">
                            <span class="px-2 py-1 rounded-lg bg-gray-100 text-gray-600 text-xs font-bold">{{ $pejabat->order_no }}</span>
                        </td>
                        <td class="py-3">
                            @if($pejabat->is_active)
                                <span class="px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">Aktif</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-500 text-xs font-semibold">Nonaktif</span>
                            @endif
                        </td>
                        <td class="py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.pejabat.edit', $pejabat) }}"
                                   class="p-1.5 text-sky-600 hover:bg-sky-100 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <button onclick="hapusPejabat({{ $pejabat->id }}, '{{ addslashes($pejabat->nama) }}')"
                                        class="p-1.5 text-red-500 hover:bg-red-100 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div id="modal-hapus"
         class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40"
         onclick="if(event.target===this) document.getElementById('modal-hapus').classList.add('hidden')">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm mx-4 p-6 text-center">
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <h3 class="font-bold text-gray-900 mb-1">Hapus Pejabat?</h3>
            <p class="text-sm text-gray-500 mb-6">
                Data <span id="nama-hapus" class="font-semibold text-gray-800"></span> akan dihapus permanen.
            </p>
            <div class="flex gap-3">
                <button onclick="document.getElementById('modal-hapus').classList.add('hidden')"
                        class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100
                               hover:bg-gray-200 rounded-xl transition-colors">
                    Batal
                </button>
                <button id="btn-konfirmasi-hapus"
                        class="flex-1 px-4 py-2 text-sm font-semibold text-white bg-red-600
                               hover:bg-red-700 rounded-xl transition-colors">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    let pejabatIdHapus = null;

    function hapusPejabat(id, nama) {
        pejabatIdHapus = id;
        document.getElementById('nama-hapus').textContent = nama;
        document.getElementById('modal-hapus').classList.remove('hidden');
        document.getElementById('modal-hapus').classList.add('flex');
    }

    document.getElementById('btn-konfirmasi-hapus').addEventListener('click', function () {
        const btn = this;
        btn.textContent = 'Menghapus...';
        btn.disabled = true;

        fetch(`/menu/pejabat/${pejabatIdHapus}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('modal-hapus').classList.add('hidden');
            document.getElementById('modal-hapus').classList.remove('flex');
            tampilToast('success', data.message);
            setTimeout(() => location.reload(), 1000);
        })
        .catch(() => tampilToast('error', 'Gagal menghapus data.'))
        .finally(() => {
            btn.textContent = 'Ya, Hapus';
            btn.disabled = false;
        });
    });

    function tampilToast(tipe, pesan) {
        const warna = tipe === 'success'
            ? 'bg-green-50 border-green-200 text-green-800'
            : 'bg-red-50 border-red-200 text-red-800';
        const toast = document.createElement('div');
        toast.className = `fixed bottom-6 right-6 z-[99999] flex items-center gap-2 px-4 py-3
                           rounded-xl border shadow-lg text-sm font-medium max-w-sm ${warna}`;
        toast.textContent = pesan;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 4000);
    }
</script>
@endpush
