@forelse($items as $item)
<!-- <tr>
    <td>{{(($items->currentPage() * $items->perPage()) + $loop->iteration) - $items->perPage()}}</td>
    <td>{{$item->onloading_id ?? ''}}</td>
    <td>{{$item->salesman->name ?? ''}}</td>
    <td>{{$item->salesman->contact_number ?? ''}}</td> -->
    <?php $onloadingProductArr = $item->lines; ?>
@if($onloadingProductArr->count() >= 1 )
    <!-- <td></td>
    <td></td>
    <td></td>
    <td>
       
    </td>
</tr> -->
@foreach($onloadingProductArr as $p)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$p->onloading_id ?? ''}}</td>
        <td>{{$p->onloadingProducts->group ?? ''}}</td>
        <td>{{$p->batch_no ?? ''}}</td>
        <td>{{$p->onloadingProducts->sap_id ?? ''}}</td>
        <td>{{$p->onloadingProducts->name ?? ''}}</td> 
        <?php  $qty = 0; ?>
        @foreach($sales as $record) 
        <?php 
            $salesLine = $record->lines->where('product_id', $p->product_id)->sum('qty'); 
            $qty = $qty + ($salesLine ?? 0);
        ?>
        @endforeach
        <td>{{$p->qty - $qty}}</td>
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