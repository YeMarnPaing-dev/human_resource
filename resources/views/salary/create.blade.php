@extends('layouts/master')

@section('title', 'Create Salary')


@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('salary.store')}}" method="POST" id="create-form" >
                @csrf
<div class="row">

      <div class="md-form">
                    <label for="">Employee</label>
                    <select name="user_id" class="form-control select-hr" id="">
                        <option value="">---Please Choose---</option>
                       @foreach ($employee as $user)
                        <option value="{{$user->id}}" @if (old('user_id') == $user->id)
                            selected
                        @endif>{{$user->employee_id}} ({{$user->name}})</option>
                       @endforeach
                    </select>
                </div>

        <div class="row mt-3">
            <div class="col-md-6">
                         <div class="form-group ">
                    <select name="month" class="form-control select-hr select-month" id="">
                    <option value=""> ---PleaseChoose(Month) --- </option>
                    <option value="01">Jan</option>
                    <option value="02">Feb</option>
                    <option value="03">Mar</option>
                    <option value="04">Apr</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">Aug</option>
                    <option value="09">Sept</option>
                    <option value="10">Oct</option>
                    <option value="11">Nov</option>
                    <option value="12">Dec</option>
                </select>
                </div>
            </div>
            <div class="col-md-6">
                        <div class="form-group">
                    <select name="year" class="form-control select-hr select-year" id="">
                    <option value=""> ---PleaseChoose(Year) --- </option>
                    @for ($i = 0; $i < 10 ; $i++)
                    <option value="{{now()->subYear($i)->format('Y')}}">
                        {{now()->subYear($i)->format('Y')}}</option>
                    @endfor
                </select>
                </div>
            </div>
        </div>

        <div class="md-form">
            <label for="">Amount(MMK)</label>
            <input type="number" name="amount" class="form-control">
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
 {{!!JsValidator::formRequest('App\Http\Requests\StoreSalary', '#create-form');!!}}
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
