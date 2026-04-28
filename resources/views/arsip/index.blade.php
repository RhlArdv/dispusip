@extends('layouts.app')

@section('title', 'Kelola Arsip')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Kelola Arsip</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Manajemen data arsip dan dokumen</p>
    </div>
    @if(auth()->user()->hasPermission('create_arsip'))
    <a href="{{ route('arsip.create') }}"
       class="flex items-center gap-2 px-4 py-2.5 bg-sky-500 hover:bg-sky-600
              text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-sky-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Arsip
    </a>
    @endif
</div>
@endsection

@section('content')

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <p class="text-[13px] text-gray-500">Daftar semua arsip yang terdaftar di sistem.</p>
        </div>

        <div class="p-5">
            <table id="tabel-arsip" class="w-full text-sm" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">#</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Indeks</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Deskripsi</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Tahun</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Jumlah</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Lokasi</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Klasifikasi</th>
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
            <h3 class="font-bold text-gray-900 mb-1">Hapus Arsip?</h3>
            <p class="text-sm text-gray-500 mb-6">
                Arsip <span id="nama-hapus" class="font-semibold text-gray-800"></span> akan dihapus permanen.
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
    #tabel-arsip_wrapper .dataTables_length,
    #tabel-arsip_wrapper .dataTables_filter {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8125rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }
    #tabel-arsip_wrapper .dataTables_filter {
        justify-content: flex-end;
    }
    #tabel-arsip_wrapper .dataTables_length select {
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
    #tabel-arsip_wrapper .dataTables_length select:focus {
        outline: none;
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
    }
    #tabel-arsip_wrapper .dataTables_filter input {
        padding: 0.35rem 0.75rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 0.8125rem;
        color: #374151;
        width: 200px;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    #tabel-arsip_wrapper .dataTables_filter input:focus {
        outline: none;
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
    }
    #tabel-arsip tbody tr { border-bottom: 1px solid #f9fafb; }
    #tabel-arsip tbody tr:hover td { background: #f0f9ff !important; }
    #tabel-arsip thead tr th { border-bottom: 2px solid #f3f4f6 !important; }

    #tabel-arsip_wrapper .dataTables_info {
        font-size: 0.8125rem;
        color: #6b7280;
        padding-top: 0.75rem;
    }
    #tabel-arsip_wrapper .dataTables_paginate {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.25rem;
        padding-top: 0.75rem;
    }
    #tabel-arsip_wrapper .dataTables_paginate span {
        display: inline-flex;
        gap: 0.25rem;
    }
    #tabel-arsip_wrapper .dataTables_paginate .paginate_button {
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
    #tabel-arsip_wrapper .dataTables_paginate .previous,
    #tabel-arsip_wrapper .dataTables_paginate .next {
        border: 1px solid #e5e7eb !important;
        background: #fff !important;
        margin: 0 0.125rem;
    }
    #tabel-arsip_wrapper .dataTables_paginate .previous:hover:not(.disabled),
    #tabel-arsip_wrapper .dataTables_paginate .next:hover:not(.disabled) {
        border-color: #38bdf8 !important;
        color: #0284c7 !important;
        background: #f0f9ff !important;
    }
    #tabel-arsip_wrapper .dataTables_paginate .previous.disabled,
    #tabel-arsip_wrapper .dataTables_paginate .next.disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }
    #tabel-arsip_wrapper .dataTables_paginate .paginate_button:not(.previous):not(.next):hover:not(.current) {
        background: #f0f9ff !important;
        color: #0284c7 !important;
        border-color: #bae6fd !important;
    }
    #tabel-arsip_wrapper .dataTables_paginate .paginate_button.current,
    #tabel-arsip_wrapper .dataTables_paginate .paginate_button.current:hover {
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
    let arsipIdHapus = null;

    const table = $('#tabel-arsip').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('arsip.index') }}',
            headers: { 'X-CSRF-TOKEN': csrfToken }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '50px' },
            { data: 'indeks_badge', name: 'indeks_badge', orderable: false, searchable: false },
            { data: 'deskripsi', name: 'deskripsi' },
            { data: 'tahun_badge', name: 'tahun_badge', orderable: false, searchable: false },
            { data: 'jumlah_badge', name: 'jumlah_badge', orderable: false, searchable: false },
            { data: 'lokasi', name: 'lokasi', orderable: false, searchable: false },
            {
                data: null,
                render: (data) => {
                    const badges = [data.tingkat_badge, data.bentuk_badge, data.keterangan_badge].filter(b => b);
                    if (badges.length === 0) return '<span class="text-xs text-gray-400">—</span>';
                    return `<div class="flex flex-wrap gap-1">${badges.join('')}</div>`;
                }
            },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
        ],
        language: {
            search: '',
            searchPlaceholder: 'Cari arsip...',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ – _END_ dari _TOTAL_ arsip',
            infoEmpty: 'Tidak ada data',
            paginate: { previous: '‹', next: '›' },
            processing: '<div class="text-sky-500 text-sm py-4">Memuat data...</div>',
        },
        lengthMenu: [10, 25, 50, 100],
        pageLength: 10,
        dom: '<"flex items-center justify-between mb-4 flex-wrap gap-3"lf>rtip',
    });

    function hapusArsip(id, indeks) {
        arsipIdHapus = id;
        document.getElementById('nama-hapus').textContent = indeks;
        document.getElementById('modal-hapus').classList.remove('hidden');
        document.getElementById('modal-hapus').classList.add('flex');
    }

    document.getElementById('btn-konfirmasi-hapus').addEventListener('click', function () {
        const btn = this;
        btn.textContent = 'Menghapus...';
        btn.disabled = true;

        fetch(`/menu/arsip/${arsipIdHapus}`, {
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
        .catch(() => tampilToast('error', 'Gagal menghapus arsip.'))
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
