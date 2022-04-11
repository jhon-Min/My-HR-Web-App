<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
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
            "name" => "required|unique:departments,name",
            "phone" => "required",
            "email" => "required|email|unique:departments,email",
            "head_of_dep" => "required",
            "start_date" => "required",
            "total" => "required",
        ];
    }
}
