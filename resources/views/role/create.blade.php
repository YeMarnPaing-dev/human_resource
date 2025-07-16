@extends('layouts/master')

@section('title', 'Create Roles')


@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('roleManangement.store')}}" method="POST" id="create-form" >
                @csrf

    <div class="col-md-6 col-12"><div class="md-form">


                <div class="md-form">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>

            </div>

               <div class="row">
            @foreach ($permissions as $per)
                <div class="col-md-4 col-6">
                     <div class="form-check mt-2">
       <input class="form-check-input" name="permissions[]" type="checkbox" id="checkbox_{{$per->id}}" value="{{$per->name}}">
              <label class="form-check-label" for="checkbox_{{$per->id}}">
   {{$per->name}}
  </label>
              </div>
                </div>
            @endforeach
               </div>

                <div class="d-flex justify-content-center">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary my-3 btn-block">Confirm</button>
                    </div>

            </form>
        </div>
    </div>



@endsection

@section('script')
 {{!!JsValidator::formRequest('App\Http\Requests\StoreRole', '#create-form');!!}}
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
