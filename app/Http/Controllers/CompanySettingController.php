<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanySetting;

class CompanySettingController extends Controller
{
    public function show($id){

         if(!auth()->user()->can('view_company') ){
          abort(403);
    }

$setting = CompanySetting::findorfail($id);
return view('companysetting.show',compact('setting'));
    }

    public function edit($id){

         if(!auth()->user()->can('edit_company') ){
      abort(403);
    }

       $setting = CompanySetting::findorfail($id);
       return view('companysetting.edit',compact('setting'));
    }

    public function update($id,Request $request){

        $setting = CompanySetting::findorfail($id);

        $setting->company_name = $request->company_name;
        $setting->company_phone = $request->company_phone;
        $setting->company_email = $request->company_email;
        $setting->company_address = $request->company_address;
        $setting->office_start_time = $request->officeStartTime;
        $setting->office_end_time = $request->officeEndTime;
        $setting->break_start_time = $request->breakStart;
        $setting->break_end_time = $request->breakend;

        $setting->update();

        return redirect()->route('companySetting.show',$setting->id)->with('update','Comany Setting is updated successfully');



    }
}
