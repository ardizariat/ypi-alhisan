@if ($paginator->hasPages())
    <div class="blog-pagination mb-3">
        <ul class="justify-content-center pagination-link">
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <a href="#" tabindex="-1" aria-disabled="true">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active">
                                <a>{{ $page }}</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <a href="#" tabindex="-1" aria-disabled="true">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </li>
            @endif
        </ul>
    </div>
@endif
