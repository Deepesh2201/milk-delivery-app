@if(!empty($items))
@forelse($items as $item) 
<tr>
    <td>{{(($items->currentPage() * $items->perPage()) + $loop->iteration) - $items->perPage()}}</td>
    <td>{{ $item->project ? ($item->project->project_code.' '.$item->project->project_name ?? '') :'' }}</td>
   
    <td ><a href="{{ route('project-activity.show',  $item->id)}}" class="link" title="See Details">{{$item->activity_code}} {{$item->activity}}</a></td>
    <td>{{ $item->user->full_name ?? '' }}</td>
    <td>{{$item->description}}</td> 
    <td>
    <?php if($item->status == 1) { echo '<span class="badge-success badge mr-2">Active</span>'; } elseif($item->status == 0){ echo '<span class="badge-danger badge mr-2">Inactive</span>'; } ?>  
    </td> 
    <td>   
        <b><a href="{{ route('project-task-list',  ['prj_id' => $item->project_id , 'act_id'=>$item->id])}}" class="link">{{$item->tasks->count()}}</a></b>
    </td>   
    <td>
        <div class="btn-group" role="group" aria-label="...">
            @if($item->status == 1)
            <a href="{{ route('project-activity.status',['id' => $item->id,'status' => $item->status])}}"
                class="btn btn-default" title="Active"><i class="fas fa-check text-success"></i></a>
            @else
            <a href="{{ route('project-activity.status',[ 'id' => $item->id,'status' => $item->status])}}"
                class="btn btn-default" title="Inactive"><i class="fas fa-times text-danger"></i></a>
            @endif 
            <a href="{{ route('project-activity.edit',$item->id)}}" class="btn btn-default" title="Edit"><i
                    class="far fa-edit"></i></a>
            <a href="{{ route('project-activity.delete', $item->id)}}" class="btn btn-default" title="Delete"><i
                    class="far fa-trash-alt"></i></a>
            <!-- <a href="#" class="btn btn-default" title="Add feature"><i
                    class="far fa-plus"></i><span class="btn btn-info  mr-2">Add/Edit feature</span></a> -->
           
        </div>
    </td>
    
</tr>
@empty
<tr>
    @if($items->currentPage() == $items->lastPage())
    <td colspan="11" align="center"> {{ __('l.project_activity') }} {{ __('l.not_found') }}</td>
    @else
        <td colspan="10" align="center"> {{ __('l.no_more_record') }}</td>
    @endif
</tr>
@endforelse
@else
<tr>
    <td colspan="11" align="center"> {{ __('l.project_activity') }} {{ __('l.not_found') }}</td>
</tr>
@endif