@if(!empty($items))
@forelse($items as $item) 
<tr>
    <td>{{(($items->currentPage() * $items->perPage()) + $loop->iteration) - $items->perPage()}}</td>
    <td ><a href="{{ route('user.show',  $item->id)}}" class="link" title="See Details">{{$item->full_name}}</a></td>
    <td>{{$item->email}}</td>
    <td>{{$item->mobile_number}}</td> 
    <td><?php if($item->status == 1) { echo '<span class="badge-success badge mr-2">Active</span>'; } elseif($item->status == 0){ echo '<span class="badge-danger badge mr-2">Inactive</span>'; } ?>
    </td> 
     
    <td>
        <div class="btn-group" role="group" aria-label="...">
            @if($item->id != Auth::user()->id)

            @if($item->status == 1)
            <a href="{{ route('user.status',['id' => $item->id,'status' => $item->status])}}"
                class="btn btn-default" title="Active"><i class="fas fa-check text-success"></i></a>
            @else
            <a href="{{ route('user.status',[ 'id' => $item->id,'status' => $item->status])}}"
                class="btn btn-default" title="Inactive"><i class="fas fa-times text-danger"></i></a>
            @endif 
            <a href="{{ route('user.edit',$item->id)}}" class="btn btn-default" title="Edit"><i
                    class="far fa-edit"></i></a>
            <a href="{{ route('user.delete',$item->id)}}" class="btn btn-default" title="Delete"><i
                    class="far fa-trash-alt"></i></a>
           
            @endif
        </div>
    </td>
    
</tr>
@empty
<tr>
    @if($items->currentPage() == $items->lastPage())
    <td colspan="11" align="center"> {{ __('l.user_not_found') }}</td>
    @else
        <td colspan="10" align="center"> {{ __('l.no_more_record') }}</td>
    @endif
</tr>
@endforelse
@else
<tr>
    <td colspan="11" align="center"> {{ __('l.user_not_found') }}</td>
</tr>
@endif