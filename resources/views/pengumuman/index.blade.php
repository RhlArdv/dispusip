@extends('layouts.app')

@section('title', 'Manajemen Pengumuman')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold text-gray-900 uppercase tracking-tight">Pengumuman</h1>
            <p class="mt-2 text-sm text-gray-700">Kelola daftar pengumuman, himbauan, dan informasi publik.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('pengumuman.create') }}" class="inline-flex items-center gap-2 bg-sky-500 text-white px-4 py-2.5 rounded-xl hover:bg-sky-600 transition-colors font-medium text-sm shadow-sm shadow-sky-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Pengumuman
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mt-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 font-medium flex items-center gap-3">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="pengumumanTable" class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-4 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">No</th>
                            <th class="px-4 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">Tipe</th>
                            <th class="px-4 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">Judul</th>
                            <th class="px-4 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">Status</th>
                            <th class="px-4 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">Pin</th>
                            <th class="px-4 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm">
                        <!-- DataTables -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
    /* DataTables styling */
    #pengumumanTable_wrapper .dataTables_length,
    #pengumumanTable_wrapper .dataTables_filter {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8125rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }
    #pengumumanTable_wrapper .dataTables_filter {
        justify-content: flex-end;
    }
    #pengumumanTable_wrapper .dataTables_length select {
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
    #pengumumanTable_wrapper .dataTables_length select:focus {
        outline: none;
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
    }
    #pengumumanTable_wrapper .dataTables_filter input {
        padding: 0.35rem 0.75rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 0.8125rem;
        color: #374151;
        width: 200px;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    #pengumumanTable_wrapper .dataTables_filter input:focus {
        outline: none;
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
    }
    #pengumumanTable tbody tr { border-bottom: 1px solid #f9fafb; }
    #pengumumanTable tbody tr:hover td { background: #f0f9ff !important; }
    #pengumumanTable thead tr th { border-bottom: 2px solid #f3f4f6 !important; }

    #pengumumanTable_wrapper .dataTables_info {
        font-size: 0.8125rem;
        color: #6b7280;
        padding-top: 0.75rem;
    }
    #pengumumanTable_wrapper .dataTables_paginate {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.25rem;
        padding-top: 0.75rem;
    }
    #pengumumanTable_wrapper .dataTables_paginate span {
        display: inline-flex;
        gap: 0.25rem;
    }
    #pengumumanTable_wrapper .dataTables_paginate .paginate_button {
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
    #pengumumanTable_wrapper .dataTables_paginate .previous,
    #pengumumanTable_wrapper .dataTables_paginate .next {
        border: 1px solid #e5e7eb !important;
        background: #fff !important;
        margin: 0 0.125rem;
    }
    #pengumumanTable_wrapper .dataTables_paginate .previous:hover:not(.disabled),
    #pengumumanTable_wrapper .dataTables_paginate .next:hover:not(.disabled) {
        border-color: #38bdf8 !important;
        color: #0284c7 !important;
        background: #f0f9ff !important;
    }
    #pengumumanTable_wrapper .dataTables_paginate .previous.disabled,
    #pengumumanTable_wrapper .dataTables_paginate .next.disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }
    #pengumumanTable_wrapper .dataTables_paginate .paginate_button:not(.previous):not(.next):hover:not(.current) {
        background: #f0f9ff !important;
        color: #0284c7 !important;
        border-color: #bae6fd !important;
    }
    #pengumumanTable_wrapper .dataTables_paginate .paginate_button.current,
    #pengumumanTable_wrapper .dataTables_paginate .paginate_button.current:hover {
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
    $(document).ready(function() {
        $('#pengumumanTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('pengumuman.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'tipe', name: 'tipe'},
                {data: 'judul', name: 'judul'},
                {data: 'is_active', name: 'is_active'},
                {data: 'is_pinned', name: 'is_pinned'},
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-right'}
            ],
            language: {
                search: '',
                searchPlaceholder: 'Cari pengumuman...',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ – _END_ dari _TOTAL_ pengumuman',
                infoEmpty: 'Tidak ada data',
                paginate: { previous: '‹', next: '›' },
                processing: '<div class="text-sky-500 text-sm py-4">Memuat data...</div>',
            },
            dom: '<"flex flex-col sm:flex-row justify-between items-center pb-4 gap-4"lf>rt<"flex flex-col sm:flex-row justify-between items-center pt-4 gap-4"ip>',
        });
    });
</script>
@endpush
@endsection
