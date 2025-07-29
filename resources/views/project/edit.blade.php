{{-- @extends('layouts/master')

@section('title', 'Update Projects')


@section('content')
<div>
    <a href="{{route('project.index')}}"><input type="button" name="" class="btn btn-primary mb-2" value="Back" id=""></a>
</div>
    <div class="card ">
        <div class="card-body">
            <form action="{{route('project.update',$project->id)}}" method="POST" id="update-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
<div class="row">


                <div class="md-form">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{$project->title}}" class="form-control">
                </div>
     <div class="col-md-6 ">
                <div class="d-flex justify-content-center">
                    <div class="">
                        <button type="submit" class="btn btn-primary my-3 btn-block">Confirm Button</button>
                    </div>
                </div>
            </form>

    </div>



@endsection

@section('script')
 {{!!JsValidator::formRequest('App\Http\Requests\ProjectUpdateForm', '#update-form');!!}}
    <script>

//        $(document).ready(function(){
//         $('.birthday').daterangepicker({
// 'singleDatePicker':true,
// 'autoApply':true,
// 'maxDate':moment(),
//  "showDropdowns": true,
// 'locale':{
//     'format':'YYYY-MM-DD',
// }
// });

//  $('.dateOfJoin').daterangepicker({
// 'singleDatePicker':true,
// 'autoApply':true,
//  "showDropdowns": true,
// 'locale':{
//     'format':'YYYY-MM-DD',
// }
// });

//   $('#profile_img').on('change', function (event) {
//     const files = event.target.files;
//     $('.preview').html(''); // Clear previous preview

//     for (let i = 0; i < files.length; i++) {
//       const imageUrl = URL.createObjectURL(files[i]);
//       $('.preview').append(`<img src="${imageUrl}" class="img-thumbnail" style="max-width: 150px; margin: 5px;" />`);
//     }
//   });

//        });
    </script> --}}

{{-- @endsection --}}

@extends('layouts/master')

@section('title', 'Update Project')


@section('content')
<div>
    <a href="{{route('project.index')}}"><input type="button" name="" class="btn btn-primary mb-2" value="Back" id=""></a>
</div>
    <div class="card">
        <div class="card-body">
            <form action="{{route('project.update',$project->id)}}" method="POST" id="update-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')

<div class="row">



                <div class="md-form">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{$project->title}}" class="form-control">
                </div>

                <div class="md-form">
                    <label for="">Description</label>
                   <textarea name="description" id="" value="" class="form-control">{{$project->description}}</textarea>
                </div>



            <div class="row">
               <div class="col-6">
                 <div class="md-form">
                    <label for="">Start Date</label>
                    <input type="text"  name="start_date" value="{{$project->start_date}}" class="form-control datepicker">
                </div>
               </div>

               <div class="col-6">
                 <div class="md-form">
                    <label for="">Dead Line</label>
                    <input type="text"  name="dead_line" value="{{$project->dead_line}}" class="form-control datepicker">
                </div>
               </div>
            </div>

         <div class="row">
            <div class="col-6">
                   <div class="md-form">
                <label for="">Priority</label>
                <select name="priority" class="form-control  select-hr" id="">
                    <option value="">---Please Choose Priority</option>
                    <option value="high" @if ($project->priority == 'high')  selected      @endif>High</option>
                    <option value="middle"  @if ($project->priority == 'middle')  selected      @endif>Middle</option>
                    <option value="low"  @if ($project->priority == 'low')  selected      @endif>Low</option>
                </select>
            </div>
            </div>
            <div class="col-6">
                   <div class="md-form">
                <label for="">Status</label>
                <select name="status" class="form-control select-hr" id="">
                    <option value="">---Please Choose Status</option>
                    <option value="pending"  @if ($project->status == 'pending')  selected      @endif>Pending</option>
                    <option value="in_progress" @if ($project->status == 'in_progress')  selected      @endif>In Progress</option>
                    <option value="complete" @if ($project->status == 'complete')  selected      @endif>Complete</option>
                </select>
            </div>
            </div>
         </div>

                <div class="d-flex justify-content-center">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary my-3 btn-block">Confirm</button>
                    </div>
                </div>
            </form>

    </div>



@endsection

@section('script')
 {{!!JsValidator::formRequest('App\Http\Requests\ProjectUpdateForm', '#create-form');!!}}
    <script>

     $(document).ready(function(){

   $('.datepicker').daterangepicker({
'singleDatePicker':true,
'autoApply':true,
 "showDropdowns": true,
'locale':{
    'format':'YYYY-MM-DD',
}
});
//         $('.birthday').daterangepicker({
// 'singleDatePicker':true,
// 'autoApply':true,
// 'maxDate':moment(),
//  "showDropdowns": true,
// 'locale':{
//     'format':'YYYY-MM-DD',
// }
// });

//  $('.dateOfJoin').daterangepicker({
// 'singleDatePicker':true,
// 'autoApply':true,
//  "showDropdowns": true,
// 'locale':{
//     'format':'YYYY-MM-DD',
// }
// });

//   $('#profile_img').on('change', function (event) {
//     const files = event.target.files;
//     $('.preview').html(''); // Clear previous preview

//     for (let i = 0; i < files.length; i++) {
//       const imageUrl = URL.createObjectURL(files[i]);
//       $('.preview').append(`<img src="${imageUrl}" class="img-thumbnail" style="max-width: 150px; margin: 5px;" />`);
//     }
//   });
      });
    </script>

@endsection

