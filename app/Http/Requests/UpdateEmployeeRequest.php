<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $id = $this->route('employee')->id;
        // $id = $request->route('id');
        return [
            'employee_id' => 'required|unique:users,employee_id,' . $id,
            'name' => 'required',
            'phone' => 'required|min:9|max:11|unique:users,phone,' . $id,
            'email' => 'required|unique:users,email,' .$id,
            'pin_code' => 'required|min:6|max:6',
            'nrc_number' => 'required|min:3',
            'gender' => 'required',
            'department' => 'required',
            'birthday' => 'required|date',
            'address' => 'required',
            'date_of_join' => 'required|date',
            'is_present' => 'required',
            'roles' => 'nullable'
        ];
    }
}
