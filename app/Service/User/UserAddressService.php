<?php
/**
 * User: marcus-campos
 * Date: 26/04/18
 * Time: 19:33
 */

namespace App\Service\User;


use App\Models\UserAddress;

class UserAddressService
{

    /**
     * @return mixed
     */
    public function index()
    {
        $addresses =  UserAddress::with('city')
            ->where('user_id', auth()->id())
            ->paginate(15);
        return $addresses;
    }
    
    /**
     * @param $request
     * @param null $id
     * @return mixed
     */
    public function persist($request, $id = null)
    {
        $request = $request->all();
        $request['user_id'] = auth()->user()->id;

        if ($id) {
            $userAddress = UserAddress::find($id);
            return $userAddress->fill($request)->save();
        }

        $userAddress = UserAddress::create($request);
        return $userAddress;
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        UserAddress::destroy($id);
    }
}