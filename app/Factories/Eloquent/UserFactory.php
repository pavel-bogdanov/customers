<?php

namespace App\Factories\Eloquent;

use App\Factories\Interfaces\UserFactoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Description of UserFactory
 *
 * @author Pavel
 */
class UserFactory implements UserFactoryInterface {
    
    public function create(array $data) 
    {
        $user = User::create([
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'name'     => $data['name'],
        ]);
        
        return $user;
    }

}
