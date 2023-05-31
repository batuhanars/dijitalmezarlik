@if ($paginator->hasPages())
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <a class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            &lsaquo;
        </a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
            aria-label="@lang('pagination.previous')">&lsaquo;</a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <a class="disabled" aria-disabled="true">{{ $element }}</a>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a class="active" aria-current="page">{{ $page }}</a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
    @else
        <a class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            &rsaquo;
        </a>
    @endif
@endif
