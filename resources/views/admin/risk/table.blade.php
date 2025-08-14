
                                    @if(!empty($riskmodel))
                                    @foreach($riskmodel as $key=>$list)
                                    <tr>
                                        <th>{{++$key}}</th>
                                        <td>{{$list->name ?? ''}}</td>
                                        <td>{{$list->email ?? ''}}</td>
                                        <td>{{$list->phone ?? ''}}</td>
                                        <td>{{$list->assess_name ?? ''}}</td>
                                        <td>{{$list->totalpoints ?? ''}}</br></br>
                                        <a href="{{route('downloadscore',$list->id)}}" class="btn btn-sm btn-success edit-item-btn"> <i class="ti ti-eye"></i>
                                        </a>
                                    
                                    </td>
                                        <td>
                                            @if($list->riskfactor =='Low Risk')
                                            @php
                                            $color = 'success';
                                            @endphp
                                            @elseif($list->riskfactor =='Medium Risk')
                                            @php
                                            $color = 'warning';
                                            @endphp
                                            @else
                                            @php
                                            $color = 'danger';
                                            @endphp

                                            @endif()
                                            <span class="text-{{$color}}">{{$list->riskfactor ?? ''}}</span>



                                        </td>
                                        <td>{{date('d-m-y h:i:s a' , strtotime($list->created_at ))}}</td>
                                                                                    @if(in_array(Auth::user()->role, ['admin', 'Compliance']))

                                        <td>
                                            @if($list->service==1)
                                            <a href="{{route('risk-assement-download',$list->id)}}" class="btn btn-primary btn-sm"> PDF</a>
                                            </br>
                                            <a href="{{route('viewserviceaggrement',$list->id)}}">View Service aggrement</a>
                                            @else
                                            <a href="{{url('admin/serviceagreement/create/'.$list->id)}}" class="btn btn-primary btn-sm">+ Service Aggrement</a>


                                            @endif()


                                        </td>

                                        <td style="align-items: end; text-align:end;">

                                            <div class="d-flex gap-2">

                                            <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn" onclick="confirmDelete('{{$list->id}}','remove')"><i class="ti ti-trash"></i></button>
                                                </div>
                                               
                                                <div class="edit">
                                                    <a href="{{url('admin/risk-assement/edit',$list->id)}}" class="btn btn-sm btn-success edit-item-btn"> <i class="ti ti-pencil"></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </td>
                                                                                     @endif()



                                    </tr>
                                    @endforeach()
                                    @endif()
