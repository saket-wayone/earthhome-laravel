
            @if(!empty($leads))
                @foreach($leads as $keys => $list)
                <tr>
                    <th>{{ ++$keys }}</th>
                    <td>{{ $list->unique_id ?? '' }}</td>
                    <td><span style="color:blue">{{ $list->assignleads->user->name ?? 'Not Assign Yet!' }}</span></td>
                    <td>{{ $list->name ?? '' }}</td>
                    <td>{{ $list->email ?? '' }}</td>
                    <td>{{ $list->phone ?? '' }}</td>
                    <td>@if(!empty($list->status))<span class="btn btn-info btn-sm">{{ $list->status ?? '' }}</span> @endif()</td>
                    <td>{{ $list->source ?? '' }}</td>
                    <td>{{ $list->description ?? '' }}</td>
                    <td>{{ date('d-m-y', strtotime($list->created_at)) }}</td>
                    <td>@if(!empty($list->updated_at)){{ date('d-m-Y', strtotime($list->updated_at)) }}@endif()</td>

                    <td style="align-items: end; text-align:end;">
                        <div class="d-flex gap-2">
                            <div class="edit">
                                <a href="#">
                                    <img src="{{asset('admin/images/whatsapp.png')}}" width="25px" height="25px">




                                </a>
                            </div>
                            <div class="edit">
                                <a href="#">
                                    <img src="{{asset('admin/images/phone-call.png')}}" width="25px" height="25px">




                                </a>
                            </div>
                            @if(Auth::user()->role=='admin')

                            <div class="remove">
                                <button class="btn btn-sm btn-danger remove-item-btn" onclick="confirmDelete('{{ $list->id }}','remove')"><i class="ti ti-trash"></i></button>
                            </div>
                            @endif()

                            <div class="edit">
                                <a href="{{ url('admin/leads/edit', $list->id) }}" class="btn btn-sm btn-success edit-item-btn"><i class="ti ti-pencil"></i></a>
                            </div>

                        </div>
                    </td>
                </tr>
                @endforeach

                @endif