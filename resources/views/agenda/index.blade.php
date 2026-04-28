@extends('layouts.app')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Agenda</h1>
            <p class="mt-2 text-sm text-gray-700">Kelola daftar agenda kegiatan dinas.</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('agenda.create') }}" class="inline-flex items-center gap-2 bg-navy-600 text-white px-4 py-2.5 rounded-xl hover:bg-navy-700 transition-colors font-medium text-sm shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Agenda
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 flex items-start gap-3">
            <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-900">Daftar Agenda</h2>
        </div>
        
        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="agendaTable" class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100 w-16">No</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100">Judul Agenda</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100">Tanggal</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100">Tempat</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100">Status</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100 w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        <!-- DataTables -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#agendaTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('agenda.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'judul', name: 'judul'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'tempat', name: 'tempat'},
                {data: 'is_active', name: 'is_active'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            dom: '<"flex flex-col sm:flex-row justify-between items-center pb-4 gap-4"lf>rt<"flex flex-col sm:flex-row justify-between items-center pt-4 gap-4"ip>',
        });
    });
</script>
@endpush
@endsection
