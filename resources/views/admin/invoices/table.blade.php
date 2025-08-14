@if(!empty($invoices))
@foreach($invoices as $index => $list)
<tr id="lead-row-{{ $list->id }}">
    <th>{{ ($invoices->currentPage() - 1) * $invoices->perPage() + $index + 1 }}</th>
    <td class="text-info"><a href="{{route('invoice',$list->id)}}" target="__blank">{{ $list->unique_id ?? '' }}</a></td>
    <td>{{ $list->co ?? '' }}</td>
    <td>{{ $list->company ?? '' }}</td>
    <td>{{ $list->invoice_date ?? '' }}</td>
    <td>{{ $list->invoice_due ?? '' }}</td>
    <td><a href="{{route('invoice',$list->id)}}">View</a></td>

    <td>{{ date('d-m-y', strtotime($list->created_at)) }}</td>

    <td style="align-items: end; text-align:end;">
        <div class="d-flex gap-2">
            @if(Auth::user()->role=='admin')
            <div class="remove">
                <button class="btn btn-sm btn-danger remove-item-btn" onclick="confirmDelete('{{ $list->id }}','remove')">
                    <i class="ti ti-trash"></i>
                </button>
            </div>
            @endif()


            <!-- <div class="edit">
                <a href="{{ route('invoices.edit', $list->id) }}" class="btn btn-sm btn-success edit-item-btn">
                    <i class="ti ti-pencil"></i>
                </a>
            </div> -->
        </div>

        <!-- Preloader -->
        <div class="preloader" id="preloader-{{ $list->id }}" style="display: none;">
            <p>Loading....</p>
        </div>
    </td>
</tr>


@endforeach

@endif