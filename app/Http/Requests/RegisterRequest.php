<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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
            'register_secret' => 'required|in:YPgqacxs2nWh2sbD',
            'full_name' => 'required|min:3',
            'username' => 'required|min:3|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
            'agree_terms' => 'required'
        ];
    }
}
