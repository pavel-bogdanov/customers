<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Factories\Interfaces\CustomerFactoryInterface;
use App\Models\Customer;
use App\Http\Resources\CustomerResource;

/**
 * Description of CustomerRepository
 *
 * @author Pavel
 */
class CustomerRepository implements CustomerRepositoryInterface {

    private $countryRepository;
    private $customerFactory;
    
    public function __construct(
            CountryRepositoryInterface $countryRepository,
            CustomerFactoryInterface $customerFactory
    ) 
    {
        $this->countryRepository = $countryRepository;
        $this->customerFactory = $customerFactory;
    }
    
    public function add($data) 
    {
        $country = $this->countryRepository->get($data['iso_2']);
        
        if(is_null($country)){
            $country = $this->countryRepository->add($data['iso_2']);
        }
        
        $data['country_id'] = $country->id;
        
        $customer = $this->customerFactory->create($data);
        
        return new CustomerResource($customer->load('country'));
    }

    public function get($id) 
    {
        $customer = Customer::find($id);
        
        if(is_null($customer)){
            return [];
        }
        
        return new CustomerResource(Customer::find($id)->load('country'));
    }

    public function getAll(array $filters) 
    {
        //filter by iso_2 code in country table
        $filterByIso2 = $filters['iso_2'] ?? false;
        
        //unset iso_2 from filter, because it is not part of customers table
        unset($filters['iso_2']);
        
        $customers = Customer::query();
        
        foreach($filters as $column => $value){
            $customers->where($column, $value);
        }
        
        $customers->with('country');
        
        // filter customers by iso_2 code
        if($filterByIso2 !== false){
            $customers->whereHas('country', function($q) use($filterByIso2){
                $q->where('iso_2', $filterByIso2);
            });
        }
        
        return CustomerResource::collection($customers->paginate());
    }

}
