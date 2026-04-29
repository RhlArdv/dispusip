extends('layouts.app')
@section('title', 'Kontak Kami')

@section('page-header')
<div class="flex items-center justify-between flex-wrap gap-3">
    <div>
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
            <span>Profil</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span>Kontak Kami</span>
        </div>
        <h1 class="text-xl font-bold text-gray-900">Kontak Kami</h1>
    </div>
</div>
@endsection

@section('content')
    @include('profil.form', ['icon' => '📞'])
@endsection