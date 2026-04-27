@extends('layouts.app')

@section('title', 'Kelola Koleksi')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Kelola Koleksi</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Manajemen koleksi perpustakaan dan referensi</p>
    </div>
    @if(auth()->user()->hasPermission('create_koleksi'))
    <a href="{{ route('koleksi.create') }}"
       class="flex items-center gap-2 px-4 py-2.5 bg-sky-500 hover:bg-sky-600
              text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-sky-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Koleksi
    </a>
    @endif
</div>
@endsection

@section('content')

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <p class="text-[13px] text-gray-500">Daftar semua koleksi yang terdaftar di sistem.</p>
        </div>

        <div class="p-5">
            <table id="tabel-koleksi" class="w-full text-sm" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">#</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Foto</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Judul & Info</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Kategori</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Tanggal</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Aksi</th>
                    </tr>
                </thead>
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
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6h6m2 10H7a2 2 0 01-2 2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="font-bold text-gray-900 mb-1">Hapus Koleksi?</h3>
            <p class="text-sm text-gray-500 mb-6">
                Koleksi <span id="nama-hapus" class="font-semibold text-gray-800"></span> akan dihapus permanen.
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

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
    /* DataTables styling */
    #tabel-koleksi_wrapper .dataTables_length,
    #tabel-koleksi_wrapper .dataTables_filter {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8125rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }
    #tabel-koleksi_wrapper .dataTables_filter {
        justify-content: flex-end;
    }
    #tabel-koleksi_wrapper .dataTables_length select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
        padding: 0.35rem 2rem 0.35rem 0.65rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 0.8125rem;
        color: #374151;
        background-color: #fff;
        cursor: pointer;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    #tabel-koleksi_wrapper .dataTables_length select:focus {
        outline: none;
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
    }
    #tabel-koleksi_wrapper .dataTables_filter input {
        padding: 0.35rem 0.75rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 0.8125rem;
        color: #374151;
        width: 200px;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    #tabel-koleksi_wrapper .dataTables_filter input:focus {
        outline: none;
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
    }
    #tabel-koleksi tbody tr { border-bottom: 1px solid #f9fafb; }
    #tabel-koleksi tbody tr:hover td { background: #f0f9ff !important; }
    #tabel-koleksi thead tr th { border-bottom: 2px solid #f3f4f6 !important; }

    #tabel-koleksi_wrapper .dataTables_info {
        font-size: 0.8125rem;
        color: #6b7280;
        padding-top: 0.75rem;
    }
    #tabel-koleksi_wrapper .dataTables_paginate {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.25rem;
        padding-top: 0.75rem;
    }
    #tabel-koleksi_wrapper .dataTables_paginate span {
        display: inline-flex;
        gap: 0.25rem;
    }
    #tabel-koleksi_wrapper .dataTables_paginate .paginate_button {
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        min-width: 2rem;
        height: 2rem;
        padding: 0 0.5rem !important;
        border-radius: 0.5rem !important;
        font-size: 0.8125rem !important;
        font-weight: 500;
        color: #374151 !important;
        background: transparent !important;
        border: 1px solid transparent !important;
        cursor: pointer;
        transition: all 0.15s;
    }
    #tabel-koleksi_wrapper .dataTables_paginate .previous,
    #tabel-koleksi_wrapper .dataTables_paginate .next {
        border: 1px solid #e5e7eb !important;
        background: #fff !important;
        margin: 0 0.125rem;
    }
    #tabel-koleksi_wrapper .dataTables_paginate .previous:hover:not(.disabled),
    #tabel-koleksi_wrapper .dataTables_paginate .next:hover:not(.disabled) {
        border-color: #38bdf8 !important;
        color: #0284c7 !important;
        background: #f0f9ff !important;
    }
    #tabel-koleksi_wrapper .dataTables_paginate .previous.disabled,
    #tabel-koleksi_wrapper .dataTables_paginate .next.disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }
    #tabel-koleksi_wrapper .dataTables_paginate .paginate_button:not(.previous):not(.next):hover:not(.current) {
        background: #f0f9ff !important;
        color: #0284c7 !important;
        border-color: #bae6fd !important;
    }
    #tabel-koleksi_wrapper .dataTables_paginate .paginate_button.current,
    #tabel-koleksi_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #0ea5e9 !important;
        color: #fff !important;
        border-color: #0ea5e9 !important;
        box-shadow: 0 1px 3px rgba(14, 165, 233, 0.35);
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    let koleksiIdHapus = null;

    const table = $('#tabel-koleksi').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/koleksi',
            headers: { 'X-CSRF-TOKEN': csrfToken }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '50px' },
            { data: 'foto', name: 'foto', orderable: false, searchable: false },
            { data: 'judul', name: 'judul', orderable: false, searchable: false },
            { data: 'kategori', name: 'kategori', orderable: false, searchable: false },
            { data: 'tanggal', name: 'tanggal', orderable: false, searchable: false },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
        ],
        language: {
            search: '',
            searchPlaceholder: 'Cari koleksi...',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ – _END_ dari _TOTAL_ koleksi',
            infoEmpty: 'Tidak ada data',
            paginate: { previous: '‹', next: '›' },
            processing: '<div class="text-sky-500 text-sm py-4">Memuat data...</div>',
        },
        lengthMenu: [10, 25, 50, 100],
        pageLength: 10,
        dom: '<"flex items-center justify-between mb-4 flex-wrap gap-3"lf>rtip',
    });

    function hapusKoleksi(id, judul) {
        koleksiIdHapus = id;
        document.getElementById('nama-hapus').textContent = judul;
        document.getElementById('modal-hapus').classList.remove('hidden');
        document.getElementById('modal-hapus').classList.add('flex');
    }

    document.getElementById('btn-konfirmasi-hapus').addEventListener('click', function () {
        const btn = this;
        btn.textContent = 'Menghapus...';
        btn.disabled = true;

        fetch(`/koleksi/${koleksiIdHapus}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('modal-hapus').classList.add('hidden');
            document.getElementById('modal-hapus').classList.remove('flex');
            if (data.success) {
                tampilToast('success', data.message);
                table.ajax.reload(null, false);
            }
            else tampilToast('error', data.message);
        })
        .catch(() => tampilToast('error', 'Gagal menghapus koleksi.'))
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
