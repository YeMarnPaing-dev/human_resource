@extends('layouts/master')

@section('title', 'Create Project')


@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('project.store')}}" method="POST" id="create-form" >
                @csrf
<div class="row">



                <div class="md-form">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="md-form">
                    <label for="">Description</label>
                   <textarea name="description" id="" class="form-control"></textarea>
                </div>

                {{-- <div class="form-group">
  <label for="profile_img"> Image</label>
  <input type="file" name="image" class="form-control" id="image" >
  <div class="preview mt-2"></div>
</div> --}}

 {{-- <div class="form-group">
  <label for="files">File[Only PDF]</label>
  <input type="file" name="files[]" class="form-control" id="pdf" multiple>

</div> --}}

            <div class="row">
               <div class="col-6">
                 <div class="md-form">
                    <label for="">Start Date</label>
                    <input type="text"  name="start_date" class="form-control datepicker">
                </div>
               </div>

               <div class="col-6">
                 <div class="md-form">
                    <label for="">Dead Line</label>
                    <input type="text"  name="dead_line" class="form-control datepicker">
                </div>
               </div>
            </div>

            <div class="form-group">
                <label for="">Leader</label>
                <select name="leaders[]" class="form-control select-hr" id="" multiple>
                    <option value="">Please Choose</option>
                    @foreach ($employees as  $user)
                    <option value="{{$user->id}}">{{$user->employee_id}} - {{$user->name}}  </option>
                    @endforeach
                </select>
            </div>

               <div class="form-group">
                <label for="">Member</label>
                <select name="members[]" class="form-control select-hr" id="" multiple>
                    <option value="">Please Choose</option>
                    @foreach ($employees as  $user)
                    <option value="{{$user->id}}">{{$user->employee_id}} - {{$user->name}}  </option>
                    @endforeach
                </select>
            </div>


         <div class="row">
            <div class="col-md-6">
                   <div class="md-form">
                <label for="">Priority</label>
                <select name="priority" class="form-control  select-hr" id="">
                    <option value="">---Please Choose Priority</option>
                    <option value="high">High</option>
                    <option value="middle">Middle</option>
                    <option value="low">Low</option>
                </select>
            </div>
            </div>
            <div class="col-md-6">
                   <div class="md-form">
                <label for="">Status</label>
                <select name="status" class="form-control select-hr" id="">
                    <option value="">---Please Choose Status</option>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="complete">Complete</option>
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
 {{!!JsValidator::formRequest('App\Http\Requests\StoreProject', '#create-form');!!}}
    <script>

     $(document).ready(function(){

          $('#image').on('change', function (event) {
    const files = event.target.files;
    $('.preview').html(''); // Clear previous preview

    for (let i = 0; i < files.length; i++) {
      const imageUrl = URL.createObjectURL(files[i]);
      $('.preview').append(`<img src="${imageUrl}" class="img-thumbnail" style="max-width: 150px; margin: 5px;" />`);
    }
  });

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
