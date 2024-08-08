<?php
// app/Repositories/UserRepository.php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface 
{
    public function create(array $data)
    {
        $user = User::create($data);
        return $user;
    }

    public function update(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }
  
    public function delete(User $User)
    {
        $User->delete();
    }

    public  function getAll() {
        return User::all();
    }
    public function getById(int $id)
    { 
        return User::find($id);
    }
    public function findByEmail(string $email)
    {
        return User::where("email", $email)->first();
    }

 
    

}
