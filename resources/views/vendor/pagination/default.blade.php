@if ($paginator->hasPages())
    <nav class="navigation align-center">
{{--
        --}}
{{-- Previous Page Link --}}{{--

        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        --}}
{{-- Pagination Elements --}}{{--

        @foreach ($elements as $element)
            --}}
{{-- "Three Dots" Separator --}}{{--

            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif
--}}
        @foreach ($elements as $element)

            {{-- "Three Dots" Separator --}}

                        @if (is_string($element))
                            <li class="disabled"><span>{{ $element }}</span></li>
                        @endif
                        {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <a class="page-numbers bg-border-color current"><span>{{ $page }}</span></a>

                @else
                    <a href="{{ $url }}" class="page-numbers bg-border-color"><span>{{ $page }}</span></a>

                @endif
                @endforeach
            @endif
        @endforeach


    </nav>
@endif
