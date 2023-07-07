<?php

namespace App\Contracts;

interface UserContract
{
    public function checkUserExist(string $email);
    public function getUserId(string $email);
    public function createNewUser(string $email);
}
