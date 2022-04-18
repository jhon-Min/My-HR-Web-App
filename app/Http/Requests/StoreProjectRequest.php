<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            "title" => "required",
            "description" => "required",
            "start_date" => "required",
            "deadline" => "required",
            "priority" => "required",
            "status" => "required",
            "images" => "nullable",
            "images.*" => "file|mimes:jpg,png",
            "files" => "nullable",
            "files.*" => "mimes:pdf|max:2000"
        ];
    }
}
