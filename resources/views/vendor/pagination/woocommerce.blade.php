@if ($paginator->hasPages())
    <ul class="page-numbers" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled">
                <span class='page-numbers current' aria-current="page">←</span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" class="page-numbers previous" rel="prev">←</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li>
                            <span class='page-numbers current' aria-current="page">{{ $page }}</span>
                        </li>
                    @else
                        <li>
                            <a class="page-numbers" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a class="page-numbers next" href="{{ $paginator->nextPageUrl() }}" rel="next">&rarr;</a>
            </li>
        @else
            <li class="disabled">
                <span class='page-numbers current' aria-current="page">&rarr;</span>
            </li>
        @endif
    </ul>
@endif
