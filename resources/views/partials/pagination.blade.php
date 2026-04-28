@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        
        {{-- Mobile View (Simple Previous/Next) --}}
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-navy-400 bg-white border border-navy-200 cursor-not-allowed rounded-xl">
                    &laquo; Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-navy-700 bg-white border border-navy-200 rounded-xl hover:bg-gold-50 hover:text-gold-600 hover:border-gold-300 transition-colors">
                    &laquo; Sebelumnya
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-navy-700 bg-white border border-navy-200 rounded-xl hover:bg-gold-50 hover:text-gold-600 hover:border-gold-300 transition-colors">
                    Selanjutnya &raquo;
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-navy-400 bg-white border border-navy-200 cursor-not-allowed rounded-xl">
                    Selanjutnya &raquo;
                </span>
            @endif
        </div>

        {{-- Desktop View (Full Pagination) --}}
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-navy-600 font-medium">
                    Menampilkan
                    <span class="font-bold text-navy-900">{{ $paginator->firstItem() }}</span>
                    hingga
                    <span class="font-bold text-navy-900">{{ $paginator->lastItem() }}</span>
                    dari
                    <span class="font-bold text-navy-900">{{ $paginator->total() }}</span>
                    data
                </p>
            </div>

            <div>
                <ul class="relative z-0 inline-flex shadow-sm rounded-xl overflow-hidden border border-navy-200">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li aria-disabled="true" aria-label="&laquo; Sebelumnya">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-navy-300 bg-navy-50 border-r border-navy-200 cursor-not-allowed" aria-hidden="true">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            </span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-navy-700 bg-white border-r border-navy-200 hover:bg-gold-50 hover:text-gold-600 transition-colors" aria-label="&laquo; Sebelumnya">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-navy-500 bg-white border-r border-navy-200 cursor-default">{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-bold text-navy-900 bg-gold-400 border-r border-navy-200 cursor-default">{{ $page }}</span>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-navy-700 bg-white border-r border-navy-200 hover:bg-gold-50 hover:text-gold-600 transition-colors">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li>
                            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-navy-700 bg-white hover:bg-gold-50 hover:text-gold-600 transition-colors" aria-label="Selanjutnya &raquo;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </li>
                    @else
                        <li aria-disabled="true" aria-label="Selanjutnya &raquo;">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-navy-300 bg-navy-50 cursor-not-allowed" aria-hidden="true">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
