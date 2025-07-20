@extends('layouts/master')

@section('title', 'Company Setting')


@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <p class="mb-1">Company name</p>
                <p class="mb-1 text-muted">{{$setting->company_name}}</p>
            </div>

            <div class="col-md-6 mb-3">
                <p class="mb-1">Company Phone</p>
                <p class="mb-1 text-muted">{{$setting->company_phone}}</p>
            </div>

            <div class="col-md-6 mb-3">
                <p class="mb-1">Company email</p>
                <p class="mb-1 text-muted">{{$setting->company_email}}</p>
            </div>

            <div class="col-md-6 mb-3">
                <p class="mb-1">Company address</p>
                <p class="mb-1 text-muted">{{$setting->company_address}}</p>
            </div>

            <div class="col-md-6 mb-3">
                <p class="mb-1">Office Start Time</p>
                <p class="mb-1 text-muted">{{$setting->office_start_time}}</p>
            </div>

            <div class="col-md-6 mb-3">
                <p class="mb-1">Office End Time</p>
                <p class="mb-1 text-muted">{{$setting->office_end_time}}</p>
            </div>

            <div class="col-md-6 mb-3">
                <p class="mb-1">Break Start Time</p>
                <p class="mb-1 text-muted">{{$setting->break_start_time}}</p>
            </div>

            <div class="col-md-6 mb-3">
                <p class="mb-1">Break End Time</p>
                <p class="mb-1 text-muted">{{$setting->break_end_time}}</p>
            </div>
        </div>

        <div>
            <a href="{{route('companySetting.edit',1)}}" class="btn btn-primary btn-sm">
             <i class="fa-solid fa-pen-to-square"></i>   Edit Company
            </a>
        </div>
    </div>
</div>

@endsection
