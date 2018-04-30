<?php
/**
 * User: marcus-campos
 * Date: 28/04/18
 * Time: 09:33
 */

namespace App\Service\User;


use App\Models\User;
use App\Service\Storage\StorageService;

class UserService
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var StorageService
     */
    private $s3Service;

    /**
     * UserService constructor.
     * @param User $user
     * @param StorageService $s3Service
     */
    public function __construct(User $user, StorageService $s3Service)
    {
        $this->user = $user;
        $this->s3Service = $s3Service;
    }

    /**
     * @return mixed
     */
    public function getAuthUser()
    {
        $user = $this->user->find(auth()->id())
            ->makeHidden([
                'score',
                'created_at',
                'email'
            ])->makeVisible([
                'biography',
                'photo'
            ])->toArray();

        $user['photo'] = $this->s3Service->getFileUrl($user['photo']);

        return $user;
    }
    
    /**
     * @param $request
     * @param null $id
     * @return mixed
     */
    public function persist($request, $id = null)
    {
        $request = $request->all();

        if ($id) {
            $user = $this->user->find($id);
            return $user->fill($request)->save();
        }

        $user = $this->user->create($request);
        return $user;
    }

    /**
     * @param $password
     * @return bool
     */
    public function checkPassword($password)
    {
        $actualPassword = auth()->user()->getAuthPassword();

        if (password_verify($password, $actualPassword)) {
            return true;
        }

        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function checkIfHasPhoto($id)
    {
        $user = $this->user->find($id);

        if ($user->photo) {
            return true;
        }

        return false;
    }
}