@extends('layouts.app')

@section('title', 'Buku')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 0.5rem 0.75rem;
        margin-left: 0.5rem;
    }
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 0.375rem 2rem 0.375rem 0.75rem;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
    }
</style>
@endpush

@section('content')
<div class="p-6 lg:p-8">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Koleksi Buku</h1>
            <p class="text-sm text-gray-500 mt-0.5">Kelola buku dan koleksi perpustakaan</p>
        </div>
        <a href="{{ route('buku.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white
                  text-sm font-medium rounded-xl transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Buku
        </a>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            {{-- Filter by Kategori --}}
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">Kategori</label>
                <select id="filterKategori" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoriBuku as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Filter by Penerbit --}}
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">Penerbit</label>
                <select id="filterPenerbit" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Semua Penerbit</option>
                    @foreach($listPenerbit as $penerbit)
                        <option value="{{ $penerbit }}">{{ $penerbit }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Filter by Tahun --}}
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">Tahun Terbit</label>
                <select id="filterTahun" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Semua Tahun</option>
                    @foreach($listTahun as $tahun)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Reset Button --}}
            <div class="flex items-end">
                <button id="resetFilters" class="w-full px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                    Reset Filter
                </button>
            </div>
        </div>
    </div>

    {{-- DataTable --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full table-striped" id="bukuTable">
                <thead>
                    <tr>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">#</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Sampul</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Informasi Buku</th>
                        <th>Penulis</th>
                        <th>ISBN</th>
                        <th>Kategori</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Status</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Dibuat Pada</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- DataTables will populate this --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#bukuTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('buku.index') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '50px' },
            { data: 'sampul', name: 'sampul', orderable: false, searchable: false, width: '80px' },
            { data: 'info_buku', name: 'judul' },
            { data: 'penulis', name: 'penulis', visible: false },
            { data: 'isbn', name: 'isbn', visible: false },
            { data: 'kategori_buku_id', name: 'kategori_buku_id', visible: false },
            { data: 'penerbit', name: 'penerbit', visible: false },
            { data: 'tahun_terbit', name: 'tahun_terbit', visible: false },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'tanggal', name: 'tanggal', orderable: false, searchable: false },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
        ],
        ordering: false,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari judul, penulis, penerbit...",
            lengthMenu: "_MENU_",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ buku",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            },
            emptyTable: "Tidak ada data buku",
            zeroRecords: "Tidak ada buku yang ditemukan"
        },
        dom: "<'flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4 pt-4 px-4'l<'flex-1'f>>" +
             "<'px-4'rt>" +
             "<'flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-4 px-4'ip>",
    });

    // Filter by Kategori
    $('#filterKategori').on('change', function() {
        table.column('kategori_buku_id:name').search($(this).val()).draw();
    });

    // Filter by Penerbit
    $('#filterPenerbit').on('change', function() {
        table.column('penerbit:name').search($(this).val()).draw();
    });

    // Filter by Tahun
    $('#filterTahun').on('change', function() {
        table.column('tahun_terbit:name').search($(this).val()).draw();
    });

    // Reset Filters
    $('#resetFilters').on('click', function() {
        $('#filterKategori, #filterPenerbit, #filterTahun').val('');
        table.search('').columns().search('').draw();
    });
});

// Delete function
function hapusBuku(id, judul) {
    if (confirm('Yakin ingin menghapus buku "' + judul + '"?')) {
        $.ajax({
            url: '/menu/buku/' + id,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                alert('Gagal menghapus buku: ' + xhr.responseJSON.message);
            }
        });
    }
}
</script>
@endpush
@endsection
