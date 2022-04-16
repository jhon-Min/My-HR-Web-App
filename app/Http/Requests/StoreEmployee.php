<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployee extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employee_id' => 'required|unique:users,employee_id',
            'name' => 'required',
            'phone' => 'required|min:9|max:11|unique:users,phone',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:4|max:255',
            'pin_code' => 'required|min:6|max:6',
            'nrc_number' => 'required|min:3',
            'gender' => 'required',
            'department' => 'required',
            'birthday' => 'required|date',
            'address' => 'required',
            'date_of_join' => 'required|date',
            'is_present' => 'required',
            'roles' => 'nullable'
            // 'profile_img' => 'nullable|file|mimes:png,jpg|max:15000',
        ];
    }
}
