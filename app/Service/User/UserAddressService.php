<?php
/**
 * User: marcus-campos
 * Date: 26/04/18
 * Time: 19:33
 */

namespace App\Service\User;


use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAddressService
{
    /**
     * @var UserAddress
     */
    private $userAddress;

    /**
     * UserAddressService constructor.
     * @param UserAddress $userAddress
     */
    public function __construct(UserAddress $userAddress)
    {
        $this->userAddress = $userAddress;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $addresses = $this->userAddress->with(['city', 'city.state'])
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
            $userAddress = $this->userAddress->find($id);
            return $userAddress->fill($request)->save();
        }

        $userAddress = $this->userAddress->create($request);
        return $userAddress;
    }


    /**
     * @return mixed
     */
    public function hasPrimary()
    {
        if ($this->userAddress->where('user_id', auth()->id())
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
        DB::transaction(function () use ($id) {
            $this->userAddress->destroy($id);

            if (!$this->hasPrimary()) {
                $userAddresses = $this->userAddress->where('user_id', auth()->id())->first();

                if ($userAddresses) {
                    $userAddresses->primary = 1;
                    $userAddresses->save();
                }
            }
        });
    }

    /**
     * @param $request
     * @param $id
     * @return array
     */
    public function primary($request, $id)
    {
        $userAddresses = $this->userAddress->where('user_id', auth()->id())
            ->where('primary', 1)
            ->first();
        $userAddresses->primary = 0;
        $userAddresses->save();

        return ['updated' => $this->persist($request, $id)];
    }

    /**
     * @param $id
     * @return bool
     */
    public function checkIfICan($id)
    {
        $userAddress = $this->userAddress->find($id);

        //Validando se a pessoa que está acessando pode apagar este endereço
        if ($userAddress->user_id != auth()->id()) {
            return false;
        }

        return true;
    }
}