@if ($paginator->hasPages())

<section class="container">
    <div class="pagination">
        <span class="page1">
            <a href="{{ $paginator->previousPageUrl() }}">{{ __('website.prev') }}</a>
        </span>
        <ul>
            @foreach ($elements as $element)
            @if (is_array($element))
            @foreach ($element as $page => $url)

            <li><a  @if($paginator->currentPage() == $page) class="pag-number active-pagination" @else  class="pag-number"  @endif   href="{{$url}}">{{$page}}</a></li>
            @endforeach
            @endif
            @endforeach
        </ul>
        <span class="page2">
            <a href="{{ $paginator->nextPageUrl() }}">{{ __('website.next') }}</a>
        </span>
    </div>
</section>
     

@endif
