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
            <div class="col-md-3">
                  <div class="form-group">
                    <select name="" class="form-control select-hr select-year" id="">
                    <option value=""> ---PleaseChoose(Year) --- </option>
                    @for ($i = 0; $i < 5 ; $i++)
                    <option value="{{now()->subYear($i)->format('Y')}}">{{now()->subYear($i)->format('Y')}}</option>
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

        function attendanceOvervieTable(employee_name,month, year) {
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

    var employee_name = $('.employee_name').val();
    var month = $('.select-month').val();
    var year = $('.select-year').val();

    if (month && year) {
        attendanceOvervieTable(employee_name,month, year);
    } else {
        alert('Please select both month and year.');
    }
});

    });
    </script>

@endsection
