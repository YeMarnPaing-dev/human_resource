@extends('layouts/master')

@section('title', 'Salary')


@section('content')

    <div class="table-container d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <form action="{{ url('salary') }}">
            <input type="text" class="searchInput " value="{{ request('searchKey') }}"
                placeholder="Search by name or email..." name="searchKey" />
            {{-- @can('create_dept') --}}
                <a href="{{ route('salary.create') }}" class="btn btn-primary btn-sm my-2"> <i
                        class="fa fa-plus"></i> Create Salary</a>
            {{-- @endcan --}}
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-nowrap">
                <thead>
                    <tr>

                        <th>Name</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Amount(MMK)</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($salaries as $salary)
                        <tr>

                            <td>{{ $salary->user_name }}</td>
                            <td>{{ $salary->month }}</td>
                            <td>{{ $salary->year }}</td>
                            <td>{{ $salary->amount }} MMK</td>


                            <td>


                                    <form action="{{ route('salary.destroy', $salary->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this post?')"
                                        class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>

                                <a href="{{ route('salary.edit', $salary->id) }}"
                                    class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>


                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>


    </div>
    <span>{{ $salaries->links() }}</span>
@endsection
