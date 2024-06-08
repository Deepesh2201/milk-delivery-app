@if(!empty($items))
@forelse($items as $item) 
<tr>
    <td>{{(($items->currentPage() * $items->perPage()) + $loop->iteration) - $items->perPage()}}</td>
    <td>{{$item->project_code}}</td>
    <td ><a href="{{ route('project.show',  $item->id)}}" class="link" title="See Details">{{$item->project_name}}</a></td>
    <td>{{ $item->projectManager->full_name ?? '' }}</td>
    <td>{{$item->required_skills}}</td> 
    <td>{{ getCurrentTimezoneDate($item->start_date) }}</td> 
    <td>{{ getCurrentTimezoneDate($item->end_date) }}</td> 
    <td>{{$item->description}}</td> 
    <td><?php if($item->status == 1) { echo '<span class="badge-success badge mr-2">Active</span>'; } elseif($item->status == 0){ echo '<span class="badge-danger badge mr-2">Inactive</span>'; } ?>
    </td> 
     
    <td>
        <div class="btn-group" role="group" aria-label="...">
            @if($item->status == 1)
            <a href="{{ route('project.status',['id' => $item->id,'status' => $item->status])}}"
                class="btn btn-default" title="Active"><i class="fas fa-check text-success"></i></a>
            @else
            <a href="{{ route('project.status',[ 'id' => $item->id,'status' => $item->status])}}"
                class="btn btn-default" title="Inactive"><i class="fas fa-times text-danger"></i></a>
            @endif 
            <a href="{{ route('project.edit',$item->id)}}" class="btn btn-default" title="Edit"><i
                    class="far fa-edit"></i></a>
            <a href="{{ route('project.delete', $item->id)}}" class="btn btn-default" title="Delete"><i
                    class="far fa-trash-alt"></i></a>
            <!-- <a href="#" class="btn btn-default" title="Add feature"><i
                    class="far fa-plus"></i><span class="btn btn-info  mr-2">Add/Edit feature</span></a> -->
           
        </div>
    </td>
    
</tr>
@empty
<tr>
    @if($items->currentPage() == $items->lastPage())
    <td colspan="11" align="center"> {{ __('l.project') }} {{ __('l.not_found') }}</td>
    @else
        <td colspan="10" align="center"> {{ __('l.no_more_record') }}</td>
    @endif
</tr>
@endforelse
@else
<tr>
    <td colspan="11" align="center"> {{ __('l.calendar') }} {{ __('l.not_found') }}</td>
</tr>
@endif