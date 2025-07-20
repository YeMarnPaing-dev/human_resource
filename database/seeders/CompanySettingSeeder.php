<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!CompanySetting::exists()){

            $setting = new CompanySetting();
            $setting->company_name = 'Data Server';
            $setting->company_email = 'data@gmail.com';
            $setting->company_phone = '09977292898';
            $setting->company_address = 'NayPyiTaw';
            $setting->office_start_time = '09:00:00';
            $setting->office_end_time = '18:00:00';
            $setting->break_start_time = '12:00:00';
            $setting->break_end_time = '13:00:00';
            $setting->save();
        }


    }
}
