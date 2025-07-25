@extends('layouts/master')

@section('title', 'Update Employees')


@section('content')
<div>
    <a href="{{route('roleManangement.index')}}"><input type="button" name="" class="btn btn-primary mb-2" value="Back" id=""></a>
</div>
    <div class="card">
        <div class="card-body">
            <form action="{{route('roleManangement.update',$role->id)}}" method="POST" id="update-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
<div class="row">


                <div class="md-form">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{$role->name}}" class="form-control">
                </div>

             <div class="row">
            @foreach ($permissions as $per)
                <div class="col-md-4 col-6">
                     <div class="form-check mt-2">
       <input class="form-check-input" name="permissions[]" type="checkbox" id="checkbox_{{$per->id}}" value="{{$per->name}}" @if (in_array($per->id, $old))
       checked
       @endif>
              <label class="form-check-label" for="checkbox_{{$per->id}}">
   {{$per->name}}
  </label>
              </div>
                </div>
            @endforeach
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
 {{!!JsValidator::formRequest('App\Http\Requests\UpdateForm', '#update-form');!!}}
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
    </script>

@endsection
