@if ($paginator->hasPages())
    <div class="pagination mt-50 flexBox center midle">
        @if ($paginator->onFirstPage())
            <span class="pagination_prev disabled"><i class="fas fa-chevron-left"></i></span>
        @else
            <span class="pagination_prev"><i class="fas fa-chevron-left"></i></span>
        @endif
        <ul class="flexBox">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><a href="javascript:void(0)">{{ $element }}</a></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><a href="javascript:void(0)">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
        @if ($paginator->hasMorePages())
            <span class="pagination_next" rel="next"><i class="fas fa-chevron-right"></i></span>
        @else
            <span class="pagination_next disabled" rel="next"><i class="fas fa-chevron-right"></i></span>
        @endif
    </div>
@endif
