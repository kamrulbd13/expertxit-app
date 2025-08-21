@extends('backend.layout.master')

@section('mainContent')
    <div class="page-header">
        <h3 class="page-title">
            Dashboard
        </h3>
    </div>
    <div class="row grid-margin">
        <div class="col-12">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="statistics-item">
                            <p>
                                <i class="icon-sm fa fa-university mr-2"></i>
                                Course Booking
                            </p>
                            <h2>{{0}}</h2>
                            <a href="" class="nav-link text-success badge badge-outline-success badge-pill">Details</a>
                        </div>
                        <div class="statistics-item">
                            <p>
                                <i class="icon-sm fas fa-users mr-2"></i>
                                Total Trainer
                            </p>
                            <h2>{{$totalTrainer}}</h2>
                            <a href="" class="nav-link text-warning badge badge-outline-warning badge-pill">Details</a>
                        </div>
                        <div class="statistics-item">
                            <p>
                                <i class="icon-sm fas fa-check-circle mr-2"></i>
                                Total Training
                            </p>
                            <h2>{{$totalTraining}}</h2>
                            <a href="" class="nav-link text-info badge badge-outline-info badge-pill">Details</a>
                        </div>
                        <div class="statistics-item">
                            <p>
                                <i class="icon-sm fas fa-check-circle mr-2"></i>
                                Total Trainee
                            </p>
                            <h2>{{$totalChild}}</h2>
                            <a href="" class="nav-link text-danger badge badge-outline-danger badge-pill">Details</a>
                        </div>
                        <div class="statistics-item">
                            <p>
                                <i class="icon-sm fas fa-chart-line mr-2"></i>
                                Total Batch
                            </p>
                            <h2>{{$totalAcademicSession}}</h2>
                            <a href="" class="nav-link text-light badge badge-outline-light badge-pill">Details</a>
                        </div>
                        <div class="statistics-item">
                            <p>
                                <i class="icon-sm fas fa-circle-notch mr-2"></i>
                                Total Event
                            </p>
                            <h2>{{0}}</h2>
                            <a href="#" class="nav-link text-danger badge badge-outline-danger badge-pill">Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-user-plus"></i>
                        New Trainee Information
                    </h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Admission Date</th>
                                <th>Contact</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            $sl = 1;
                            @endphp
                            @foreach($latestChildes as $latestChild)
                            <tr>
                                <td>{{$sl ++}}</td>
                                <td class="font-weight-bold">
                                    {{$latestChild->name}}
                                </td>
                                <td class="text-muted">
                                    {{$latestChild->created_at->format('d M-Y')}}
                                </td>
                                <td>
                                    {{$latestChild->phone}}
                                </td>
                                <td>
                                    <label class="{{ $latestChild->status === 1 ? 'badge-success' : 'badge-warning' }} badge  badge-pill " >{{$latestChild->status === 1 ? 'Complete' : 'Pending'}}</label>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-calendar-alt"></i>
                        Calendar
                    </h4>
                    <div id="inline-datepicker-example" class="datepicker"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
