
<style> 
    td{
        font-size: 12px !important;
    }
</style>
<table class="table mt-3">
    <thead class="thead-dark">
        <tr>
            <th scope="col">SNo</th>
            <th scope="col">Phase Name</th>
            <th scope="col"> Amount</th>
            <th scope="col"> Balance</th>
            <th scope="col"> Receipt</th>
            <th scope="col">Status</th>
            <th scope="col">Created At</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($phase_receipts))
        @foreach($phase_receipts as $key=> $hisorylist2)
        <tr>
            <th scope="row">{{ ++ $key}}</th>

            <td><b> {{$hisorylist2->phasename['phase_name'] ?? ''}}</b></td>
            <td>₹ {{$hisorylist2->amount ?? ''}}</td>
            <td> ₹ {{$hisorylist2->balance ?? ''}}</td>
            <td>
                @if(!empty($hisorylist2->recepit))
                <a href="{{url($hisorylist2->recepit)}}" target="_blank">View</a>
                @endif()
            </td>
            <td>
                @if($hisorylist2->status ==0 )
                <span class="text-warning">Pending </span>

                @elseif($hisorylist2->status ==2)
                <span class="text-danger">Declined</span>

                @else
                <span class="text-success">Approved</span>

                 @endif()
            </td>
            <td>{{$hisorylist2->created_at ?? ''}}</td>
        </tr>

        @endforeach()


        @endif()



    </tbody>
</table>