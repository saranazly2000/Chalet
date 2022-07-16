<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditReservationRequest extends FormRequest
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
            'reservation_date' => 'required|date_format:Y-m-d',
            'reservation_period' => 'required',
           

        ];
    }

    public  function messages(){
        return [
           'reservation_date.date_format:Y-m-d' => 'Date Format Should be YYYY-mm-dd'


        ];
    }
}
