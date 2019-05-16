<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadStoreRequest extends FormRequest
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
          'phone' => 'required',
          'deposit_type_id' => 'required',
          'chin_id' => 'required',
          'first_name' => 'required',
          'last_name' => 'required',
          'surname' => 'required',
          'money' => 'required',
          'city_id' => 'required',
          'source_id' => 'required',
        ];
    }
    public function messages()
    {
      return [
        'phone.required' => 'Укажите телефон',
        'deposit_type_id.required' => 'Укажите тип залога',
        'first_name.required' => 'Укажите имя',
        'last_name.required' => 'Укажите фамилию',
        'surname.required' => 'Укажите отчество',
        'money.required' => 'Укажите желаемую сумму займа',
        'city_id.required' => 'Укажите город',
        'source_id.required' => 'Укажите источник',
      ];
    }



}
