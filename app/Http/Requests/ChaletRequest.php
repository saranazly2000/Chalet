<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChaletRequest extends FormRequest
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
            'chaletname' => 'required',
            'chaletphone' => 'required|regex:/^(05)[6,9][0-9]{7}$/',
            'chaletprice' => 'required|numeric',
            'evening' => 'required|numeric',
            'weekend_morning' => 'required|numeric',
            'weekend_evening' => 'required|numeric',
        ];
    }
    public  function messages(){
        return [
          'chaletprice.numeric' => 'Chalet price must be a number',
        'chaletphone.regex' => 'Invalid phone number '

        ];
    }
}
