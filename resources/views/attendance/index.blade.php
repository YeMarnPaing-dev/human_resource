@extends('layouts/master')

@section('title', 'Attendance')


@section('content')

    <div class="table-container d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <form action="{{ url('attendance') }}">
            <input type="text" class="searchInput " value="{{ request('searchKey') }}"
                placeholder="Search by name or email..." name="searchKey" />
            {{-- @can('create_dept') --}}
                <a href="{{ route('attendance.create') }}" class="btn btn-primary btn-sm my-2"> <i
                        class="fa fa-plus"></i> Create Attendance</a>
            {{-- @endcan --}}
        </form>
<form action="{{route('attendanceExcel')}}" method="POST" target="__blank">
            @csrf
            <a href=""><button class="btn btn-outline-danger">Export Excel</button></a>
        </form>
        <x-attendance :$attendances type='create'/>


    </div>
    <span>{{ $attendances->links() }}</span>
@endsection
