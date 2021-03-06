<?php

namespace App\Http\Requests;

use App\Models\UserAddress;
use Illuminate\Foundation\Http\FormRequest;

class UserAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $routePath = explode('/', $this->decodedPath());
        $authorize = false;

        switch ($this->method()) {
            case 'POST':
                $authorize = true;
                break;
            case 'PUT':
                $userAddress = UserAddress::find($routePath[2]);

                if ($userAddress->user_id == auth()->id()) {
                    $authorize = true;
                }
                break;
        }

        if (isset($routePath[0]) && isset($routePath[1])) {
            //POST
            if (
                $routePath[0] == 'user' &&
                $routePath[1] == 'address' &&
                !isset($routePath[2])
            ) {
                $authorize = true;
            }

            //PUT
            if (
                $routePath[0] == 'user' &&
                $routePath[1] == 'address' &&
                isset($routePath[2])
            ) {
                $userAddress = UserAddress::find($routePath[2]);

                if($userAddress->user_id == auth()->id()) {
                    $authorize = true;
                }
            }
        }

        return $authorize;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address'      => 'required|string|min:2|max:255',
            'number'       => 'required|integer',
            'complement'   => 'max:255',
            'neighborhood' => 'required|string|min:2|max:255',
            'zip_code'     => 'required|string|min:8|max:8',
            'city_id'      => 'required|string|exists:cities,id'
        ];
    }
}
