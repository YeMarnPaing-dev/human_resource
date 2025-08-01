@extends('layouts.master')

@section('title', 'Attendance')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <!-- Employee Name -->
            <div class="col-md-3">
                <input type="text" class="form-control employee_name" placeholder="Employee Name">
            </div>

            <!-- Month Selection -->
            <div class="col-md-3">
                <select class="form-control select-month">
                    <option value="">--- Please Choose (Month) ---</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}"
                            @if (now()->format('m') == str_pad($m, 2, '0', STR_PAD_LEFT)) selected @endif>
                            {{ DateTime::createFromFormat('!m', $m)->format('M') }}
                        </option>
                    @endfor
                </select>
            </div>

            <!-- Year Selection -->
            <div class="col-md-3">
                <select class="form-control select-year">
                    <option value="">--- Please Choose (Year) ---</option>
                    @for ($i = 0; $i < 5; $i++)
                        @php $year = now()->subYears($i)->format('Y'); @endphp
                        <option value="{{ $year }}" @if (now()->format('Y') == $year) selected @endif>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
            </div>

            <!-- Search Button -->
            <div class="col-md-3">
                <button class="btn btn-primary btn-sm btn-block search-btn">
                    <i class="fa-brands fa-searchengin text-white"></i> Search
                </button>
            </div>
        </div>

        <!-- AJAX Result Placeholder -->
        <div class="attendance_overview_table"></div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        // Run once on page load
        loadAttendanceOverview();

        // Trigger on button click
        $('.search-btn').on('click', function (event) {
            event.preventDefault();
            const month = $('.select-month').val();
            const year = $('.select-year').val();

            if (month && year) {
                loadAttendanceOverview();
            } else {
                alert('Please select both month and year.');
            }
        });

        // Core AJAX function
        function loadAttendanceOverview() {
            const employeeName = $('.employee_name').val();
            const month = $('.select-month').val();
            const year = $('.select-year').val();

            $.ajax({
                url: `/attendance-overview-table`,
                type: 'GET',
                data: {
                    employee_name: employeeName,
                    month: month,
                    year: year
                },
                success: function (res) {
                    $('.attendance_overview_table').html(res);
                },
                error: function (xhr) {
                    console.error('Error fetching data:', xhr.responseText);
                    $('.attendance_overview_table').html(
                        `<div class="alert alert-danger">Unable to load attendance data.</div>`
                    );
                }
            });
        }
    });
</script>
@endsection
