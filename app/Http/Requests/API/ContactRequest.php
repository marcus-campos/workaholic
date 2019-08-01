<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|min:1',
            'email' => 'required|email',
            'phone' => 'required|min:10|max:20',
            'subject' => 'required|min:1',
            'description' => 'required|min:1'
        ];
    }
}
