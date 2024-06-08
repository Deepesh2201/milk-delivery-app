@forelse($items as $item)
    <tr>
        <td>{{ $items->currentPage() * $items->perPage() + $loop->iteration - $items->perPage() }}</td>
        <td>{{ $item->salesman->name ?? '' }}</td>
        <td>{{ $item->salesman->contact_number ?? '' }}</td>
        <?php $productArr = $item->lines; ?>
        @if ($productArr->count() >= 1)
            <td colspan="5"></td>
            @if ($item->is_approved == '0')
                <td><a class="text-warning">Created</a></td>
                <td>
                    <div class="btn-group" role="group" aria-label="...">
                        <a href="{{ route('onloading.approve', $item->id) }}"><button type="button"
                                class="btn-success"><span
                                    class=""style="backgroudn-color:red;color:white">Approve</span></a>
                        <!-- <a id="{{ $item->id }}" onclick="deleteItem( this.id )" class="btn btn-default"><i class="far fa-trash-alt"></i></a> -->
                        {{-- <a href="{{ route('onloading.delete',$item->id)}}" class="btn btn-default" ><i class="far fa-trash-alt"></i></a> --}}

                    </div>
                </td>
            @elseif ($item->is_approved == '1')
                <td><a class="text-success">Approved</a></td>
                <td></td>
            @elseif ($item->is_approved == '2')
                <td><a class="text-primary">Onloaded</a></td>
                <td></td>
            @elseif ($item->is_approved == '3')
                <td><a class="text-danger">Offloaded</a></td>
                <td></td>
            @endif


    </tr>
    @foreach ($productArr as $p)
        <tr>
            <td></td>
            <td>{{ $item->salesman->name ?? '' }}</td>
            <td>{{ $item->salesman->contact_number ?? '' }}</td>
            <td>{{ $p->onloadingProducts->sap_id ?? '' }}</td>
            <td>{{ $p->onloadingProducts->name ?? '' }}</td>
            <td>{{ $p->group ?? '' }}</td>
            <td>{{ $p->batch_no ?? '' }}</td>
            <td>{{ $p->qty ?? '' }}</td>
            <td></td>
            <td></td>
        </tr>
    @endforeach
@else
    <td>{{ $item->oneLine->onloadingProducts->sap_id ?? '' }}</td>
    <td>{{ $item->onLine->onloadingProducts->name ?? '' }}</td>
    <td>{{ $item->qty ?? '' }}</td>
    <!-- <td>{{ $item->onloadingProducts->unit_price ?? '' }}</td>     -->
    <!-- <td>{{ $item->status ?? '' }}</td> -->

    <td>
        <div class="btn-group" role="group" aria-label="...">
            <a href="{{ route('onloading.edit', $item->id) }}" class="btn btn-default"><i class="far fa-edit"></i></a>
            <!-- <a id="{{ $item->id }}" onclick="deleteItem( this.id )" class="btn btn-default"><i class="far fa-trash-alt"></i></a> -->
            <a href="{{ route('onloading.delete', $item->id) }}" class="btn btn-default"><i
                    class="far fa-trash-alt"></i></a>

        </div>
    </td>
    </tr>
@endif
@empty
<tr>
    @if ($items->currentPage() == $items->lastPage())
        <td colspan="11" align="center">{{ __('l.record_not_found') }}</td>
    @else
        <td colspan="10" align="center"> {{ __('l.no_more_record') }}</td>
    @endif
</tr>
@endforelse
