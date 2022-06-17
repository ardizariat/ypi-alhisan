<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $user = $this->user;

        $rules = [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'roles' => 'required',
        ];
        if ($this->method() === 'PUT') {
            $rules['username'] = 'unique:users,username,' . $user->id;
            $rules['email'] = 'unique:users,email,' . $user->id;
        }

        return $rules;
    }
}
