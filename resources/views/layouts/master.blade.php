<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    {{-- boostrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>

    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('register/css/style.css') }}">

    {{-- font-awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    {{-- datatable  --}}

    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('register/css/table.css') }}">


    {{-- date range picker  --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    {{-- select2  --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>

    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="#">HRM</a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="sidebar-header">
                    <div class="user-pic">
                        <img class="img-responsive img-rounded"
                            src="{{ Auth::user()->profile_img == null ? asset('userImage/default-avatar.png') : asset('employee/' . Auth::user()->profile_img) }}"
                            alt="User picture">
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            <strong>{{ Auth::user()->name }}</strong>
                        </span>
                        <span class="user-role">Administrator</span>
                        @if (Auth::user()->is_present == 1)
                            <span class="user-status">
                                <i class="fa fa-circle"></i>
                                <span>Online</span>
                            </span>
                        @else
                            <span class="user-status">
                                <i class="fa text-danger fa-circle"></i>
                                <span>Absent</span>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>General</span>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="{{ route('admin#dashboard') }}">
                                <i class="fa fa-home"></i>
                                <span>Home</span>

                            </a>

                        </li>

                              {{-- @can('View_CompanySetting') --}}
                               <li class="sidebar-dropdown">
                            <a href="{{ route('companySetting.show',1) }}">
                             <i class="fa-solid fa-building"></i>
                                <span>Company Setting</span>

                            </a></li>
                              {{-- @endcan --}}

                       {{-- @can('view_employee') --}}
                        <li class="sidebar-dropdown">
                            <a href="{{ route('employeeManangement.index') }}">
                                <i class="fa fa-user"></i>
                                <span>Employees</span>

                            </a></li>

                       {{-- @endcan --}}
                              {{-- @can('View_dept') --}}
                               <li class="sidebar-dropdown">
                            <a href="{{ route('departmentManangement.index') }}">
                             <i class="fa-solid fa-sitemap"></i>
                                <span>Department</span>

                            </a></li>
                              {{-- @endcan --}}

                                {{-- @can('View_dept') --}}
                               <li class="sidebar-dropdown">
                            <a href="{{ route('salary.index') }}">
                             <i class="fa-solid fa-money-bill-1"></i>
                                <span>Salary</span>

                            </a></li>
                              {{-- @endcan --}}






                        {{-- @can('view_role') --}}
                              <li class="sidebar-dropdown">
                            <a href="{{ route('roleManangement.index') }}">
                             <i class="fa-solid fa-shield-halved"></i>
                                <span>Role</span>

                            </a></li>
                        {{-- @endcan --}}


                            {{-- @can('View_permission') --}}
                             <li class="sidebar-dropdown">
                            <a href="{{ route('permissionManangement.index') }}">
                             <i class="fa-solid fa-lock-open"></i>
                                <span>Permission</span>

                            </a></li>
                            {{-- @endcan --}}

                              {{-- @can('View_attendance') --}}
                             <li class="sidebar-dropdown">
                            <a href="{{ route('attendance.index') }}">
                             <i class="fa-solid fa-clipboard-user"></i>
                                <span>Attendance</span>

                            </a></li>
                            {{-- @endcan --}}

                              {{-- @can('View_attendance') --}}
                             <li class="sidebar-dropdown">
                            <a href="{{ route('attendance.overview') }}">
                             <i class="fa-solid fa-users"></i>
                                <span>Attendance Overview</span>

                            </a></li>
                            {{-- @endcan --}}

                              {{-- @can('View_attendance') --}}
                             <li class="sidebar-dropdown">
                            <a href="{{ route('payroll') }}">
                             <i class="fa-solid fa-money-bill-transfer"></i>
                                <span>Payroll</span>

                            </a></li>
                            {{-- @endcan --}}

                              {{-- @can('View_attendance') --}}
                             <li class="sidebar-dropdown">
                            <a href="{{ route('project.index') }}">
                             <i class="fa-solid fa-toolbox"></i>
                                <span>Project</span>

                            </a></li>
                            {{-- @endcan --}}


                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <!-- sidebar-content  -->

        </nav>
        <!-- sidebar-wrapper  -->
        <div class="header-menu ">
            <div class="row  justify-content-center">
                <div class="col-md-10 ">
                    <div class="d-flex  justify-content-between">
                        <a href=""></a>
                        <h5>@yield('title')</h5>
                        <a href=""></a>

                    </div>
                </div>
            </div>
        </div>


        <div class=" scroll-m-5 py-4">
            <div class="d-flex  justify-content-center">
                <div class="col-md-8  ">
                    @yield('content')

                </div>
            </div>



        </div>
        {{-- <div class="bottom-menu">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="d-flex justify-content-between">
                        <a  href="{{route('admin#dashboard')}}"><i class="fas fa-home"></i>
                        <p class="mb-0 ">Home</p></a>
                        <a  href="{{route('owner#attendance')}}"><i class="fa-solid fa-clipboard-user"></i>
                        <p class="mb-0">Attendance</p></a>
                        <a  href="{{ route('companySetting.show',1) }}"><i class="fa-solid fa-gear"></i>
                        <p class="mb-0">Company</p></a>
                        <a  href="{{route('admin#profile')}}"><i class="fa-solid fa-user"></i>
                        <p class="mb-0">Profile</p></a>
                    </div>
                </div>
            </div>
        </div>
  <!-- page-content" -->
</div> --}}







</body>


{{-- boostrap --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
    integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous">
</script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('register/js/style.js') }}"></script>

{{-- datatable  --}}

<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>



{{-- date range picker  --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

{{-- validation  --}}
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

{{-- sweet alert  --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

 <script src="https://cdn.jsdelivr.net/npm/@laragear/webpass@2/dist/webpass.js" defer></script>

<script>
    $(function($) {



        @if (session('create'))
            Swal.fire({
                title: "Account Create Successfully",
                icon: "success",
                text: "{{ session('create') }}",
            });
        @endif

        document.addEventListener('click', function(event) {
            if (document.getElementById('show-sidebar').contains(event.target)) {
                $('.page-wrapper').addClass('toggled');
            } else if (!document.getElementById('sidebar').contains(event.target)) {
                $('.page-wrapper').removeClass('toggled');
            }
        })

          $('.select-hr').select2(
          );

    });
</script>

</html>

@yield('script')
