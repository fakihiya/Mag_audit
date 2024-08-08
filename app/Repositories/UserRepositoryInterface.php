<?php
// app/Repositories/UserRepository.php

namespace App\Repositories;

use App\Models\User;

 

interface UserRepositoryInterface
{
    public function create(array $data);
    public function findByEmail(string $email);
   

 

    public function delete(User $User);

    public function getById(int $id);


    public function getAll();
 

}
