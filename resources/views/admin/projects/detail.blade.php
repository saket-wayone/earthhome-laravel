@extends('admin.layout')

@section('content')
<style>
    .progress-count:hover {
        background: #f6f0f0e3;
        padding:5px 9px;
        border-radius: 8px;
        cursor: pointer;
    }
</style>


<h1 class="text-uppercase">Project Phases </h1>
<hr>
<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <h4 class="card-title text-uppercase text-center">Task Statistics</h4>
                <div class="statistics">
                    <div class="row">
                        <div class="col-md-6 bg-dark text-white col-6 text-center">
                            <div class="stats-box mb-4 p-2">
                                <p>Total Tasks</p>
                                <h3 class="text-white">385</h3>
                            </div>
                        </div>
                        <div class="col-md-6 col-6 bg-warning col-6 text-center">
                            <div class="stats-box mb-4 p-2">
                                <p class="text-white">Overdue Tasks</p>
                                <h3>19</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <p><i class="fa-regular fa-circle-dot text-purple me-2"></i>Completed Tasks <span class="float-end">166</span></p>
                    <p><i class="fa-regular fa-circle-dot text-warning me-2"></i>Inprogress Tasks <span class="float-end">115</span></p>
                    <p><i class="fa-regular fa-circle-dot text-success me-2"></i>On Hold Tasks <span class="float-end">31</span></p>
                    <p><i class="fa-regular fa-circle-dot text-danger me-2"></i>Pending Tasks <span class="float-end">47</span></p>
                    <p class="mb-0"><i class="fa-regular fa-circle-dot text-info me-2"></i>Review Tasks <span class="float-end">5</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix  g-3">
    <div class="col-lg-12 col-md-12 flex-column">
        <div class="row g-3 row-deck">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-header py-3">
                        <h6 class="mb-0 fw-bold ">Phases Name</h6>
                    </div>
                    <div class="card-body mem-list">

                        @if($phases)
                        @foreach($phases as $list)
                        <div class="progress-count mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h6 class="mb-0 fw-bold d-flex align-items-center">{{$list->phase_name ?? ''}}</h6>
                                <span class="small text-muted">02/07</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar light-info-bg" role="progressbar" style="width: 92%" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        @endforeach()
                        @endif()

                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="card-title fw-semibold">Recent Activity</h5>
                        </div>
                        <ul class="timeline-widget mb-0 position-relative mb-n5">
                            <li class="timeline-item d-flex position-relative overflow-hidden">

                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">RH</span>

                                    <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n1">Payment received from John Doe of $385.90 </br>
                                    <span class="d-flex text-muted">20Min ago</span>
                                </div>

                            </li>
                            <li class="timeline-item d-flex position-relative overflow-hidden">

                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">RH</span>

                                    <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n1">Payment received from John Doe of $385.90 </br>
                                    <span class="d-flex text-muted">20Min ago</span>
                                </div>

                            </li>
                            <li class="timeline-item d-flex position-relative overflow-hidden">

                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">RH</span>

                                    <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n1">Payment received from John Doe of $385.90 </br>
                                    <span class="d-flex text-muted">20Min ago</span>

                                </div>

                            </li>

                            <li class="timeline-item d-flex position-relative overflow-hidden">

                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">RH</span>

                                    <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n1">Payment received from John Doe of $385.90 </br>
                                    <span class="d-flex text-muted">20Min ago</span>
                                </div>

                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header py-3">
                        <h6 class="mb-0 fw-bold ">Allocated Task Members</h6>
                    </div>
                    <div class="card-body">
                        <div class="flex-grow-1 mem-list">
                            <div class="py-2 d-flex align-items-center border-bottom">

                                <div class="d-flex ms-2 align-items-center flex-fill">
                                    <img src="assets/images/xs/avatar6.jpg" class="avatar lg rounded-circle img-thumbnail" alt="avatar">
                                    <div class="d-flex flex-column ps-2">
                                        <h6 class="fw-bold mb-0">Lucinda Massey</h6>
                                        <span class="small text-muted">Ui/UX Designer</span>
                                    </div>
                                </div>
                                <button type="button" class="btn light-danger-bg text-end" data-bs-toggle="modal" data-bs-target="#dremovetask">Remove</button>
                            </div>
                            <div class="py-2 d-flex align-items-center border-bottom">

                                <div class="d-flex ms-2 align-items-center flex-fill">
                                    <img src="assets/images/xs/avatar4.jpg" class="avatar lg rounded-circle img-thumbnail" alt="avatar">
                                    <div class="d-flex flex-column ps-2">
                                        <h6 class="fw-bold mb-0">Ryan Nolan</h6>
                                        <span class="small text-muted">Website Designer</span>
                                    </div>
                                </div>
                                <button type="button" class="btn light-danger-bg text-end" data-bs-toggle="modal" data-bs-target="#dremovetask">Remove</button>
                            </div>
                            <div class="py-2 d-flex align-items-center border-bottom">

                                <div class="d-flex ms-2 align-items-center flex-fill">
                                    <img src="assets/images/xs/avatar9.jpg" class="avatar lg rounded-circle img-thumbnail" alt="avatar">
                                    <div class="d-flex flex-column ps-2">
                                        <h6 class="fw-bold mb-0">Oliver Black</h6>
                                        <span class="small text-muted">App Developer</span>
                                    </div>
                                </div>
                                <button type="button" class="btn light-danger-bg text-end" data-bs-toggle="modal" data-bs-target="#dremovetask">Remove</button>
                            </div>
                            <div class="py-2 d-flex align-items-center border-bottom">

                                <div class="d-flex ms-2 align-items-center flex-fill">
                                    <img src="assets/images/xs/avatar10.jpg" class="avatar lg rounded-circle img-thumbnail" alt="avatar">
                                    <div class="d-flex flex-column ps-2">
                                        <h6 class="fw-bold mb-0">Adam Walker</h6>
                                        <span class="small text-muted">Quality Checker</span>
                                    </div>
                                </div>
                                <button type="button" class="btn light-danger-bg text-end">Remove</button>
                            </div>
                            <div class="py-2 d-flex align-items-center border-bottom">

                                <div class="d-flex ms-2 align-items-center flex-fill">
                                    <img src="assets/images/xs/avatar4.jpg" class="avatar lg rounded-circle img-thumbnail" alt="avatar">
                                    <div class="d-flex flex-column ps-2">
                                        <h6 class="fw-bold mb-0">Brian Skinner</h6>
                                        <span class="small text-muted">Quality Checker</span>
                                    </div>
                                </div>
                                <button type="button" class="btn light-danger-bg text-end" data-bs-toggle="modal" data-bs-target="#dremovetask">Remove</button>
                            </div>
                            <div class="py-2 d-flex align-items-center border-bottom">

                                <div class="d-flex ms-2 align-items-center flex-fill">
                                    <img src="assets/images/xs/avatar11.jpg" class="avatar lg rounded-circle img-thumbnail" alt="avatar">
                                    <div class="d-flex flex-column ps-2">
                                        <h6 class="fw-bold mb-0">Dan Short</h6>
                                        <span class="small text-muted">App Developer</span>
                                    </div>
                                </div>
                                <button type="button" class="btn light-danger-bg text-end" data-bs-toggle="modal" data-bs-target="#dremovetask">Remove</button>
                            </div>
                            <div class="py-2 d-flex align-items-center border-bottom">

                                <div class="d-flex ms-2 align-items-center flex-fill">
                                    <img src="assets/images/xs/avatar3.jpg" class="avatar lg rounded-circle img-thumbnail" alt="avatar">
                                    <div class="d-flex flex-column ps-2">
                                        <h6 class="fw-bold mb-0">Jack Glover</h6>
                                        <span class="small text-muted">Ui/UX Designer</span>
                                    </div>
                                </div>
                                <button type="button" class="btn light-danger-bg text-end" data-bs-toggle="modal" data-bs-target="#dremovetask">Remove</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- .card: My Timeline -->
            </div>
        </div>

        <div class="row mt-3">

            <h3>TASK SUBMISSIONS</h3>

            <hr>
            <div class="alert alert-info text-center text-uppercase text-bold card">
                PHASE 1
            </div>
            <div class="col-md-4 card">
                <div class="card p-4 bg-dark text-white">
                    <div class="d-flex  d-flex justify-content-between">
                        <div class="div">
                            Task Name
                        </div>
                        <div class="div ">
                            <div class="btn btn-warning btn-sm">Pending</div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident modi esse aut! Iste qui suscipit repellat modi laboriosam iure officiis soluta fugiat accusantium veritatis harum facilis, dolorem incidunt! Unde, obcaecati!

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            - 19-Mar 2023
                        </div>
                        <div class="col-md-6 text-italic">
                            - Bhavesh Kapoor
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-4 card">
                <div class="card p-4 bg-dark text-white">
                    <div class="d-flex  d-flex justify-content-between">
                        <div class="div">
                            Task Name
                        </div>
                        <div class="div ">
                            <div class="btn btn-warning btn-sm ">Pending</div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident modi esse aut! Iste qui suscipit repellat modi laboriosam iure officiis soluta fugiat accusantium veritatis harum facilis, dolorem incidunt! Unde, obcaecati!

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            - 19-Mar 2023
                        </div>
                        <div class="col-md-6 text-italic">
                            - Bhavesh Kapoor
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-md-4 card">
                <div class="card p-4 bg-dark text-white">
                    <div class="d-flex  d-flex justify-content-between">
                        <div class="div">
                            Task Name
                        </div>
                        <div class="div ">
                            <div class="btn btn-warning btn-sm">Pending</div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident modi esse aut! Iste qui suscipit repellat modi laboriosam iure officiis soluta fugiat accusantium veritatis harum facilis, dolorem incidunt! Unde, obcaecati!

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            - 19-Mar 2023
                        </div>
                        <div class="col-md-6 text-italic">
                            - Bhavesh Kapoor
                        </div>
                    </div>

                </div>

            </div>


            <div class="col-md-4 card">
                <div class="card p-4 bg-info text-white">
                    <div class="d-flex  d-flex justify-content-between">
                        <div class="div">
                            Task Name
                        </div>
                        <div class="div ">
                            <div class="btn btn-warning btn-sm">Pending</div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident modi esse aut! Iste qui suscipit repellat modi laboriosam iure officiis soluta fugiat accusantium veritatis harum facilis, dolorem incidunt! Unde, obcaecati!

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            - 19-Mar 2023
                        </div>
                        <div class="col-md-6 text-italic">
                            - Bhavesh Kapoor
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-4 card">
                <div class="card p-4 bg-warning text-white">
                    <div class="d-flex  d-flex justify-content-between">
                        <div class="div">
                            Task Name
                        </div>
                        <div class="div ">
                            <div class="btn btn-warning btn-sm">Pending</div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident modi esse aut! Iste qui suscipit repellat modi laboriosam iure officiis soluta fugiat accusantium veritatis harum facilis, dolorem incidunt! Unde, obcaecati!

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            - 19-Mar 2023
                        </div>
                        <div class="col-md-6 text-italic">
                            - Bhavesh Kapoor
                        </div>
                    </div>

                </div>

            </div>


            <div class="alert alert-info text-center text-uppercase text-bold">
                PHASE 1
            </div>
            <div class="col-md-4 card">
                <div class="card p-4 bg-dark text-white">
                    <div class="d-flex  d-flex justify-content-between">
                        <div class="div">
                            Task Name
                        </div>
                        <div class="div ">
                            <div class="btn btn-warning btn-sm">Pending</div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident modi esse aut! Iste qui suscipit repellat modi laboriosam iure officiis soluta fugiat accusantium veritatis harum facilis, dolorem incidunt! Unde, obcaecati!

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            - 19-Mar 2023
                        </div>
                        <div class="col-md-6 text-italic">
                            - Bhavesh Kapoor
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-4 card">
                <div class="card p-4 bg-dark text-white">
                    <div class="d-flex  d-flex justify-content-between">
                        <div class="div">
                            Task Name
                        </div>
                        <div class="div ">
                            <div class="btn btn-warning btn-sm ">Pending</div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident modi esse aut! Iste qui suscipit repellat modi laboriosam iure officiis soluta fugiat accusantium veritatis harum facilis, dolorem incidunt! Unde, obcaecati!

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            - 19-Mar 2023
                        </div>
                        <div class="col-md-6 text-italic">
                            - Bhavesh Kapoor
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-md-4 card">
                <div class="card p-4 bg-dark text-white">
                    <div class="d-flex  d-flex justify-content-between">
                        <div class="div">
                            Task Name
                        </div>
                        <div class="div ">
                            <div class="btn btn-warning btn-sm">Pending</div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident modi esse aut! Iste qui suscipit repellat modi laboriosam iure officiis soluta fugiat accusantium veritatis harum facilis, dolorem incidunt! Unde, obcaecati!

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            - 19-Mar 2023
                        </div>
                        <div class="col-md-6 text-italic">
                            - Bhavesh Kapoor
                        </div>
                    </div>

                </div>

            </div>


            <div class="col-md-4 card">
                <div class="card p-4 bg-info text-white">
                    <div class="d-flex  d-flex justify-content-between">
                        <div class="div">
                            Task Name
                        </div>
                        <div class="div ">
                            <div class="btn btn-warning btn-sm">Pending</div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident modi esse aut! Iste qui suscipit repellat modi laboriosam iure officiis soluta fugiat accusantium veritatis harum facilis, dolorem incidunt! Unde, obcaecati!

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            - 19-Mar 2023
                        </div>
                        <div class="col-md-6 text-italic">
                            - Bhavesh Kapoor
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-4 card">
                <div class="card p-4 bg-warning text-white">
                    <div class="d-flex  d-flex justify-content-between">
                        <div class="div">
                            Task Name
                        </div>
                        <div class="div ">
                            <div class="btn btn-warning btn-sm">Pending</div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident modi esse aut! Iste qui suscipit repellat modi laboriosam iure officiis soluta fugiat accusantium veritatis harum facilis, dolorem incidunt! Unde, obcaecati!

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            - 19-Mar 2023
                        </div>
                        <div class="col-md-6 text-italic">
                            - Bhavesh Kapoor
                        </div>
                    </div>

                </div>

            </div>




        </div>
    </div>
</div>

@endsection