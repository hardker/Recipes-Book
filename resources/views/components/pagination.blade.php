@if ($paginator->hasPages())
    <nav aria-label="Навигация по страницам">
        <hr class="my-0" />
        <ul class="pagination justify-content-center my-4">

            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">
                        << Назад</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        << Назад</a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Далее >></a>
                </li>
            @else
                <li class="page-item disabled"><span class="page-link">Далее >></span></li>
            @endif

        </ul>
    </nav>
@endif
