<?php

namespace App\Factories\Eloquent;

use App\Factories\Interfaces\CustomerFactoryInterface;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
/**
 * Description of CustomerFactory
 *
 * @author Pavel
 */
class CustomerFactory implements CustomerFactoryInterface {
    
    public function create($data) 
    {
        $customer = new Customer();
        $customer->email = $data['email'];
        $customer->password = Hash::make($data['password']);
        $customer->name = $data['name'];
        $customer->country_id = $data['country_id'];
        $customer->city = $data['city'];
        $customer->address = $data['address'];
        $customer->state = $data['state'] ?? '';
        $customer->zip = $data['zip'] ?? '';
        $customer->phone = $data['phone'] ?? null;
        $customer->company_name = $data['company_name'] ?? null;
        
        $customer->save();
        
        return $customer;
    }
}
