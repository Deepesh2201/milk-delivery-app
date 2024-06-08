@forelse($items as $item)
<!-- <tr>
    <td>{{(($items->currentPage() * $items->perPage()) + $loop->iteration) - $items->perPage()}}</td> -->
    <?php $productArr = $item->lines; ?>
@if($productArr->count() >= 1 )
   
@foreach($productArr as $p)
    <tr>
        
        <td>{{ $loop->iteration }}</td>
        <td>{{$p->onloadingProducts->sap_id ?? ''}}</td>
        <td>{{$p->onloadingProducts->name ?? ''}}</td>
        <td>{{$p->onloadingProducts->group ?? ''}}</td>
        <td>{{$p->batch_no ?? ''}}</td>
        <!-- <td>{{$item->onloadingProducts->sap_id ?? ''}}</td>
        <td>{{$item->onloadingProducts->sap_id ?? ''}}</td>  -->  
        <td>{{$p->qty ?? ''}}</td>
        <!-- <td>{{$item->onloadingProducts->unit_price ?? ''}}</td>     -->
        <!-- <td>{{$item->status ?? ''}}</td> -->
    
          
    </tr>
@endforeach
@else
<td></td>
<td></td>
    <td>{{$item->oneLine->onloadingProducts->sap_id ?? ''}}</td>
    <td>{{$item->onLine->onloadingProducts->name ?? ''}}</td>
    <td>{{$item->qty ?? ''}}</td>
    <!-- <td>{{$item->onloadingProducts->unit_price ?? ''}}</td>     -->
    <!-- <td>{{$item->status ?? ''}}</td> -->
   
    <td></td>   
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