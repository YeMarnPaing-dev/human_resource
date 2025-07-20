@extends('layouts/master')

@section('title', 'Update Company Setting')


@section('content')
<div>
    <a href="{{route('companySetting.show',$setting->id)}}"><input type="button" name="" class="btn btn-primary mb-2" value="Back" id=""></a>
</div>
    <div class="card">
        <div class="card-body">
            <form action="{{route('companySetting.update',$setting->id)}}" method="POST" id="update-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
        <div class="row">


                <div class="md-form col-6">
                    <label for="">Company Name</label>
                    <input type="text" name="company_name" value="{{$setting->company_name}}" class="form-control">
                </div>

                <div class="md-form col-6">
                    <label for="">Company Phone</label>
                    <input type="text" name="company_phone" value="{{$setting->company_phone}}" class="form-control">
                </div>

                <div class="md-form col-6">
                    <label for="">Company Email</label>
                    <input type="text" name="company_email" value="{{$setting->company_email}}" class="form-control">
                </div>

                <div class="md-form col-6">
                    <label for="">Company Address</label>
                    <input type="text" name="company_address" value="{{$setting->company_address}}" class="form-control">
                </div>

                <div class="md-form col-6">
                    <label for="">Office Start Time</label>
                    <input type="text" name="officeStartTime" value="{{$setting->office_start_time}}" class="form-control timepicker">
                </div>

                <div class="md-form col-6">
                    <label for="">Office End Time</label>
                    <input type="text" name="officeEndTime" value="{{$setting->office_end_time}}" class="form-control timepicker">
                </div>

                <div class="md-form col-6">
                    <label for="">Break Start Time</label>
                    <input type="text" name="breakStart" value="{{$setting->break_start_time}}" class="form-control timepicker">
                </div>

                <div class="md-form col-6">
                    <label for="">Break End Time</label>
                    <input type="text" name="breakend" value="{{$setting->break_end_time}}" class="form-control timepicker">
                </div>




                <div class="d-flex justify-content-center">
                    <div class="">
                        <button type="submit" class="btn btn-primary my-3 btn-block">Confirm Button</button>
                    </div>

            </form>

    </div>



@endsection

@section('script')
 {{!!JsValidator::formRequest('App\Http\Requests\UpdateCompanySetting', '#update-form');!!}}

  <script>

    </script>


@endsection
