@props([
    'employees' => new App\Models\User
])
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
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge badge-primary">{{ $user->role_names }}</span></td>
                            <td>{{ $user->nrc_number }}</td>
                            <td>

                                @if ($user->is_present == 1)
                                    <span
                                        class="badge badge-pill badge-light border border-success text-success">Present</span>
                                @elseif ($user->is_present == 0)
                                    <span class="badge badge-pill badge-light border border-danger text-danger">Leave</span>
                                @endif
                            </td>
                            <td>

                                <form action="{{ route('employeeManangement.destroy', $user->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this post?')"
                                        class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>



                                <a href="{{ route('employeeManangement.edit', $user->id) }}"
                                    class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>

                                <a href="{{ route('employeeManangement.show', $user->id) }}"
                                    class="btn btn-sm btn-success"><i class="fa-solid fa-circle-user"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
