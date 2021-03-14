<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Models\Country;
use App\Services\Interfaces\CountryServiceInterface;
use App\Factories\Interfaces\CountryFactoryInterface;

/**
 * Description of CountryRepository
 *
 * @author Pavel
 */
class CountryRepository implements CountryRepositoryInterface {
    
    private $countryService;
    private $countryFactory;
    
    public function __construct(
            CountryServiceInterface $countryService,
            CountryFactoryInterface $countryFactory
    ) 
    {
        $this->countryService = $countryService;
        $this->countryFactory = $countryFactory;
    }
    
    public function add(string $iso2) 
    {
        $countryData = $this->countryService->getCountryData($iso2);
        
        if(empty($countryData)){
            throw new \Exception("Please enter valid iso_2 code.");
        }
        
        return $this->countryFactory->create($countryData);
    }

    public function get(string $country) 
    {
        return Country::where('iso_2', $country)->first();
    }

}
