@extends('admin.layout')

@section('content')

<div class="container mt-4">

    <!-- Search and Filter Bar -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <input type="text" class="form-control w-50 me-2" placeholder="Search Projects..." id="searchInput" aria-label="Search Projects">

        <select class="form-select me-2 w-50" id="projectSelect" aria-label="Select Project">
            <option value="">Select Project</option>
            @for($i = 1; $i <= 6; $i++)
                <option value="Project {{ $i }}">Project {{ $i }}</option>
                @endfor
        </select>

        <select class="form-select w-25 me-2" id="filterSelect" aria-label="Filter by Status">
            <option value="">All Statuses</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
            <option value="Not Started">Not Started</option>
            <option value="On Hold">On Hold</option>
        </select>

        <!-- Add Project Button -->
        <button class="btn btn-primary w-25" id="addProjectBtn" aria-label="Add New Project">+ Add Project</button>
    </div>


    <!-- Project Cards -->
    @if(!empty($projects))
    <div class="d-flex justify-content-start flex-wrap" id="projectContainer">

        @foreach($projects as $key=>$listing )
        @php 
            $status  = 'In Progress';
        @endphp 
        <div class="card mx-2 mb-3 shadow-sm" style="width: 270px; cursor: pointer;" data-status="{{ $status }}">
            <div class="card-body text-center ">
                <a href="{{route('project.detail',$listing->lead_id)}}">
                <img src="{{asset('sample/icons/folder-svgrepo-com.svg')}}" style="width: 50px; height:50px;" class="mb-1">
                <h6 class="text-title font-weight-bold mb-0">{{$listing->phase_name ?? ''}}</h6>
                <span class="badge {{ $status == 'In Progress' ? 'bg-success' : ($status == 'Completed' ? 'bg-primary' : ($status == 'Not Started' ? 'bg-warning' : 'bg-secondary')) }} text-white mt-1">
                    {{ $status }}
                </span> <!-- Project Status -->
                </a>

            </div>
        </div>
        @endforeach()
    </div>
    @endif()

</div>


@endsection