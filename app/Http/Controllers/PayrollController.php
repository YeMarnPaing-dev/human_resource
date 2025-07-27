<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\CompanySetting;
use App\Models\CheckInCheckOut;
use App\Http\Requests\StoreAttendance;
use App\Http\Requests\UpdateAttendance;

class PayrollController extends Controller
{

    public function payroll(Request $request){

        return view('payroll');
    }

    public function payrollTable(Request $request){

        $month = $request->month;
        $year = $request->year;
        $startOfMonth = $year . '-' . $month . '-01';
        $endOFMonth = Carbon::parse($startOfMonth)->endOfMonth()->format('Y-m-d');
        $daysInMonth = Carbon::parse($startOfMonth)->daysInMonth;
        $workingDays = Carbon::parse($startOfMonth)->subDays(1)->diffInDaysFiltered(function(Carbon $date) {
            return $date->isWeekday() ;
        }, Carbon::parse($endOFMonth));

        $offDays = $daysInMonth - $workingDays;


         $periods = new CarbonPeriod( $startOfMonth, $endOFMonth);
         $employees = User::orderBy('employee_id')->where('name','Like','%'.$request->employee_name.'%')->get();
         $attendances = CheckInCheckOut::whereMonth('date', $month)->whereYear('date', $year)->get();
         $company_setting = CompanySetting::findorfail(1);
        return view('components.payroll-table',compact('periods','employees','attendances','company_setting','daysInMonth','workingDays','offDays'))->render();
    }
}
