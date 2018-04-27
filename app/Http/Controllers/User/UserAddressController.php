<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddressRequest;
use App\Models\UserAddress;
use App\Service\User\UserAddressService;

class UserAddressController extends Controller
{
    /**
     * @var UserAddressService
     */
    private $userAddressService;

    /**
     * UserAddressController constructor.
     * @param UserAddressService $userAddressService
     */
    public function __construct(UserAddressService $userAddressService)
    {
        $this->userAddressService = $userAddressService;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $addresses = $this->userAddressService->index();
        return $addresses;
    }

    /**
     * @param UserAddressRequest $userAddressRequest
     * @return mixed
     */
    public function store(UserAddressRequest $userAddressRequest)
    {
        if (!$this->userAddressService->hasPrimary()) {
            $userAddressRequest['primary'] = 1;
        }

        $address = $this->userAddressService->persist($userAddressRequest);
        return $address;
    }

    /**
     * @param UserAddressRequest $userAddressRequest
     * @param $id
     * @return mixed
     */
    public function update(UserAddressRequest $userAddressRequest, $id)
    {
        $address = $this->userAddressService->persist($userAddressRequest, $id);
        return $address;
    }

    /**
     * @param $id
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $userAddress = UserAddress::find($id);

        //Validando se a pessoa que está acessando pode apagar este endereço
        if ($userAddress->user_id != auth()->id()) {
            return redirect()->to(route('user.job.index'));
        }

        $this->userAddressService->destroy($id);

        return [
            'deleted' => true
        ];
    }
}
