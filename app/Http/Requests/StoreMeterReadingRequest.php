<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeterReadingRequest extends FormRequest
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
            'teant_id' => 'required|max:100',
            'from_date' => 'required|max:100',
            'present_reading_kwh' => 'required|max:100',
            'to_date' => 'required|max:100',
            'previous_reading_kwh' => 'required|max:100',
            'consumed_kwh' => 'required|max:100',
            'rate' => 'required|max:100',
            'bill' => 'required|max:100',
        ];
    }
}