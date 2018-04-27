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
            'number'       => 'required|number',
            'complement'   => 'string|min:1|max:255',
            'neighborhood' => 'required|string|min:2|max:255',
            'zip_code'     => 'required|string|min:2|max:255',
            'city_id'      => 'required|number|exists:cities.id'
        ];
    }
}
