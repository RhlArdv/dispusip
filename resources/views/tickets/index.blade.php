@extends('layouts.app')

@section('title', 'Kelola Tiket & Masukan')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Tiket & Masukan</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Kelola saran, keluhan, dan tiket masukan dari publik</p>
    </div>
</div>
@endsection

@section('content')
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <p class="text-[13px] text-gray-500">Daftar semua tiket masukan yang masuk dari website publik.</p>
        </div>

        <div class="p-5">
            <table id="tabel-ticket" class="w-full text-sm" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3 w-10">#</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Nama</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Email</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Pesan Singkat</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Status</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3">Tanggal</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider pb-3 w-32">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal Status -->
    <div id="modal-status" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40" onclick="if(event.target===this) document.getElementById('modal-status').classList.add('hidden')">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm mx-4 p-6">
            <h3 class="font-bold text-gray-900 mb-4">Ubah Status Tiket</h3>
            <p class="text-sm text-gray-500 mb-4">Tiket dari: <span id="status-nama" class="font-semibold text-gray-800"></span></p>
            
            <form id="form-status" onsubmit="submitStatus(event)">
                <input type="hidden" id="status-id">
                <div class="space-y-3 mb-6">
                    <label class="flex items-center p-3 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors">
                        <input type="radio" name="status" value="pending" class="text-sky-500 focus:ring-sky-500">
                        <span class="ml-3 text-sm font-medium text-gray-700">Pending</span>
                    </label>
                    <label class="flex items-center p-3 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors">
                        <input type="radio" name="status" value="dibaca" class="text-sky-500 focus:ring-sky-500">
                        <span class="ml-3 text-sm font-medium text-gray-700">Dibaca</span>
                    </label>
                    <label class="flex items-center p-3 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors">
                        <input type="radio" name="status" value="diselesaikan" class="text-sky-500 focus:ring-sky-500">
                        <span class="ml-3 text-sm font-medium text-gray-700">Diselesaikan</span>
                    </label>
                </div>
                
                <div class="flex gap-3">
                    <button type="button" onclick="document.getElementById('modal-status').classList.add('hidden')"
                            class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
                        Batal
                    </button>
                    <button type="submit" id="btn-save-status"
                            class="flex-1 px-4 py-2 text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-xl transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
    /* DataTables styling sama dengan layout lainnya */
    #tabel-ticket_wrapper .dataTables_length,
    #tabel-ticket_wrapper .dataTables_filter {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8125rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }
    #tabel-ticket_wrapper .dataTables_filter {
        justify-content: flex-end;
    }
    #tabel-ticket_wrapper .dataTables_length select {
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
    }
    #tabel-ticket_wrapper .dataTables_filter input {
        padding: 0.35rem 0.75rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 0.8125rem;
        color: #374151;
        width: 200px;
    }
    #tabel-ticket tbody tr { border-bottom: 1px solid #f9fafb; }
    #tabel-ticket tbody tr:hover td { background: #f0f9ff !important; }
    #tabel-ticket thead tr th { border-bottom: 2px solid #f3f4f6 !important; }
    #tabel-ticket_wrapper .dataTables_paginate {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.25rem;
        padding-top: 0.75rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    const table = $('#tabel-ticket').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('tickets.index') }}',
            headers: { 'X-CSRF-TOKEN': csrfToken }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama', name: 'nama' },
            { data: 'email', name: 'email' },
            { data: 'excerpt', name: 'pesan' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'tanggal', name: 'created_at' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
        ],
        language: {
            search: '',
            searchPlaceholder: 'Cari tiket...',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ – _END_ dari _TOTAL_ tiket',
            infoEmpty: 'Tidak ada data',
            paginate: { previous: '‹', next: '›' },
            processing: '<div class="text-sky-500 text-sm py-4">Memuat data...</div>',
        },
    });

    function hapusTicket(id, nama) {
        Swal.fire({
            title: 'Hapus Tiket?',
            text: `Tiket dari ${nama} akan dihapus permanen.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/menu/tickets/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Terhapus!', data.message, 'success');
                        table.ajax.reload(null, false);
                    } else {
                        Swal.fire('Gagal!', data.message, 'error');
                    }
                });
            }
        });
    }

    function updateStatus(id, nama) {
        document.getElementById('status-id').value = id;
        document.getElementById('status-nama').textContent = nama;
        
        // Reset radio buttons
        const radios = document.getElementsByName('status');
        for (let i = 0; i < radios.length; i++) {
            radios[i].checked = false;
        }

        document.getElementById('modal-status').classList.remove('hidden');
        document.getElementById('modal-status').classList.add('flex');
    }

    function submitStatus(e) {
        e.preventDefault();
        const id = document.getElementById('status-id').value;
        const statusEl = document.querySelector('input[name="status"]:checked');
        
        if (!statusEl) {
            Swal.fire('Oops!', 'Silakan pilih status terlebih dahulu.', 'warning');
            return;
        }

        const btn = document.getElementById('btn-save-status');
        btn.disabled = true;
        btn.textContent = 'Menyimpan...';

        fetch(`/menu/tickets/${id}/status`, {
            method: 'PUT',
            headers: { 
                'X-CSRF-TOKEN': csrfToken, 
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ status: statusEl.value })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                document.getElementById('modal-status').classList.add('hidden');
                document.getElementById('modal-status').classList.remove('flex');
                table.ajax.reload(null, false);
                
                const toast = document.createElement('div');
                toast.className = `fixed bottom-6 right-6 z-[99999] flex items-center gap-2 px-4 py-3 rounded-xl border shadow-lg text-sm font-medium max-w-sm bg-green-50 border-green-200 text-green-800`;
                toast.textContent = data.message;
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 4000);
            } else {
                Swal.fire('Gagal!', data.message || 'Terjadi kesalahan', 'error');
            }
        })
        .finally(() => {
            btn.disabled = false;
            btn.textContent = 'Simpan';
        });
    }
</script>
@endpush
