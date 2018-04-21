<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderReq extends FormRequest
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
            'orderNumber'    => 'required',
            'customer'    => 'required',
            'quantity'   => 'required',
            'berat'     => 'required',
            'deliveryDate'    => 'required',
            'keterangan'    => 'required'
        ];
    }
}
