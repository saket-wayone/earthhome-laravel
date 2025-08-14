@if(!empty($leads))
@foreach($leads as $index => $list)
<tr id="lead-row-{{ $list->id }}">
    <td>{{ date('d-m-y', timestamp: strtotime($list->created_at)) }}</td>
    <td>{{ $list->invoicenumber ?? '' }}</td>
    <td>{{ $list->firms->name ?? '' }}</td>
    <td><span style="color:blue">{{ $list->assignleads->user->name ?? 'Not Assign Yet!' }}</span></td>
    <td>{{ $list->truck_no ?? '' }}</td>

    <td>Total : ₹ {{$list->total ??  ''}} </br>
        ------
        Advance : ₹ {{$list->advance ?? 0}}
    </td>
    <td>
        {{$list->advanceby ?? ''}}
        /
        {{$list->advancebyname ?? ''}}


    </td>
    <td><span class="@if($list->payment_status == 'Pending')
                                    {{'text-warning'}}
                                        
                                    @else   {{'text-success'}}  @endif">{{ $list->payment_status ?? '' }}</span></br>
        ------</br>
        ₹ {{ $list->remaining ?? '' }}

        <a href="{{route('leads.updatepayment',$list->id)}}" class="btn btn-dark btn-sm"><i class="ti ti-pencil"></i></a>

        </br>
        @if(!empty($list->holder) || !empty($list->ifsc) || !empty($list->account_number) || !empty($list->bankname))
        <span class="text-success"> Bank Detail uploaded</span>
        @endif


    </td>
    <td><span class="@if($list->hold_amount_status == 'Pending')
                                    {{'text-warning'}}
                                        
                                    @else   {{'text-success'}}  @endif"> {{ $list->hold_amount_status ?? '' }}</span></br>
        ------</br>
        ₹ {{ $list->hold_amount ?? '' }}


        <a href="{{route('leads.holdamountstatus',$list->id)}}" class="btn btn-dark btn-sm"><i class="ti ti-pencil"></i></a>

        @if(!empty($list->proof))
        <span class="text-success"> Proof Uploaded</span>
        @endif()




    </td>
    <td>
        @if(!empty($list->status))
        <span class="btn btn-sm 
                                                @switch($list->status)
                                                    @case('Pending')
                                                        btn-warning
                                                        @break
                                                    @case('Completed')
                                                        btn-success
                                                        @break
                                                    @case('On the way for Loading')
                                                        btn-primary
                                                        @break
                                                    @case('Vehicle Loading')
                                                        btn-info
                                                        @break
                                                    @case('Loading Completed')
                                                        btn-dark
                                                        @break
                                                    @case('In Transit')
                                                        btn-secondary
                                                        @break
                                                    @case('Reached Destination')
                                                        btn-success
                                                        @break
                                                    @case('Waiting For Unloading')
                                                        btn-warning
                                                        @break
                                                    @case('Vehicle Unloading')
                                                        btn-info
                                                        @break
                                                    @case('Waiting for Payment')
                                                        btn-danger
                                                        @break
                                                    @default
                                                        btn-light
                                                @endswitch
                                                ">

            <span data-bs-target="#updateStatus" onclick="updateLeadStatus('{{ $list->id }}')" data-bs-toggle="modal"> {{ $list->status ?? '' }}</span>

            @endif
    </td>

    <td style="align-items: end; text-align:end;">

        @if (Auth::user()->role=='Transporter')
        <!--<span class="btn btn-info btn-sm " data-bs-target="#updateStatus" onclick="updateLeadStatus('{{ $list->id }}')" data-bs-toggle="modal"><i class="ti ti-edit"></i></span><br>-->


        @else
        <div class="d-flex gap-2">
            <!-- <div class="edit">
                                                <a href="#">
                                                    <img src="{{asset('admin/images/whatsapp.png')}}" width="25px" height="25px">
                                                </a>
                                            </div>
                                            <div class="edit">
                                                <a href="javascript:void(0)" onclick="makeCall('{{ $list->phone }}', '{{ $list->id }}')">
                                                    <img src="{{asset('admin/images/phone-call.png')}}" width="23px" height="23px">
                                                </a>
                                            </div> -->
            @if(Auth::user()->role=='admin')
            <div class="remove">
                <button class="btn btn-sm btn-danger remove-item-btn" onclick="confirmDelete('{{ $list->id }}','remove')">
                    <i class="ti ti-trash"></i>
                </button>
            </div>
            @endif()

            <div class="edit">
                <a href="{{ url('admin/leads/edit', $list->id) }}" class="btn btn-sm btn-success edit-item-btn">
                    <i class="ti ti-pencil"></i>
                </a>
            </div>

            @endif()

        </div>
        <div class="edit">
            <a href="{{ url('admin/leads/invoice', $list->id) }}" class="btn btn-sm btn-dark edit-item-btn">
                <i class="ti ti-printer"></i>
            </a>
        </div>

        <!-- Preloader -->
        <div class="preloader" id="preloader-{{ $list->id }}" style="display: none;">
            <p>Loading....</p>
        </div>
    </td>
</tr>


@endforeach

@endif