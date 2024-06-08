@if(!empty($items))
@forelse($items as $item) 
<tr>
    <td>{{(($items->currentPage() * $items->perPage()) + $loop->iteration) - $items->perPage()}}</td>
    <td>{{ $item->task_code ? ($item->task_code.' '.$item->title ?? '') :'' }}</td>
    <td>{{ $item->date ? getCurrentTimeZoneDate($item->date) : '' }}</td>
    <td>{{ $item->duration ?? '' }}</td>
   
    <td ><a href="{{ route('user.show',  $item->user_id)}}" class="link" title="See Details">{{ $item->user->full_name ?? '' }}</a></td>
    <!-- <td>{{$item->description}}</td>  -->
    <td>
        @if($item->status == 1)<span class="badge-success badge mr-2">Completed</span><br><br>
            @elseif($item->status == 0)<span class="badge-warning badge mr-2">Pending</span><br><br>
        @endif
    </td> 
</tr>
@empty
<tr>
    @if($items->currentPage() == $items->lastPage())
    <td colspan="11" align="center"> {{ __('l.task') }} {{ __('l.not_found') }}</td>
    @else
        <td colspan="10" align="center"> {{ __('l.no_more_record') }}</td>
    @endif
</tr>
@endforelse
@else
<tr>
    <td colspan="11" align="center"> {{ __('l.task') }} {{ __('l.not_found') }}</td>
</tr>
@endif