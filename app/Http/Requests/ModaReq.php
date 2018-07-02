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
            'plat' => 'required',
            'tonase'     => 'required|numeric' ,
            'duration'    => 'nullable|numeric',
            'startFrom'   => 'nullable|date'   
        ];
    }
}
