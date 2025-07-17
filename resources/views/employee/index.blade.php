@extends('layouts/master')

@section('title', 'Employees')


@section('content')

    <div class="table-container d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <form action="{{ url('employeeManangement') }}">
            <input type="text" class="searchInput " value="{{ request('searchKey') }}"
                placeholder="Search by name or email..." name="searchKey" />
                @can('create_employee')
                 <a href="{{route('employeeManangement.create')}}" class="btn btn-primary btn-sm my-2"> <i class="fa fa-plus"></i> Create Employee</a>
                @endcan
        </form>
             <div class="table-responsive">
                  <table class="table table-bordered table-hover align-middle text-nowrap">
            <thead>
                <tr>
                    <th>Employee Id</th>
                    <th>Department</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Nrc Number</th>
                    <th>Is-Present</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $user)
                    <tr>
                        <td>{{ $user->employee_id }}</td>
                        <td>{{ $user->department_name }}</td>
                        <td>{{ $user->user_name }}</td>
                        <td>{{ $user->phone}}</td>
                        <td>{{ $user->email }}</td>
                        <td><span class="badge badge-primary">{{$user->role_names}}</span></td>
                        <td>{{ $user->nrc_number }}</td>
                        <td>

                            @if ($user->is_present == 1)
                                <span class="badge badge-pill badge-light border border-success text-success">Present</span>
                            @elseif ($user->is_present == 0)
                                <span class="badge badge-pill badge-light border border-danger text-danger">Leave</span>
                            @endif
                        </td>
                        <td>

                              <form action="{{ route('employeeManangement.destroy',$user->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this post?')" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>



                            <a href="{{route('employeeManangement.edit',$user->id)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>

                            <a href="{{route('employeeManangement.show',$user->id)}}" class="btn btn-sm btn-success"><i class="fa-solid fa-circle-user"></i></a>
                        </td>
                    </tr>

                @endforeach
            </tbody>

        </table>
             </div>


    </div>
     <span>{{$employees->links()}}</span>
@endsection
