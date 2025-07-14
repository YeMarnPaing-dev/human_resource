@extends('layouts/master')

@section('title', 'Create Employees')


@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('employeeManangement.store')}}" method="POST" id="create-form" enctype="multipart/form-data">
                @csrf
<div class="row">
    <div class="col-lg-6"><div class="md-form">
                    <label for="">Employee Id</label>
                    <input type="text" name="employee_id" class="form-control">
                </div>

                <div class="md-form">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="md-form">
                    <label for="">Phone</label>
                    <input type="number" name="phone" class="form-control">
                </div>

                <div class="md-form">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="md-form">
                    <label for="">NRC Number</label>
                    <input type="text" name="nrc_number" class="form-control">
                </div>

                <div class="md-form">
                    <label for="">Gender</label>
                    <select name="gender" class="form-control" id="">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
             <div class="md-form">
                    <label for="">Birthday</label>
                    <input type="text"  name="birthday" class="form-control birthday">
                </div>
            </div>

     <div class="col-lg-6">


                 <div class="md-form">
                    <label for="">Address</label>
                   <textarea name="address"  cols="20" class="form-control" rows="5"></textarea>
                </div>

                <div class="md-form">
                    <label for="">Department</label>
                    <select name="department_id" class="form-control" id="">
                      @foreach ($departments as $item)
                      <option value="{{$item->id}}" >{{$item->name}}</option>
                      @endforeach
                    </select>
                </div>

                <div class="md-form">
                    <label for="">Join Date</label>
                    <input type="text"  name="dateOfJoin" class="form-control dateOfJoin">
                </div>
                <div class="md-form">
                    <label for="">Is_Present</label>
                    <select name="is_present" class="form-control" id="">
                        <option value="1">Present</option>
                        <option value="0">Absent</option>
                    </select>
                </div>

               <div class="form-group">
  <label for="profile_img">Profile Image</label>
  <input type="file" name="image" class="form-control" id="profile_img" >
  <div class="preview mt-2"></div>
</div>


                <div class="md-form">
                    <label for="">Password</label>
                    <input type="password"  name="password" class="form-control">
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
    </div>



@endsection

@section('script')
 {{!!JsValidator::formRequest('App\Http\Requests\StoreEmployee', '#create-form');!!}}
    <script>

       $(document).ready(function(){
        $('.birthday').daterangepicker({
'singleDatePicker':true,
'autoApply':true,
'maxDate':moment(),
 "showDropdowns": true,
'locale':{
    'format':'YYYY-MM-DD',
}
});

 $('.dateOfJoin').daterangepicker({
'singleDatePicker':true,
'autoApply':true,
 "showDropdowns": true,
'locale':{
    'format':'YYYY-MM-DD',
}
});

  $('#profile_img').on('change', function (event) {
    const files = event.target.files;
    $('.preview').html(''); // Clear previous preview

    for (let i = 0; i < files.length; i++) {
      const imageUrl = URL.createObjectURL(files[i]);
      $('.preview').append(`<img src="${imageUrl}" class="img-thumbnail" style="max-width: 150px; margin: 5px;" />`);
    }
  });
       });
    </script>

@endsection
