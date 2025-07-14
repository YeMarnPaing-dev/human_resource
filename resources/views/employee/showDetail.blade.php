@extends('layouts/master')

@section('title', 'Employee Details')


@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
             <div class="col-md-6">
            <div class="mb-3">
                <p class="mb-1"><i class="fa-brands fa-gg"></i> Employee Id</p>
                <p class="mb-1 text-muted">{{$employee->name}}</p>
            </div>
            <div class="mb-3">
                <p class="mb-1"><i class="fa-brands fa-gg"></i> Name</p>
                <p class="mb-1 text-muted">{{$employee->name}}</p>
            </div>

             <div class="mb-3">
                <p class="mb-1"><i class="fa-brands fa-gg"></i> Email</p>
                <p class="mb-1 text-muted">{{$employee->email}}</p>
            </div>

            <div class="mb-3">
                <p class="mb-1"><i class="fa-brands fa-gg"></i> Phone</p>
                <p class="mb-1 text-muted">{{$employee->phone}}</p>
            </div>
            <div class="mb-3">
                <p class="mb-1"><i class="fa-brands fa-gg"></i>  Address</p>
                <p class="mb-1 text-muted">{{$employee->address}}</p>
            </div>
            <div class="mb-3">
                <p class="mb-1"><i class="fa-brands fa-gg"></i>  Nrc-number</p>
                <p class="mb-1 text-muted">{{$employee->nrc_number}}</p>
            </div>
        </div>
         <div class="col-md-6">
            <div class="mb-3">
                <p class="mb-1"><i class="fa-brands fa-gg"></i> Departments</p>
                <p class="mb-1 text-muted">{{$employee->department ? $employee->department->name : ''}}</p>
            </div>
            <div class="mb-3">
                <p class="mb-1"><i class="fa-brands fa-gg"></i> Birthday</p>
                <p class="mb-1 text-muted">{{$employee->birthday}}</p>
            </div>
            <div class="mb-3">
                <p class="mb-1"><i class="fa-brands fa-gg"></i> Joint Date</p>
                <p class="mb-1 text-muted">{{$employee->date_of_join}}</p>
            </div>
            <div class="mb-3">
                <p class="mb-1"><i class="fa-brands fa-gg"></i>  Gender</p>
                <p class="mb-1 text-muted">{{$employee->gender}}</p>
            </div>
            <div class="mb-3">
                <p class="mb-1"><i class="fa-brands fa-gg"></i>  Is-Present</p>
                <p class="mb-1 text-muted">
                    @if ($employee->is_present == 1)
                    <span class="badge adege-pill badge-success">Present</span>
                    @else
                    <span class="badge adege-pill badge-danger">Leave</span>
                    @endif
                </p>
            </div>
        </div>
        </div>
    </div>
</div>

@endsection
