 @if(count($result->edges)) 
<div class="pagination-lg">
    <ul class="pagination">
        @if($result->pageInfo->hasPreviousPage)
        <li class="page-item {{$result->pageInfo->hasPreviousPage ? '' : 'disabled'}}">
            <a class="page-link {{$result->pageInfo->hasPreviousPage ? '' : 'disabled'}}" href="javascript:void(0)" tabindex="{{$result->pageInfo->hasPreviousPage ? '' : '-1'}}"
                data-type="prev" data-cursor="{{$result->edges[0]->cursor}}">Previous</a>
        </li>
        @endif
        @if($result->pageInfo->hasNextPage)
        <li class="page-item {{$result->pageInfo->hasNextPage ? '' : 'disabled'}}">
            <a class="page-link {{$result->pageInfo->hasNextPage ? '' : 'disabled'}}" href="javascript:void(0)" tabindex="{{$result->pageInfo->hasPreviousPage ? '' : '-1'}}"
                data-type="next" data-cursor="{{end($result->edges)->cursor}}">Next</a>
        </li>
        @endif
    </ul>
</div>
 @endif 