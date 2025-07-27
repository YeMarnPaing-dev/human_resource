@extends('layouts/master')

@section('title', 'Update Salaries')


@section('content')
<div>
    <a href="{{route('salary.index')}}"><input type="button" name="" class="btn btn-primary mb-2" value="Back" id=""></a>
</div>
    <div class="card">
        <div class="card-body">
            <form action="{{route('salary.update',$salary->id)}}" method="POST" id="update-form" ">
                @csrf
                @method('PUT')
<div class="row">


           <div class="row">

      <div class="md-form">
                    <label for="">Employee</label>
                    <select name="user_id" class="form-control select-hr" id="">
                        <option value="">---Please Choose---</option>
                       @foreach ($employee as $user)
                        <option value="{{$user->id}}" @if (old('user_id',$salary->user_id) == $user->id)
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
                    <option value="01" @if($salary->month == '01' ) selected  @endif >Jan</option>
                    <option value="02" @if($salary->month == '02' ) selected  @endif >Feb</option>
                    <option value="03" @if($salary->month == '03' ) selected  @endif >Mar</option>
                    <option value="04" @if($salary->month == '04' ) selected  @endif >Apr</option>
                    <option value="05" @if($salary->month == '05' ) selected  @endif >May</option>
                    <option value="06" @if($salary->month == '06' ) selected  @endif >June</option>
                    <option value="07" @if($salary->month == '07' ) selected  @endif >July</option>
                    <option value="08" @if($salary->month == '08' ) selected  @endif >Aug</option>
                    <option value="09" @if($salary->month == '09' ) selected  @endif >Sept</option>
                    <option value="10" @if($salary->month == '10' ) selected  @endif >Oct</option>
                    <option value="11" @if($salary->month == '11' ) selected  @endif >Nov</option>
                    <option value="12" @if($salary->month == '12' ) selected  @endif >Dec</option>
                </select>
                </div>
            </div>
            <div class="col-md-6">
                        <div class="form-group">
                    <select name="year" class="form-control select-hr select-year" id="">
                    <option value=""> ---PleaseChoose(Year) --- </option>
                    @for ($i = 0; $i < 10 ; $i++)
                    <option value="{{now()->subYear($i)->format('Y')}}" @if($salary->year == now()->subYear($i)->format('Y') )  selected @endif>
                        {{now()->subYear($i)->format('Y')}}</option>
                    @endfor
                </select>
                </div>
            </div>
        </div>

        <div class="md-form">
            <label for="">Amount(MMK)</label>
            <input type="number" name="amount" class="form-control" value="{{$salary->amount}}">
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
 {{!!JsValidator::formRequest('App\Http\Requests\SalaryUpdateForm', '#update-form');!!}}
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
