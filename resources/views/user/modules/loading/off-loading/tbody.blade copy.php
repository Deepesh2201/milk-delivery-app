@forelse($items as $item)
<tr>
    <td>{{(($items->currentPage() * $items->perPage()) + $loop->iteration) - $items->perPage()}}</td>
    <td>{{$item->onloading_id ?? ''}}</td>
    <td>{{$item->salesman->name ?? ''}}</td>
    <td>{{$item->salesman->contact_number ?? ''}}</td>
    <?php $productArr = $item->lines; ?>
@if($productArr->count() >= 1 )
    <td></td>
    <td></td>
    <td></td>
    <td>
        {{--<div class="btn-group" role="group" aria-label="...">
            <a href="{{ route('offloading.edit',$item->id)}}" class="btn btn-default"><i class="far fa-edit"></i></a>
            <!-- <a id="{{ $item->id }}" onclick="deleteItem( this.id )" class="btn btn-default"><i class="far fa-trash-alt"></i></a> -->
            <a href="{{ route('offloading.delete',$item->id)}}" class="btn btn-default" ><i class="far fa-trash-alt"></i></a>
           
        </div>--}}
    </td>
</tr>
@foreach($productArr as $p)
    <tr>
        <td></td>
        <td>{{$item->onloading_id ?? ''}}</td>
        <td>{{$item->salesman->name ?? ''}}</td>
        <td>{{$item->salesman->contact_number ?? ''}}</td>
        <td>{{$p->offloadingProducts->sap_id ?? ''}}</td>
        <td>{{$p->offloadingProducts->name ?? ''}}</td>
        <!-- <td>{{$item->offloadingProducts->sap_id ?? ''}}</td>
        <td>{{$item->offloadingProducts->sap_id ?? ''}}</td>  -->  
        <td>{{$p->qty ?? ''}}</td>
        <!-- <td>{{$item->offloadingProducts->unit_price ?? ''}}</td>     -->
        <!-- <td>{{$item->status ?? ''}}</td> -->
    
        <td>
           
        </td>   
    </tr>
@endforeach
@else
    <td>{{$item->oneLine->offloadingProducts->sap_id ?? ''}}</td>
    <td>{{$item->onLine->offloadingProducts->name ?? ''}}</td>
    <td>{{$item->qty ?? ''}}</td>
    <!-- <td>{{$item->offloadingProducts->unit_price ?? ''}}</td>     -->
    <!-- <td>{{$item->status ?? ''}}</td> -->
   
    <td>
    </td>   
</tr>
@endif
@empty
<tr>
    @if($items->currentPage() == $items->lastPage())
        <td colspan="11" align="center">{{ __('l.record_not_found') }}</td>
    @else
        <td colspan="10" align="center"> {{ __('l.no_more_record') }}</td>
    @endif
</tr>
@endforelse