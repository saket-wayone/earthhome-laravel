@if(!empty($topFiveSales))
@foreach($topFiveSales as $index => $list)
<tr>
    <th>{{ ++$index }}</th>
    <td><span style="color:blue">{{ $list->user_name ?? '' }}</span></td>
    <td>{{ $list->total_payment ?? '' }}</td>
    <td>{{ $list->month ?? '' }}</td>
    <td>

    
        
        
    <a href="{{ url('admin/sales/agent/date/' . $list->add_by . '/' . $list->month ) }}" class="btn btn-primary btn-sm">View </a></td>

</tr>
@endforeach

@endif