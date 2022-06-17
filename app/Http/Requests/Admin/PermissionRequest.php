<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->permission;

        $rules = [
            'name' => 'required|unique:permissions,name'
        ];

        if ($this->method() == 'put') {
            $rules['name'] = 'required|unique:permissions,name,' . $id;
        }

        return $rules;
    }
}
