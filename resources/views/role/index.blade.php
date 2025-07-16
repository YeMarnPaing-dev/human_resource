@extends('layouts/master')

@section('title', 'Role')


@section('content')

    <div class="table-container d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <form action="{{ url('roleManangement') }}">
            <input type="text" class="searchInput " value="{{ request('searchKey') }}"
                placeholder="Search by name ..." name="searchKey" />
                <a href="{{route('roleManangement.create')}}" class="btn btn-primary btn-sm my-2"> <i class="fa fa-plus"></i> Create role</a>
        </form>
             <div class="table-responsive">
                  <table class="table table-bordered table-hover align-middle text-nowrap">
            <thead>
                <tr>

                    <th>Name</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $user)
                    <tr>

                        <td>{{ $user->name }}</td>


                        <td>

                              <form action="{{route('roleManangement.destroy',$user->id)}}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this post?')" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>



                            <a href="{{route('roleManangement.edit',$user->id)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>


                        </td>
                    </tr>

                @endforeach
            </tbody>

        </table>
             </div>


    </div>
     <span>{{$roles->links()}}</span>
@endsection
