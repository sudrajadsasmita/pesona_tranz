<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleStoreRequest extends FormRequest
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
            'type' => 'required|string',
            'registration_number' => 'required|string|unique:vehicles,registration_number|max:11',
            'class' => 'required|string|max:255',
            'status' => 'required|string',
            'price' => 'required|integer',
            'driver_id' => 'required|integer|exists:drivers,id',
            'helper_id' => 'required|integer|exists:helpers,id'
        ];
    }
}
