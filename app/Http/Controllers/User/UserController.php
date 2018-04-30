<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddressRequest;
use App\Http\Requests\UserRequest;
use App\Models\UserAddress;
use App\Service\S3\S3Service;
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
     * @var S3Service
     */
    private $s3Service;

    /**
     * UserController constructor.
     * @param UserService $userService
     * @param S3Service $s3Service
     */
    public function __construct(UserService $userService, S3Service $s3Service)
    {
        $this->userService = $userService;
        $this->s3Service = $s3Service;
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

    /**
     * @param UserRequest $userRequest
     * @param $id
     * @return array
     */
    public function profilePhoto(UserRequest $userRequest, $id)
    {
        $directory = 'user/' . auth()->id() . '/profile/photo';
        $image = $this->s3Service->uploadFile($userRequest, $directory);

        if ($image) {
            $request = new Request(['photo' => $image]);

            if ($this->userService->checkIfHasPhoto($id)) {
                $photo = auth()->user()->photo;
                $this->s3Service->deleteFile($photo);
            }

            $this->userService->persist($request, $id);

            return [
                'updated' => true
            ];
        }

        return [
            'updated' => false
        ];
    }
}
