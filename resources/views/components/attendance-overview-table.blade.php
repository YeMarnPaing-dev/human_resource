<div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Employee</th>
                        @foreach ($periods as $period)
                            <th @if ($period->format('D') == 'Sat' || $period->format('D') == 'Sun' )
                            class="bg-warning"
                            @endif >{{ $period->format('d') }} <br> {{ $period->format('D') }} </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        @foreach ($periods as $period )
                        @php
                        $office_start_time = $period->format('Y-m-d') . ' ' . $company_setting->office_start_time;
                        $office_end_time = $period->format('Y-m-d') . ' ' . $company_setting->office_end_time;
                        $break_start_time = $period->format('Y-m-d') . ' ' . $company_setting->break_start_time;
                        $break_end_time = $period->format('Y-m-d') . ' ' . $company_setting->break_end_time;

                        $icon= '';
                        $outIcon = '';

                        $attendance = collect($attendances)->where('user_id', $user->id)->where('date', $period->format('Y-m-d'))->first();
                        if($attendance){
                            if($attendance->checkin_time < $office_start_time){
                                $icon ='<i class="fa-solid fa-circle-check text-success"></i>';

                            }else if($attendance->checkin_time > $office_start_time && $attendance->checkin_time < $break_start_time ){
                              $icon = '<i class="fa-solid fa-circle-check text-warning"></i>';

                            }else{
                                $icon = '<i class="fa-solid fa-circle-xmark text-danger"></i>';
                            }

                            if($attendance->checkout_time < $break_end_time){
                                 $outIcon = '<i class="fa-solid fa-circle-xmark text-danger"></i>';
                            }else if($attendance->checkout_time > $break_end_time && $attendance->check_out_time < $office_end_time){
                                $outIcon = '<i class="fa-solid fa-circle-check text-warning"></i>';
                            }else{
                                '<i class="fa-solid fa-circle-check text-success"></i>';
                            }
                        }
                        @endphp
                        <td>
                            <div>{!! $icon !!}</div>
                            <div>{!! $outIcon !!}</div>
                        </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
