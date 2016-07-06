<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewPostRequest extends Request
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
            'title' => 'required|string|max:100',
            'text' => 'required|string',
            'publisheddate' => 'date_format:d/m/Y',
            'publishedtime' => 'date_format:H:i:s',
            'picture' => 'image'
        ];
    }
}
