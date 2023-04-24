<?php

namespace App\Repositories\User;

use App\Models\User;


interface UserRepositoryInterface
{


  /**
   * Save User
   *
   * @param User $data
   * @return User $User|false
   */
  public function saveUser($data);

  /**
   * Retrieve All User As List
   * @param Number $id
   * @return Collection $user
   */
  public function getUser($id);

  /**
   * Get Single User by email
   * 
   * @param String $email
   * @return User $user|false
   */
  public function getUserByEmail($email);
}
