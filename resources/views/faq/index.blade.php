@extends('layouts.app')

@section('title', 'Kelola FAQ')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Kelola FAQ</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Manajemen Pertanyaan yang Sering Ditanyakan</p>
    </div>
    <a href="{{ route('faq.create') }}"
       class="flex items-center gap-2 px-4 py-2.5 bg-sky-500 hover:bg-sky-600
              text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-sky-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah FAQ
    </a>
</div>
@endsection

@section('content')
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <p class="text-[13px] text-gray-500">Daftar semua FAQ yang terdaftar di sistem. Maksimal 5 FAQ akan ditampilkan di halaman utama.</p>
        </div>

        <div class="p-5">
            <table id="tabel-faq" class="w-full text-sm" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3 w-10">#</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Pertanyaan</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Status</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3 w-24">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
    /* DataTables styling */
    #tabel-faq_wrapper .dataTables_length,
    #tabel-faq_wrapper .dataTables_filter {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8125rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }
    #tabel-faq_wrapper .dataTables_filter {
        justify-content: flex-end;
    }
    #tabel-faq_wrapper .dataTables_length select {
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
    #tabel-faq_wrapper .dataTables_length select:focus {
        outline: none;
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
    }
    #tabel-faq_wrapper .dataTables_filter input {
        padding: 0.35rem 0.75rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 0.8125rem;
        color: #374151;
        width: 200px;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    #tabel-faq_wrapper .dataTables_filter input:focus {
        outline: none;
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
    }
    #tabel-faq tbody tr { border-bottom: 1px solid #f9fafb; }
    #tabel-faq tbody tr:hover td { background: #f0f9ff !important; }
    #tabel-faq thead tr th { border-bottom: 2px solid #f3f4f6 !important; }

    #tabel-faq_wrapper .dataTables_info {
        font-size: 0.8125rem;
        color: #6b7280;
        padding-top: 0.75rem;
    }
    #tabel-faq_wrapper .dataTables_paginate {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.25rem;
        padding-top: 0.75rem;
    }
    #tabel-faq_wrapper .dataTables_paginate span {
        display: inline-flex;
        gap: 0.25rem;
    }
    #tabel-faq_wrapper .dataTables_paginate .paginate_button {
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
    #tabel-faq_wrapper .dataTables_paginate .previous,
    #tabel-faq_wrapper .dataTables_paginate .next {
        border: 1px solid #e5e7eb !important;
        background: #fff !important;
        margin: 0 0.125rem;
    }
    #tabel-faq_wrapper .dataTables_paginate .previous:hover:not(.disabled),
    #tabel-faq_wrapper .dataTables_paginate .next:hover:not(.disabled) {
        border-color: #38bdf8 !important;
        color: #0284c7 !important;
        background: #f0f9ff !important;
    }
    #tabel-faq_wrapper .dataTables_paginate .previous.disabled,
    #tabel-faq_wrapper .dataTables_paginate .next.disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }
    #tabel-faq_wrapper .dataTables_paginate .paginate_button:not(.previous):not(.next):hover:not(.current) {
        background: #f0f9ff !important;
        color: #0284c7 !important;
        border-color: #bae6fd !important;
    }
    #tabel-faq_wrapper .dataTables_paginate .paginate_button.current,
    #tabel-faq_wrapper .dataTables_paginate .paginate_button.current:hover {
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    const table = $('#tabel-faq').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('faq.index') }}',
            headers: { 'X-CSRF-TOKEN': csrfToken }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'pertanyaan', name: 'pertanyaan' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        language: {
            search: '',
            searchPlaceholder: 'Cari pertanyaan...',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ – _END_ dari _TOTAL_ faq',
            infoEmpty: 'Tidak ada data',
            paginate: { previous: '‹', next: '›' },
            processing: '<div class="text-sky-500 text-sm py-4">Memuat data...</div>',
        },
        lengthMenu: [10, 25, 50, 100],
        pageLength: 10,
        dom: '<"flex items-center justify-between mb-4 flex-wrap gap-3"lf>rtip',
    });

    function deleteData(url) {
        Swal.fire({
            title: 'Hapus FAQ?',
            text: "FAQ ini akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(url, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Terhapus!', data.message, 'success');
                        table.ajax.reload(null, false);
                    }
                    else Swal.fire('Gagal!', data.message, 'error');
                });
            }
        });
    }
</script>
@endpush
