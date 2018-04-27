<?php
/**
 * User: marcus-campos
 * Date: 26/04/18
 * Time: 19:33
 */

namespace App\Service\User;


use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressService
{

    /**
     * @return mixed
     */
    public function index()
    {
        $addresses =  UserAddress::with('city')
            ->where('user_id', auth()->id())
            ->orderBy('primary', 'desc')
            ->orderBy('created_at', 'asc')
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
     * @return mixed
     */
    public function hasPrimary()
    {
        if (UserAddress::where('user_id', auth()->id())
            ->where('primary', 1)
            ->count() > 0) {
            return true;
        }

        return false;
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        UserAddress::destroy($id);
    }

    public function primary($request, $id)
    {
        $userAddresses = UserAddress::where('user_id', auth()->id())
            ->where('primary', 1)
            ->first();
        $userAddresses->primary = 0;
        $userAddresses->save();

        return ['updated' => $this->persist($request, $id)];
    }
}