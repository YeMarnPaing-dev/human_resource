@extends('layouts/master')

@section('title', 'Employee Details')


@section('content')

<div>
    <a href="{{route('admin#dashboard')}}"><input type="button" name="" class="btn btn-primary mb-2" value="Back" id=""></a>
</div>
<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-md-6 text-center">
                <img src="{{$employee->profile_img == null ? asset('userImage/default-avatar.png') : asset('employee/'. $employee->profile_img)}}" class=""
   style="width:120px;
    height: 120px;
    border-radius: 50%;
    border:1px solid #ddd;
    padding: 3px;" alt="">
     <div class="py-3 px-2">
                <h3>{{$employee->name}}</h3>
                <p class="text-muted mb-1">{{$employee->employee_id}}</p>
                <p class="text-muted mb-1">{{$employee->department ? $employee->department->name : ' '}}</p>
                <p class="text-muted mb-1">
                    @foreach ($employee->roles as $role)
                    <span class="badge badge-pill badge-primary">{{$role->name}}</span>
                    @endforeach
                </p>
            </div>
            </div>

            <div class="col-md-6 py-3 px-3" style="border-left:2px dashed #ddd;">

                 <p class="mb-1"><Strong>Phone</Strong> : <span class="text-muted">{{$employee->phone}}</span> </p>
                <p class="mb-1"><Strong>Email</Strong> : <span class="text-muted">{{$employee->email}}</span> </p>
                <p class="mb-1"><Strong>Nrc</Strong> : <span class="text-muted">{{$employee->nrc_number}}</span> </p>
                <p class="mb-1"><Strong>Gender</Strong> : <span class="text-muted">{{$employee->gender}}</span> </p>
                <p class="mb-1"><Strong>Birthday</Strong> : <span class="text-muted">{{$employee->birthday}}</span> </p>
                <p class="mb-1"><Strong>Address</Strong> : <span class="text-muted">{{$employee->address}}</span> </p>
                <p class="mb-1"><Strong>Join Date</Strong> : <span class="text-muted">{{$employee->date_of_join}}</span> </p>
                <p class="mb-1"><Strong>Is Present</Strong> : <span class="text-muted"> @if ($employee->is_present == 1)
                    <span class="badge  badege-pill badge-success">Present</span>
                    @else
                    <span class="badge badege-pill badge-danger">Leave</span>
                    @endif</span> </p>
            </div>

        </div>

    </div>
</div>

<div class="card mt-2">
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
        <div class="payroll-table"></div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        // Load initial data
        payrollTable();

        // Search button click
        $('.search-btn').on('click', function (e) {
            e.preventDefault();
            const month = $('.select-month').val();
            const year = $('.select-year').val();

            if (month && year) {
                payrollTable();
            } else {
                alert('Please select both month and year.');
            }
        });

        // Optionally trigger search on input change
        $(' .select-month, .select-year').on('change keyup', function () {
            const month = $('.select-month').val();
            const year = $('.select-year').val();

            if (month && year) {
                payrollTable();
            }
        });

        function payrollTable() {

            const month = $('.select-month').val();
            const year = $('.select-year').val();

            $.ajax({
                url: `{{ url('my-payroll-table') }}`,
                type: 'GET',
                data: {

                    month: month,
                    year: year
                },
                success: function (res) {
                    $('.payroll-table').html(res);
                },
                error: function (xhr) {
                    console.error('Error fetching data:', xhr.responseText);
                    $('.payroll-table').html(
                        `<div class="alert alert-danger">Unable to load payroll data.</div>`
                    );
                }
            });
        }
    });
</script>
@endsection
