@extends('layouts/master')

@section('title', 'Update Attendance')


@section('content')
<div>
    <a href="{{route('attendance.index')}}"><input type="button" name="" class="btn btn-primary mb-2" value="Back" id=""></a>
</div>
    <div class="card">
        <div class="card-body">

            @include('layouts.error')

            <form action="{{route('attendance.update',$attendance->id)}}" method="POST" id="update-form" >
                @csrf
                @method('PUT')
<div class="row">
          <div class="md-form">
                    <label for="">Employee</label>
                    <select name="user_id" class="form-control select-hr" id="">

                       @foreach ($employee as $user)
                        <option value="{{$user->id}}" @if (old('user_id', $attendance->user_id) == $user->id)
                            selected
                        @endif>{{$user->employee_id}} ({{$user->name}})</option>
                       @endforeach
                    </select>
                </div>


                   <div class="md-form">
                    <label for="">Date</label>
                    <input type="text"  name="date" class="form-control date" value="{{old('date',$attendance->date)}}">
                </div>
            </div>

            <div class="row">
              <div class="md-form">
                    <label for="">Check In Time</label>
                    <input type="text"  name="checkin_time" class="form-control timepicker" value="{{old('checkin_time', Carbon\Carbon::parse($attendance->checkin_time)->format('H:i:s'))}}">
                </div>
            </div>

             <div class="md-form">
                    <label for="">Check Out Time</label>
                    <input type="text"  name="checkout_time" class="form-control timepicker" value="{{old('checkout_time',Carbon\Carbon::parse($attendance->checkout_time)->format('H:i:s'))}}">
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
 {{!!JsValidator::formRequest('App\Http\Requests\UpdateAttendance', '#create-form');!!}}
    <script>

        $(document).ready(function(){
  $('.date').daterangepicker({
'singleDatePicker':true,
'autoApply':true,
 "showDropdowns": true,
'locale':{
    'format':'YYYY-MM-DD',
}
});

$('.timepicker').daterangepicker({
    singleDatePicker: true,
    timePicker: true,
    timePicker24Hour: true,
    timePickerSeconds: true,  // 🔧 Corrected typo here
    autoApply: true,
    locale: {
        format: 'HH:mm:ss'
    }
}).on('show.daterangepicker', function(ev, picker) {
    $('.calendar-table').hide(); // hides the calendar view
});

    });
    </script>

@endsection
