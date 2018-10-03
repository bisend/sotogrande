@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <!-- <li class="pagination-icon"><i class="fa fa-chevron-left" aria-hidden="true"></i></li> -->
        @else
            <li class="waves-effect pagination-icon"><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="waves-effect"><a>{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a>{{ $page }}</a></li>
                    @else
                        <li class="waves-effect"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="waves-effect pagination-icon"><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
        @else
            <!-- <li class="pagination-icon"><i class="fa fa-chevron-right" aria-hidden="true"></i></li> -->
        @endif
    </ul>
@endif
