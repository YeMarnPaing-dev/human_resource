<div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Role</th>
                        <th>Days of Month</th>
                        <th>Working Days</th>
                        <th>Off Days</th>
                        <th>Attendance Days</th>
                        <th>Leave</th>
                        <th>Per Day(MMK)</th>
                        <th>Net Total(MMK)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $user)

                    @php
                        $attendanceDay = 0;
                    @endphp

                     @foreach ($periods as $period )
                     @if($period->isWeekday())
                        @php
                        $office_start_time = $period->format('Y-m-d') . ' ' . $company_setting->office_start_time;
                        $office_end_time = $period->format('Y-m-d') . ' ' . $company_setting->office_end_time;
                        $break_start_time = $period->format('Y-m-d') . ' ' . $company_setting->break_start_time;
                        $break_end_time = $period->format('Y-m-d') . ' ' . $company_setting->break_end_time;




                        $attendance = collect($attendances)->where('user_id', $user->id)->where('date', $period->format('Y-m-d'))->first();
                        if($attendance){
                            if($attendance->checkin_time < $office_start_time){
                                 $attendanceDay += 0.5;

                            }else if($attendance->checkin_time > $office_start_time && $attendance->checkin_time < $break_start_time ){
                              $attendanceDay += 0.5;

                            }else{
                                $attendanceDay += 0;
                            }

                            if($attendance->checkout_time < $break_end_time){
                                 $attendanceDay += 0;
                            }else if($attendance->checkout_time > $break_end_time && $attendance->check_out_time < $office_end_time){
                                $attendanceDay += 0.5;
                            }else{
                                $attendanceDay += 0.5;
                            }
                        }
                        @endphp
                        @endif
                         @endforeach

                         @php
                             $leaveDay = $workingDays - $attendanceDay;
                         @endphp

                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{implode($user->roles->pluck('name')->toArray())}}</td>
                        <td>{{$daysInMonth}}</td>
                        <td>{{$workingDays}}</td>
                        <td>{{$offDays}}</td>
                        <td>{{$attendanceDay}}</td>
                        <td>{{$leaveDay}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
