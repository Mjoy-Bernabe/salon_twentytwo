@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex flex-1 justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center rounded-lg border border-[#2A2A2A] bg-[#111111] px-4 py-2 text-sm font-medium text-[#6B7280]">
                    {{ __('Previous') }}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center rounded-lg border border-[#2A2A2A] bg-black px-4 py-2 text-sm font-medium text-white transition hover:border-[#CA8A04] hover:text-[#CA8A04]" rel="prev">
                    {{ __('Previous') }}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="ml-3 inline-flex items-center rounded-lg border border-[#2A2A2A] bg-black px-4 py-2 text-sm font-medium text-white transition hover:border-[#CA8A04] hover:text-[#CA8A04]" rel="next">
                    {{ __('Next') }}
                </a>
            @else
                <span class="ml-3 inline-flex items-center rounded-lg border border-[#2A2A2A] bg-[#111111] px-4 py-2 text-sm font-medium text-[#6B7280]">
                    {{ __('Next') }}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-[#B0B0B0]">
                    {!! __('Showing') !!}
                    <span class="font-semibold text-white">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="font-semibold text-white">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="font-semibold text-white">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex items-center gap-2">
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}" class="inline-flex items-center gap-1 rounded-lg border border-[#2A2A2A] bg-[#111111] px-3 py-2 text-sm font-medium text-[#6B7280]">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" aria-hidden="true">
                                <path d="M12.5 4.5L7 10l5.5 5.5" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                            </svg>
                            {{ __('Previous') }}
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}" class="inline-flex items-center gap-1 rounded-lg border border-[#2A2A2A] bg-black px-3 py-2 text-sm font-medium text-white transition hover:border-[#CA8A04] hover:text-[#CA8A04] focus:outline-none focus:ring-2 focus:ring-[#CA8A04]/50">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" aria-hidden="true">
                                <path d="M12.5 4.5L7 10l5.5 5.5" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                            </svg>
                            {{ __('Previous') }}
                        </a>
                    @endif

                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span aria-disabled="true" class="inline-flex items-center rounded-lg border border-[#2A2A2A] bg-[#111111] px-3 py-2 text-sm text-[#6B7280]">{{ $element }}</span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page" class="inline-flex items-center rounded-lg border border-[#CA8A04] bg-[#CA8A04] px-3 py-2 text-sm font-semibold text-black">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="inline-flex items-center rounded-lg border border-[#2A2A2A] bg-black px-3 py-2 text-sm font-medium text-white transition hover:border-[#CA8A04] hover:text-[#CA8A04]" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}" class="inline-flex items-center gap-1 rounded-lg border border-[#2A2A2A] bg-black px-3 py-2 text-sm font-medium text-white transition hover:border-[#CA8A04] hover:text-[#CA8A04] focus:outline-none focus:ring-2 focus:ring-[#CA8A04]/50">
                            {{ __('Next') }}
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" aria-hidden="true">
                                <path d="M7.5 4.5L13 10l-5.5 5.5" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}" class="inline-flex items-center gap-1 rounded-lg border border-[#2A2A2A] bg-[#111111] px-3 py-2 text-sm font-medium text-[#6B7280]">
                            {{ __('Next') }}
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" aria-hidden="true">
                                <path d="M7.5 4.5L13 10l-5.5 5.5" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                            </svg>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
