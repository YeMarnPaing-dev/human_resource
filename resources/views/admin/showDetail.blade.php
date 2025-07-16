@extends('layouts/master')

@section('title', 'Employee Details')


@section('content')

<div>
    <a href="{{route('admin#dashboard')}}"><input type="button" name="" class="btn btn-primary mb-2" value="Back" id=""></a>
</div>
<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-md-6 text-center">
                <img src="{{$employee->profile_img == null ? asset('userImage/default-avatar.png') : asset('employee/'. $employee->profile_img)}}" class=""
   style="width:120px;
    height: 120px;
    border-radius: 50%;
    border:1px solid #ddd;
    padding: 3px;" alt="">
     <div class="py-3 px-2">
                <h3>{{$employee->name}}</h3>
                <p class="text-muted mb-1">{{$employee->employee_id}}</p>
                <p class="text-muted mb-1">{{$employee->department ? $employee->department->name : ' '}}</p>
                <p class="text-muted mb-1">
                    @foreach ($employee->roles as $role)
                    <span class="badge badge-pill badge-primary">{{$role->name}}</span>
                    @endforeach
                </p>
            </div>
            </div>

            <div class="col-md-6 py-3 px-3" style="border-left:2px dashed #ddd;">

                 <p class="mb-1"><Strong>Phone</Strong> : <span class="text-muted">{{$employee->phone}}</span> </p>
                <p class="mb-1"><Strong>Email</Strong> : <span class="text-muted">{{$employee->email}}</span> </p>
                <p class="mb-1"><Strong>Nrc</Strong> : <span class="text-muted">{{$employee->nrc_number}}</span> </p>
                <p class="mb-1"><Strong>Gender</Strong> : <span class="text-muted">{{$employee->gender}}</span> </p>
                <p class="mb-1"><Strong>Birthday</Strong> : <span class="text-muted">{{$employee->birthday}}</span> </p>
                <p class="mb-1"><Strong>Address</Strong> : <span class="text-muted">{{$employee->address}}</span> </p>
                <p class="mb-1"><Strong>Join Date</Strong> : <span class="text-muted">{{$employee->date_of_join}}</span> </p>
                <p class="mb-1"><Strong>Is Present</Strong> : <span class="text-muted"> @if ($employee->is_present == 1)
                    <span class="badge  badege-pill badge-success">Present</span>
                    @else
                    <span class="badge badege-pill badge-danger">Leave</span>
                    @endif</span> </p>
            </div>

        </div>

    </div>
</div>

@endsection
