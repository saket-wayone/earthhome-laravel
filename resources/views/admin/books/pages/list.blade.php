@extends('admin.layout')
@section('content')
<style>
    table thead {
        background-color: black;
        color: white;
    }
    .arrow-btns {
        display: flex;
        align-items: center;
    }
    .arrow-btns button {
        margin: 0 5px;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="row">
    
    @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-success">
        {{ session('error') }}
    </div>
@endif
    <div class="col-xl-12">
        <div class="card">
             
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Book Pages
                
                
                
                
                </h4>
                
                <div class="flex-shrink-0">
<a href="{{route('books.notify')}}" class="btn btn-dark  btn-sm">Notify MR for new Book Update</a>

</div>
                
                
                
            </div>
            
            
            
            <!-- end card header -->

            <div class="card-body">
                <div class="live-preview">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>SNO</th>
                                    <th>Sequence</th>
                                    <th>Page Title</th>
                                    <th>Page Cover Image</th>
                                    <th>Youtube</th>
                                    <th>Audio</th>
                                    <th>Created On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($innerpage))
                                    @foreach($innerpage as $key=> $list)
                                    <tr>
                                        <th>{{ ++$key}}</th>
                                        <th>{{$list->sequence ?? ''}}</th>
                                        <td>{{$list->title ?? ''}} </td>
                                        <td>
                                            <a href="{{url($list->inner_image)}}" target="__blank">
                                                <img src="{{url($list->inner_image)}}" style="width: 100px; height:50px">
                                            </a>
                                        </td>
                                        <td>{{$list->youtube_link ?? ''}}</td>
                                        <td>
                                            @if ($list->audio_file != '')
                                            <audio controls>
                                                <source src="{{ url($list->audio_file) }}" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                            @endif
                                        </td>
                                        <td>{{date('Y-m-d', strtotime($list->created_at))}}</td>
                                        <td style="align-items: end; text-align:end;">
                                            <div class="d-flex gap-2">
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn" onclick="confirmDelete1('{{$list->id}}','remove')"><i class="ri-delete-bin-fill"></i></button>
                                                </div>
                                                <div class="edit">
                                                    <a href="{{route('page.edit',$list->id)}}" class="btn btn-sm btn-success edit-item-btn"><i class="ti ti-pencil"></i></a>
                                                </div>
                                                <div class="arrow-btns">

                                                <a href="{{route('page.addnew',$list->id)}}" class="btn btn-primary btn-sm">Add Page</a>
                                                    
                                                    <!-- <button type="button" class="btn btn-sm btn-secondary move-up" onclick="moveRow('{{$list->id}}', 'up')">↑</button>
                                                    <button type="button" class="btn btn-sm btn-secondary move-down" onclick="moveRow('{{$list->id}}', 'down')"> ↓</button> -->
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>

<script src="{{asset('admin/js/ajax/bookpages.js')}}"></script>
<script>
    function moveRow(pageId, direction) {
        let url = '{{ route("page.move") }}';
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                _token: "{{ csrf_token() }}",
                page_id: pageId,
                direction: direction
            },
            success: function(response) {
                if (response.status == 'success') {
                    location.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        });
    }
</script>
@endsection
