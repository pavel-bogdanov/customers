<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Factories\Interfaces\UserFactoryInterface;

/**
 * Description of UserRepository
 *
 * @author Pavel
 */
class UserRepository implements UserRepositoryInterface {
    
    private $userFactory;
    
    public function __construct(UserFactoryInterface $userFactory) 
    {
        $this->userFactory = $userFactory;
    }
    
    public function add(array $data) 
    {
        return $this->userFactory->create($data);
    }

}
