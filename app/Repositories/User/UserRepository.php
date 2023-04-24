<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Save User
     *
     * @param User $data
     * @return User $user
     */
    public function saveUser($data)
    {
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->email_verified_at = now();
        $user->password = bcrypt($data['password']);
        $user->save();
        return $user;
    }

    /**
     * Retrieve All User As List
     * @param Number $id
     * @return Collection $user
     */
    public function getUser($id)
    {
        $user = User::find($id);
        return $user;
    }

     /**
     * Get Single User by email
     * 
     * @param String $email
     * @return User $user|false
     */
    public function getUserByEmail($email)
    {
        $user = User::where('email', $email)->first();
        return $user;
    }
   
}
