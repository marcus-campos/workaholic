<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddressRequest;
use App\Http\Requests\UserRequest;
use App\Models\UserAddress;
use App\Service\User\UserAddressService;
use App\Service\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return mixed
     */
    public function getAuthUser()
    {
        $user = $this->userService->getAuthUser();
        return $user;
    }


    /**
     * @param UserRequest $userRequest
     * @param $id
     * @return mixed
     */
    public function update(UserRequest $userRequest, $id)
    {
        $address = $this->userService->persist($userRequest, $id);

        return [
            'updated' => $address
        ];
    }

    /**
     * @param UserRequest $userRequest
     * @param $id
     * @return mixed
     */
    public function updatePassword(UserRequest $userRequest, $id)
    {
        $address = false;

        if ($this->userService->checkPassword($userRequest->all()['oldPassword'])) {
            $password = bcrypt($userRequest->all()['password']);
            $request = new Request(['password' => $password]);
            $address = $this->userService->persist($request, $id);

            auth()->logout();

            return [
                'updated' => $address
            ];
        }

        return response()->json([
            'updated' => $address
        ], 422);
    }
}