@extends('layouts/master')

@section('title', 'Employees')


@section('content')

    <div class="table-container d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <form action="{{ url('employeeManangement') }}">
            <input type="text" class="searchInput " value="{{ request('searchKey') }}"
                placeholder="Search by name or email..." name="searchKey" />
            @can('create_employee')
                <a href="{{ route('employeeManangement.create') }}" class="btn btn-primary btn-sm my-2"> <i class="fa fa-plus"></i>
                    Create Employee</a>
            @endcan
        </form>

        <form action="{{ route('export#Excel') }}" method="POST" target="__blank">
            @csrf
            <a href=""><button class="btn btn-outline-danger">Export Excel</button></a>
        </form>

      <x-emp-table :$employees type='create'/>

    </div>
    <span>{{ $employees->links() }}</span>
@endsection
