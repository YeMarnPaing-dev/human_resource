@extends('layouts/master')

@section('title','Humarn Resourse')


@section('content')


<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="text-center ">
                <img src="{{Auth::user()->profile_img == null ? asset('userImage/default-avatar.png') : asset('employee/'. Auth::user()->profile_img)}}" class=""
   style="width:120px;
    height: 120px;
    border-radius: 50%;
    border:1px solid #ddd;
    padding: 3px;" alt="">
     <div class="py-3 px-2">
                <h3>{{Auth::user()->name}}</h3>
                <p class=" mb-1">{{Auth::user()->employee_id}} | <span class="">{{Auth::user()->phone}}</span></p>
                <p class="text-muted mb-1"><span style="border-radius: 10px" class="badge badge-dark  p-2">{{Auth::user()->department ? Auth::user()->department->name : ' '}} Department</span></p>
            </div>
            </div>

            {{-- <div class="col-md-6 py-3 px-3" style="border-left:2px dashed #ddd;">

                 <p class="mb-1"><Strong>Phone</Strong> : <span class="text-muted">{{Auth::user()->phone}}</span> </p>
                <p class="mb-1"><Strong>Email</Strong> : <span class="text-muted">{{Auth::user()->email}}</span> </p>
                <p class="mb-1"><Strong>Nrc</Strong> : <span class="text-muted">{{Auth::user()->nrc_number}}</span> </p>
                <p class="mb-1"><Strong>Gender</Strong> : <span class="text-muted">{{Auth::user()->gender}}</span> </p>
                <p class="mb-1"><Strong>Birthday</Strong> : <span class="text-muted">{{Auth::user()->birthday}}</span> </p>
                <p class="mb-1"><Strong>Address</Strong> : <span class="text-muted">{{Auth::user()->address}}</span> </p>
                <p class="mb-1"><Strong>Join Date</Strong> : <span class="text-muted">{{Auth::user()->date_of_join}}</span> </p>
                <p class="mb-1"><Strong>Is Present</Strong> : <span class="text-muted"> @if (Auth::user()->is_present == 1)
                    <span class="badge adege-pill badge-success">Present</span>
                    @else
                    <span class="badge adege-pill badge-danger">Leave</span>
                    @endif</span> </p>
            </div> --}}

        </div>

    </div>
</div>


@endsection
