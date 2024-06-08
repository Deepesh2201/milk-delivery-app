@forelse($items as $item)
<tr>
    <td>{{(($items->currentPage() * $items->perPage()) + $loop->iteration) - $items->perPage()}}</td>
    <td>{{$item->sap_id ?? ''}}</td>
    <td>{{$item->name ?? ''}}</td>
    <td>{{$item->email ?? ''}}</td>
    <td>{{$item->contact_number ?? ''}}</td>
    <td>{{$item->monthly_target?? ''}}</td>
    <!-- <td>{{$item->status ?? ''}}</td> -->
   
    <td>
        <div class="btn-group" role="group" aria-label="...">
            <a href="{{ route('salesman.edit',$item->id)}}" class="btn btn-default"><i class="far fa-edit"></i></a>
            <!-- <a id="{{ $item->id }}" onclick="deleteItem( this.id )" class="btn btn-default"><i class="far fa-trash-alt"></i></a> -->
            {{-- <a href="{{ route('salesman.delete',$item->id)}}" class="btn btn-default" ><i class="far fa-trash-alt"></i></a> --}}
           
        </div>
    </td>
   
</tr>

@empty
<tr>
    @if($items->currentPage() == $items->lastPage())
        <td colspan="11" align="center">{{ __('l.record_not_found') }}</td>
    @else
        <td colspan="10" align="center"> {{ __('l.no_more_record') }}</td>
    @endif
</tr>
@endforelse