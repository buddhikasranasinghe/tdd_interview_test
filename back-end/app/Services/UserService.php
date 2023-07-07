<?php

namespace App\Services;

use App\Contracts\UserContract;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService implements UserContract
{
    public function checkUserExist(string $email): array
    {
        try {
            $user = User::where('email', $email)->first();
            if ($user) {
                return ['success' => true, 'status' => 'found'];
            } else {
                return ['success' => true,  'status' => 'not-found'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }        
    }

    public function getUserId(string $email): array
    {
        try {
            $user = User::where('email', $email)->first();
            return ['success' => true,  'user' => $user->id];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function createNewUser(string $email): array
    {
        try {
            $user = User::create([
                'name' => 'Subscribe User',
                'email' => $email,
                'password' => Hash::make('user@123')
            ]);
            return ['success' => true, 'user' => $user];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }        
    }
}
