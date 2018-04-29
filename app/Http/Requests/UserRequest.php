<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $routePath = explode('/', $this->decodedPath());

        switch ($this->method()) {
            case 'POST':
                return true;
                break;
            case 'PUT':
                if (isset($routePath[0]) && isset($routePath[2])) {
                    if (
                        $routePath[0] == 'user' &&
                        $routePath[2] == 'password'
                    ) {
                        if (auth()->id() == $routePath[1]) {
                            return true;
                        }

                        return false;
                    }
                }

                return true;
                break;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $routePath = explode('/', $this->decodedPath());

        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6|confirmed'
                ];
                break;
            case 'PUT':
                if (isset($routePath[0]) && isset($routePath[2])) {
                    //POST
                    if (
                        $routePath[0] == 'user' &&
                        $routePath[2] == 'password'
                    ) {
                        return [
                            'password' => 'required|string|min:6|confirmed'
                        ];
                    }
                }

                return [
                    'name' => 'required|string|max:255',
                    'biography' => 'max:1000'
                ];

                break;
        }
    }
}
