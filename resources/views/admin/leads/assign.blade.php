@extends('admin.layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<head></head>

<div class="card p-4">

    <div class="row mb-3">
        <div class="col-md-12">
            <h4 class="text-primary">TOTAL UNASSIGNED JOBS : {{$unassignleadscount ?? 0}} </h4>
        </div>
    </div>

    <form action="{{route('leads.assignstore')}}" id="companyadmin" method="post">


    @csrf()
        <div class="row ">


            <div class="col-md-3">
                <label>Select Transporter</label>
                <select name="user_id" class="form-control" required>
                    <option value="">Select Transporter</option>
                    @if(!empty($users))
                    @foreach($users as $list)
                    <option value="{{$list->id}}">{{$list->name ?? ''}} ({{$list->role ?? ''}})</option>
                    @endforeach()

                    @endif


                </select>
            </div>
            <!-- <div class="col-md-3">
                <label>Select Source </label>
                <select name="source" class="form-control" onchange="getUnassignSourceLeads(this.value)">
                    <option value="">Select Source</option>
                    @if(!empty($sources))
                    @foreach($sources as $list)
                    <option value="{{$list->source}}">{{$list->source}}</option>
                    @endforeach()

                    @endif


                </select>
                <span style="color:cadetblue;" id="showsourcecount"></span>
            </div> -->


            <div class="col-md-3">
                <label>Count</label>
                <input type="number" id="maxcount" name="count" required class="form-control" max="{{$unassignleadscount}}" placeholder="Enter Count of Leads">
            </div>

            <input type="hidden" name="unassignedleads" id="unassignedleads">
            @if($unassignleadscount >0)
            <div class="col-md-3 mt-4">
                <label></label>
                <button class="btn  btn-primary" id="submitbttn">Submit</button>
            </div>
            @endif()    
            <span id="success" class="text-success"></span>

        </div>
</div>

</form>
<script src="{{asset('admin/js/ajax/assign.js')}}"></script>

@endsection