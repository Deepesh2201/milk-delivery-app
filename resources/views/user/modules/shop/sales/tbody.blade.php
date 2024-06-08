@forelse($items as $item)
<tr>
    <td>{{(($items->currentPage() * $items->perPage()) + $loop->iteration) - $items->perPage()}}</td>
    <td>{{$item->customer->name ?? ''}}</td>
    <td>{{$item->customer->contact_number ?? ''}}</td>
    <?php $productArr = $item->lines; ?>
@if($productArr->count() >= 1 )
    <td colspan="6"></td>
    <td>{{$item->total_amount ?? ''}}</td>
    {{-- <td>
        <div class="btn-group" role="group" aria-label="...">
            <a href="{{ route('sale.edit',$item->id)}}" class="btn btn-default"><i class="far fa-edit"></i></a>
            <a href="{{ route('sale.delete',$item->id)}}" class="btn btn-default" ><i class="far fa-trash-alt"></i></a>           
        </div>
    </td> --}}
</tr>
@foreach($productArr as $p)
    <tr>
        <td></td>
        <td>{{$item->customer->name ?? ''}}</td>
        <td>{{$item->customer->contact_number ?? ''}}</td>
        <td>{{$p->soldProducts->sap_id ?? ''}}</td>
        <td>{{$p->soldProducts->name ?? ''}}</td>
        <!-- <td>{{ isset($item->status) && $item->status >= 1 ? 'Returned' : 'Sold'}}</td> -->
        <td>{{$p->group ?? ''}}</td>
        <td>{{$p->batch_no ?? ''}}</td>
        <td>{{$p->qty ?? ''}}</td>
        <td>{{$p->unit_price ?? ''}}</td>
        <td>{{$p->total_price ?? ''}}</td> 
        {{-- <td></td> --}}
        <!-- <td> -->
            <!-- <div class="btn-group" role="group" aria-label="...">
                <a href="{{ route('sale.edit',$p->id)}}" class="btn btn-default"><i class="far fa-edit"></i></a>
                <a id="{{ $p->id }}" onclick="deleteItem( this.id )" class="btn btn-default"><i class="far fa-trash-alt"></i></a>
                <a href="{{ route('sale.delete',$p->id)}}" class="btn btn-default" ><i class="far fa-trash-alt"></i></a>
            
            </div> -->
        <!-- </td>    -->
    </tr>
@endforeach
@else
        <td>{{$item->oneLine->soldProducts->sap_id ?? ''}}</td>
        <td>{{$item->oneLine->soldProducts->name ?? ''}}</td>
        <td>{{$item->sta->soldProducts->name ?? ''}}</td>
        <!-- <td>{{ isset($item->status) && $item->status >= 1 ? 'Returned' : 'Sold'}}</td> -->
        <td>{{$item->qty ?? ''}}</td>
        <td>{{$item->unit_price ?? ''}}</td>
        <td>{{$item->total_price ?? ''}}</td>
    <!-- <td>
        <div class="btn-group" role="group" aria-label="...">
            {{-- <a href="{{ route('sale.edit',$item->id)}}" class="btn btn-default"><i class="far fa-edit"></i></a> --}}
            {{-- <a id="{{ $item->id }}" onclick="deleteItem( this.id )" class="btn btn-default"><i class="far fa-trash-alt"></i></a> --}}
            {{-- <a href="{{ route('sale.delete',$item->id)}}" class="btn btn-default" ><i class="far fa-trash-alt"></i></a> --}}
           
        </div>
    </td>    -->
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