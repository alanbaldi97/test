<?php

namespace App\Http\Requests\Flights;

use Illuminate\Foundation\Http\FormRequest;

class FlightsRequest extends FormRequest
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
            //
            'code' => ['required'],
            'type' => ['required'],
            'departure_id' => ['required', 'exists:airports,id'],
            'destination_id' => ['required', 'exists:airports,id'],
            'departure_time' => ['required'],
            'arrival_time' => ['required'],
            'airline_id' => ['required', 'exists:airlines,id']
        ];
    }
}
