@extends('layouts.app')

@section('title', 'Kelola Link Access')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Kelola Link Access</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Manajemen link akses cepat untuk halaman publik</p>
    </div>
    @if(auth()->user()->hasPermission('create_link_access'))
    <a href="{{ route('link-access.create') }}"
       class="flex items-center gap-2 px-4 py-2.5 bg-sky-500 hover:bg-sky-600
              text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-sky-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Link
    </a>
    @endif
</div>
@endsection

@section('content')

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <p class="text-[13px] text-gray-500">Daftar semua link akses cepat yang akan ditampilkan di halaman publik.</p>
        </div>

        <div class="p-5">
            <table id="tabel-link-access" class="w-full text-sm" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">#</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Icon</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Judul & Status</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">URL</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Penulis</th>
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
            <h3 class="font-bold text-gray-900 mb-1">Hapus Link?</h3>
            <p class="text-sm text-gray-500 mb-6">
                Link <span id="nama-hapus" class="font-semibold text-gray-800"></span> akan dihapus permanen.
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
    #tabel-link-access_wrapper .dataTables_length,
    #tabel-link-access_wrapper .dataTables_filter {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8125rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }
    #tabel-link-access_wrapper .dataTables_filter {
        justify-content: flex-end;
    }
    #tabel-link-access_wrapper .dataTables_length select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
        padding: 0.35rem 2rem 0.35rem 0.65rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 0.8125rem;
    }
    #tabel-link-access_wrapper .dataTables_filter input {
        padding: 0.35rem 0.75rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 0.8125rem;
    }
    #tabel-link-access_wrapper .dataTables_paginate .paginate_button {
        padding: 0.35rem 0.75rem !important;
        border-radius: 0.5rem !important;
        margin: 0 0.125rem;
    }
    #tabel-link-access_wrapper .dataTables_paginate .paginate_button.current {
        background: #0ea5e9 !important;
        color: white !important;
        border: none;
    }
    #tabel-link-access_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f3f4f6 !important;
        border: 1px solid #e5e7eb;
    }
    #tabel-link-access_wrapper .dataTables_info {
        font-size: 0.8125rem;
        color: #6b7280;
        padding-top: 1rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    $(document).ready(function() {
        const table = $('#tabel-link-access').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('link-access.index') }}',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'icon', name: 'icon', orderable: false, searchable: false },
                { data: 'judul', name: 'judul' },
                { data: 'url', name: 'url' },
                { data: 'penulis', name: 'penulis', orderable: false, searchable: false },
                { data: 'tanggal', name: 'tanggal', orderable: false, searchable: false },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
            ],
            order: [[2, 'asc']],
            language: {
                search: '',
                searchPlaceholder: 'Cari link...',
                lengthMenu: 'Tampilkan _MENU_ data per halaman',
                zeroRecords: 'Tidak ada data yang ditemukan',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                infoEmpty: 'Tidak ada data yang tersedia',
                infoFiltered: '(difilter dari _MAX_ total data)',
                processing: '<div class="text-sky-500 text-sm py-4">Memuat data...</div>',
                paginate: {
                    first: 'Pertama',
                    last: 'Terakhir',
                    next: '›',
                    previous: '‹'
                }
            },
            lengthMenu: [10, 25, 50],
            pageLength: 10,
        });
    });

    function hapusLinkAccess(id, nama) {
        document.getElementById('nama-hapus').textContent = nama;
        document.getElementById('modal-hapus').classList.remove('hidden');
        document.getElementById('modal-hapus').classList.add('flex');

        document.getElementById('btn-konfirmasi-hapus').onclick = function() {
            $.ajax({
                url: '/menu/link-access/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    document.getElementById('modal-hapus').classList.add('hidden');
                    document.getElementById('modal-hapus').classList.remove('flex');

                    if (response.success) {
                        $('#tabel-link-access').DataTable().ajax.reload(null, false);
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.message,
                            confirmButtonColor: '#ef4444'
                        });
                    }
                },
                error: function() {
                    document.getElementById('modal-hapus').classList.add('hidden');
                    document.getElementById('modal-hapus').classList.remove('flex');
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat menghapus data.',
                        confirmButtonColor: '#ef4444'
                    });
                }
            });
        };
    }
</script>
@endpush
