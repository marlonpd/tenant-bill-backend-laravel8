<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMeterReadingRequest extends FormRequest
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
            'tenantId' => 'required|max:100',
            'fromDate' => 'required|max:100',
            'presentReadingKwh' => 'required|max:100',
            'toDate' => 'required|max:100',
            'previousReadingKwh' => 'required|max:100',
            'consumedKwh' => 'required|max:100',
            'rate' => 'required|max:100',
            'bill' => 'required|max:100',
        ];
    }
}