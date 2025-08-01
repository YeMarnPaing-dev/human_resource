<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
     public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {


        return [
            'employee_id' => 'required' ,
            'name'=>'required',
            'phone'=>'required|min:9|max:12',
             'email'=>'required|email',
             'nrc_number'=>'required',
             'gender'=>'required',
             'birthday'=>'required',
             'address'=>'required',
             'department_id'=>'required',
             'dateOfJoin'=>'required',
             'is_present'=>'required',
             'pincode'=>'required|min:6|max:6'
        ];
    }
}
