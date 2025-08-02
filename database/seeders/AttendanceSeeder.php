J<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Carbon\CarbonPeriod;
use App\Models\CheckInCheckOut;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
       foreach($users as $user){
        $periods = new CarbonPeriod('2025-01-01', '2025-07-31');
        foreach($periods as $period){
            if ($period->format('D') != 'Sat' && $period->format('D') != 'Sun' ){
            $attendance = new CheckInCheckOut();
            $attendance->user_id = $user->id;
            $attendance->date = $period->format('Y-m-d');
            $attendance->checkin_time = Carbon::parse($period->format('Y-m-d') . ' ' . '09:00:00')->subMinutes(rand(1,55));
            $attendance->checkout_time = Carbon::parse($period->format('Y-m-d') . ' ' . '18:00:00')->addMinutes(rand(1,55));
            $attendance->save();
              }
        }
       }
    }
}
