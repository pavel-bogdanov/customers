<?php

namespace App\Services;

use App\Services\Interfaces\CountryServiceInterface;
use Illuminate\Support\Facades\Http;

/**
 * Get country data from restcountries.eu
 * 
 * @author Pavel
 */
class RestCountriesEuService implements CountryServiceInterface {
    
    const SERVICE_URL = 'https://restcountries.eu/rest/v2/alpha/';
    
    private $countryData;
    private $code;
    
    public function __construct() 
    {
        $this->countryData = [];
        $this->code = '';
    }
    
    /**
     * Make request to restcountries.eu to get country data
     * 
     * @param string $code
     * @return array with country data 
     */
    private function makeRequest()
    {   
        $response = Http::get(self::SERVICE_URL . $this->code);
        
        if($response->successful()){
            $this->countryData = $response->json();
        }
        
        return [];
    }
    
    /**
     * Get country data from restcountries.eu and parse it
     * 
     * @param string $code
     * @return array
     */
    public function getCountryData(string $code): array 
    {
        $this->setCode($code);
        
        if(empty($this->code)){
            return [];
        }
        
        $this->makeRequest();
        
        if(empty($this->countryData)){
            return [];
        }
        
        return [
            'iso_2'           => $this->countryData['alpha2Code'],
            'iso_3'           => $this->countryData['alpha3Code'],
            'name'            => $this->countryData['name'],
            'capital'         => $this->countryData['capital'],
            'area'            => $this->countryData['area'],
            'flag'            => $this->countryData['flag'],
            'currency_code'   => $this->countryData['currencies'][0]['code'],
            'currency_symbol' => $this->countryData['currencies'][0]['symbol'],
        ];
    }
    
    public function setCode($code)
    {
        $this->code = trim($code);
    }
}
