@extends('layouts/master')

@section('title', 'Attendance')


@section('content')



<div class="card">
    <div class="card-body">


        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" class="form-control employee_name" placeholder="Employee Name">
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select name="" class="form-control select-hr select-month" id="">
                    <option value=""> ---PleaseChoose(Month) --- </option>
                    <option value="01" @if(now()->format('m') == '01' ) selected  @endif >Jan</option>
                    <option value="02" @if(now()->format('m') == '02' ) selected  @endif >Feb</option>
                    <option value="03" @if(now()->format('m') == '03' ) selected  @endif >Mar</option>
                    <option value="04" @if(now()->format('m') == '04' ) selected  @endif >Apr</option>
                    <option value="05" @if(now()->format('m') == '05' ) selected  @endif >May</option>
                    <option value="06" @if(now()->format('m') == '06' ) selected  @endif >June</option>
                    <option value="07" @if(now()->format('m') == '07' ) selected  @endif >July</option>
                    <option value="08" @if(now()->format('m') == '08' ) selected  @endif >Aug</option>
                    <option value="09" @if(now()->format('m') == '09' ) selected  @endif >Sept</option>
                    <option value="10" @if(now()->format('m') == '10' ) selected  @endif >Oct</option>
                    <option value="11" @if(now()->format('m') == '11' ) selected  @endif >Nov</option>
                    <option value="12" @if(now()->format('m') == '12' ) selected  @endif >Dec</option>
                </select>
                </div>
            </div>
            <div class="col-md-3">
                  <div class="form-group">
                    <select name="" class="form-control select-hr select-year" id="">
                    <option value=""> ---PleaseChoose(Year) --- </option>
                    @for ($i = 0; $i < 5 ; $i++)
                    <option value="{{now()->subYear($i)->format('Y')}}" @if(now()->format('Y') == now()->subYear($i)->format('Y') )  selected @endif>
                        {{now()->subYear($i)->format('Y')}}</option>
                    @endfor
                </select>
                </div> </div>
            <div class="col-md-3">
                <button class="btn btn-primary btn-sm btn-block search-btn"><i class="fa-brands fa-searchengin text-white"></i>Search</button>
            </div>
        </div>


        <div class="attendance_overview_table">


        </div>



    </div>
</div>
@endsection

@section('script')

    <script>

        $(document).ready(function(){

            attendanceOvervieTable();

        function attendanceOvervieTable() {

    var employee_name = $('.employee_name').val();
    var month = $('.select-month').val();
    var year = $('.select-year').val();

    $.ajax({
        url: `/attendance-overview-table?employee_name=${employee_name}&month=${month}&year=${year}`, // Use backticks for template string
        type: 'GET',
        success: function(res) {
            $('.attendance_overview_table').html(res);
        },
        error: function(xhr) {
            console.error('Failed to fetch attendance overview:', xhr.responseText);
            $('.attendance_overview_table').html(
                `<div class="alert alert-danger">Unable to load attendance data.</div>`
            );
        }
    });
}

$('.search-btn').on('click', function(event) {
    event.preventDefault(); // ✅ Add event param and prevent default properly



    if (month && year) {
        attendanceOvervieTable();
    } else {
        alert('Please select both month and year.');
    }
});

    });
    </script>

@endsection
