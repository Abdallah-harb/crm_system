<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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

            "project_name" => 'required|unique:projects,project_name,'.$this->id,
            "deadline" => "required",
            "description" => "required",
            "user_id" => 'required|exists:users,id',
            "client_id" => 'required|exists:clients,id',
            "status" => "required",
        ];
    }
}
