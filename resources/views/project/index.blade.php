@extends('layouts/master')

@section('title', 'Projects')


@section('content')

    <div class="table-container d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <form action="{{ url('project') }}">
            <input type="text" class="searchInput " value="{{ request('searchKey') }}"
                placeholder="Search by name or email..." name="searchKey" />
            @can('create_dept')
                <a href="{{ route('project.create') }}" class="btn btn-primary btn-sm my-2"> <i class="fa fa-plus"></i> Create
                    Project</a>
            @endcan
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-nowrap">
                <thead>
                    <tr>

                        <th>Name</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>Dead Line</th>
                        <th>Pirority</th>
                        <th>Status</th>
                        <th>Leaders</th>
                        <th>Members</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $user)
                        <tr>

                            <td>{{ $user->title }}</td>
                            <td>{{ \Illuminate\Support\Str::words($user->description, 5, '...') }}</td>
                            <td>{{ $user->start_date }}</td>
                            <td>{{ $user->dead_line }}</td>
                            <td>
                                @if ($user->priority == 'high')
                                    <span class="badge badge-pill badge-danger">High</span>
                                @elseif ($user->priority == 'middle')
                                    <span class="badge badge-pill badge-warning">Middle</span>
                                @else
                                    <span class="badge badge-pill badge-success">Low</span>
                                @endif
                            </td>

                            <td>
                                @if ($user->status == 'in_progress')
                                    <span class="badge badge-pill badge-primary">in_progress</span>
                                @elseif ($user->status == 'pending')
                                    <span class="badge badge-pill badge-danger">pending</span>
                                @else
                                    <span class="badge badge-pill badge-success">complete</span>
                                @endif
                            </td>
                            <td>
                                @foreach (explode(',', $user->leader_name) as $name)
                                    <span class="badge badge-danger">{{ trim($name) }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach (explode(',', $user->member_name) as $name)
                                    <span class="badge badge-primary">{{ trim($name) }}</span>
                                @endforeach
                            </td>
                            <td>


                                <form action="{{ route('project.destroy', $user->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this post?')"
                                        class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>







                                <a href="{{ route('project.edit', $user->id) }}" class="btn btn-sm btn-primary"><i
                                        class="fa-solid fa-pen-to-square"></i></a>


                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>


    </div>
    <span>{{ $projects->links() }}</span>
@endsection
