@extends('layouts/master')

@section('title', 'Attendance')


@section('content')

<div>
<a href="{{ route('admin#dashboard') }}">
    <button class="btn btn-danger btn-sm">Back</button>
</a>
</div>

 <div class="table-container d-flex justify-content-between align-items-center mb-3 flex-wrap">

    <h5>Attendance Record</h5>
        <form action="{{ url('attendance') }}">
            <input type="text" class="searchInput " value="{{ request('searchKey') }}"
                placeholder="Search by name or email..." name="searchKey" />

        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-nowrap">
                <thead>
                    <tr>

                        <th>Employee Name</th>
                        <th>Date</th>
                        <th>Check In Time</th>
                        <th>Check Out Time</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $user)
                        <tr>

                            <td>{{ $user->user_name }}</td>
                            <td>{{ $user->date }}</td>
                            <td>{{ $user->checkin_time }}</td>
                            <td>{{ $user->checkout_time }}</td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>


    </div>
    <span>{{ $attendances->links() }}</span>



@endsection


@section('script')
<script>
    $(document).ready(function () {
        // Load initial data

    });
</script>
@endsection
