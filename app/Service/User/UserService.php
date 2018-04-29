<?php
/**
 * User: marcus-campos
 * Date: 28/04/18
 * Time: 09:33
 */

namespace App\Service\User;


use App\Models\User;

class UserService
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getAuthUser()
    {
        $user =  $this->user->find(auth()->id())
            ->makeHidden([
                'score',
                'created_at',
                'email'
            ])->makeVisible([
                'biography'
            ]);

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
}