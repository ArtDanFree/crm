<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
        if (auth()->user()->hasRole('Частный инвестор')) {
            return $this->chin();
        } elseif (auth()->user()->hasRole('Андеррайтер')) {
            return $this->underwriter();
        }
    }

    public function underwriter()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'surname' => 'required|string',
            'vk' => 'nullable|url',
            'phone' => 'nullable|regex:/(7) [0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}/',
            'timezone' => 'nullable|integer|min:0|max:11'
        ];
    }

    public function chin()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'surname' => 'required|string',
            'vk' => 'nullable|url',
            'phone' => 'nullable|regex:/(7) [0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}/',
            //Паспортные данные:
            'passport_series' => 'required|string',
            'passport_id' => 'required|string',
            'birthday' => 'required|date',
            'issued_by' => 'required|string',
            'when_issued' => 'required|string',
            'division_code' => 'required|string',
            'registration_address' => 'required|string',
            //Банковские реквизиты:
            'bankcard_number' => 'required|string',
            'personal_account' => 'required|string',
            'corr_account' => 'required|string',
            'bik' => 'required|string',
            'bank_name' => 'required|string',
            ///Подсудность договоров:
            'court' => 'required|string',
            'court_address' => 'required|string'
        ];

    }

    public function messages()
    {
        return [
            'phone.regex' => 'Поле :attribute должно иметь формат 79999999999'
        ];
    }
}
