@extends('layouts/master')

@section('title','Humarn Resourse')


@section('content')


<div class="card mb-3">
    <div class="card-body">

        <div class="row">
            <div class="text-center ">
                <a href="{{route('admin#profile')}}"><img src="{{Auth::user()->profile_img == null ? asset('userImage/default-avatar.png') : asset('employee/'. Auth::user()->profile_img)}}" class=""
   style="width:120px;
    height: 120px;
    border-radius: 50%;
    border:1px solid #ddd;
    padding: 3px;" alt=""></a>
     <div class="py-3 px-2">
                <h3>{{Auth::user()->name}}</h3>
                <p class=" mb-1">{{Auth::user()->employee_id}} | <span class="">{{Auth::user()->phone}}</span></p>
               <a href="{{asset('employee/'.Auth::user()->profile_img)}}" download=""> <p class="text-muted mb-1"><span style="border-radius: 10px" class="badge badge-dark  p-2">{{Auth::user()->department ? Auth::user()->department->name : ' '}} Department</span></p></a>

            </div>
            </div>



        </div>

    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <a href="{{route('owner#attendance')}}" >
        <button class="btn btn-sm btn-outline-primary">My Attendance</button>
       </a>

       <form action="{{route('logout')}}" method="POST">
        @csrf
        <input class="logout-btn btn btn-danger mt-3" type="submit" value="logout"></input>
       </form>



    </div>
</div>


@endsection
{{-- @section('script')

<script>
    $(document).ready(function(){
        $('.logout-btn').on('click', function(e){
e.preventDefault();
$.ajax({
    url:'auth/logout',
    type:'POST'

}).done(function(res){
window.location.reload();
});
        });
    });
</script>

@endsection --}}
