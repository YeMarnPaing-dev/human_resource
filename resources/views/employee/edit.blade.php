@extends('layouts/master')

@section('title', 'Update Employees')


@section('content')
<div>
    <a href="{{route('employeeManangement.index')}}"><input type="button" name="" class="btn btn-primary mb-2" value="Back" id=""></a>
</div>
    <div class="card">
        <div class="card-body">
            <form action="{{route('employeeManangement.update',$employee->id)}}" method="POST" id="update-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
<div class="row">
    <div class="col-lg-6"><div class="md-form">
                    <label for="">Employee Id</label>
                    <input type="text" name="employee_id" value="{{$employee->employee_id}}" class="form-control">
                </div>

                <div class="md-form">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{$employee->name}}" class="form-control">
                </div>

                <div class="md-form">
                    <label for="">Phone</label>
                    <input type="number" name="phone" value="{{$employee->phone}}"  class="form-control">
                </div>

                <div class="md-form">
                    <label for="">Email</label>
                    <input type="email" name="email" value="{{$employee->email}}" class="form-control">
                </div>

                <div class="md-form">
                    <label for="">NRC Number</label>
                    <input type="text" name="nrc_number" value="{{$employee->nrc_number}}" class="form-control">
                </div>

                <div class="md-form">
                    <label for="">Gender</label>
                    <select name="gender" class="form-control" id="">

                        <option @if ($employee->gender == 'male')   selected @endif value="male">Male</option>
                        <option @if ($employee->gender == 'female')   selected @endif value="female">Female</option>

                    </select>
                </div>
             <div class="md-form">
                    <label for="">Birthday</label>
                    <input type="text"  name="birthday" value="{{$employee->birthday}}" class="form-control birthday">
                </div>
            </div>

     <div class="col-lg-6">


                 <div class="md-form">
                    <label for="">Address</label>
                   <textarea name="address"  cols="20" class="form-control" rows="5">{{$employee->address}}"</textarea>
                </div>

                <div class="md-form">
                    <label for="">Department</label>
                    <select name="department_id" class="form-control" id="">
                      @foreach ($departments as $item)
                      <option @if ($employee->department_id == $item->id)   selected @endif value="{{$item->id}}" >{{$item->name}}</option>
                      @endforeach
                    </select>
                </div>

                 <div class="md-form">
                    <label for="">Role 0r Designation</label>
                    <select name="roles[]" class="form-control select-hr" id="" multiple>
                      @foreach ($roles as $role)
                      <option value="{{$role->name}}" @if (in_array($role->id, $old))
                        selected
                      @endif >{{$role->name}}</option>
                      @endforeach
                    </select>
                </div>


                <div class="md-form">
                    <label for="">Join Date</label>
                    <input type="text"  name="dateOfJoin" value="{{$employee->date_of_join}}" class="form-control dateOfJoin">
                </div>
                <div class="md-form">
                    <label for="">Is_Present</label>
                    <select name="is_present" class="form-control" id="">
                        <option @if ($employee->is_present == '1')   selected @endif value="1">Present</option>
                        <option @if ($employee->is_present == '0')   selected @endif value="0">Absent</option>
                    </select>
                </div>
                              <div class="form-group">
  <label for="profile_img">Profile Image</label>
  <input type="file" name="image" class="form-control" id="profile_img" >
  <div class="preview mt-2">
    @if ($employee->profile_img)
    <img src="{{$employee->profile_img_path()}}" style="width: 150px; height: 150px;" >
    @endif
  </div>
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
 {{!!JsValidator::formRequest('App\Http\Requests\UpdateForm', '#update-form');!!}}
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
