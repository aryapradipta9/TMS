<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModaReq extends FormRequest
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
            'nama'    => 'required',
            'vendor'    => 'required',
            'contact'    => 'required',
            'quantity'   => 'required|numeric',
            'tonase'     => 'required|numeric',
            'duration'    => 'required|numeric',
            'startFrom'   => 'required|date'     
        ];
    }
}
