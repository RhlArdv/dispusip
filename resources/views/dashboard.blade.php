@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-[13px] text-gray-500 mt-0.5">Selamat datang di Sistem DISPUSIP</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
    {{-- Stats Cards --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $stats->total_arsip }}</p>
                <p class="text-xs text-gray-500">Total Arsip</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $stats->total_berita }}</p>
                <p class="text-xs text-gray-500">Total Berita</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $stats->total_galeri }}</p>
                <p class="text-xs text-gray-500">Total Galeri</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $stats->total_layanan }}</p>
                <p class="text-xs text-gray-500">Total Layanan</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $stats->total_users }}</p>
                <p class="text-xs text-gray-500">Total Users</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm text-center">
    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-600 flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </div>
    <h2 class="text-xl font-bold text-gray-900 mb-2">Selamat Datang di DISPUSIP!</h2>
    <p class="text-gray-500 mb-6">Sistem Informasi Dinas Perpustakaan dan Kearsipan siap digunakan.</p>
    <p class="text-sm text-gray-400">Sistem dengan RBAC custom telah berhasil diimplementasi.</p>
</div>
@endsection
