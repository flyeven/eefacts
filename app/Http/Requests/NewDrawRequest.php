<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewDrawRequest extends Request
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
            'number' => 'required',
            'score' => 'required|integer',
            'invitations' => 'required|integer',
            'refdate' => 'required|date_format:d/m/Y',
            'reftime' => 'required|date_format:H:i:s',
            'startissue' => 'required|date_format:d/m/Y',
            'endissue' => 'required|date_format:d/m/Y',
        ];
    }
}
