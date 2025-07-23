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
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-nowrap">
                <thead>
                    <tr>

                        <th>Employee Name</th>
                        <th>Date</th>
                        <th>Check In Time</th>
                        <th>Check Out Time</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $user)
                        <tr>

                            <td>{{ $user->user_name }}</td>
                            <td>{{ $user->date }}</td>
                            <td>{{ $user->checkin_time }}</td>
                            <td>{{ $user->checkout_time }}</td>
                            <td>


                                    <form action="{{ route('attendance.destroy', $user->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this post?')"
                                        class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>







                                <a href="{{ route('attendance.edit', $user->id) }}"
                                    class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>


                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>


    </div>
    <span>{{ $attendances->links() }}</span>
@endsection
